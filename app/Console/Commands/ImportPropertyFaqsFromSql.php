<?php

namespace App\Console\Commands;

use App\Models\Property;
use App\Models\PropertyFaq;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportPropertyFaqsFromSql extends Command
{
    protected $signature = 'properties:import-faqs-from-sql
                            {file? : Path to SQL dump (default: storage/app/import/u374726443_prop_site.sql)}
                            {--dry-run : Preview without writing to database}
                            {--replace : Delete existing FAQs for matched properties before import}';

    protected $description = 'Import property FAQs from old SQL dump, matching properties by slug from property_list';

    public function handle(): int
    {
        $filePath = $this->argument('file')
            ?? storage_path('app/import/u374726443_prop_site.sql');

        if (!is_file($filePath)) {
            $this->error("SQL file not found: {$filePath}");
            return 1;
        }

        $dryRun = (bool) $this->option('dry-run');
        $replace = (bool) $this->option('replace');

        $this->info('Reading SQL dump: ' . $filePath);

        $sql = file_get_contents($filePath);
        $slugByOldId = $this->parsePropertyListSlugs($sql);
        $faqs = $this->parsePropertyFaqs($sql);

        if (empty($slugByOldId)) {
            $this->error('No property_list rows found in SQL dump.');
            return 1;
        }

        if (empty($faqs)) {
            $this->error('No property_faq rows found in SQL dump.');
            return 1;
        }

        $this->info('Found ' . count($slugByOldId) . ' properties and ' . count($faqs) . ' FAQs in dump.');

        $propertiesBySlug = Property::query()
            ->select('id', 'slug', 'name')
            ->get()
            ->keyBy('slug');

        $imported = 0;
        $skippedNoProperty = 0;
        $skippedDuplicate = 0;
        $propertiesTouched = [];
        $unmatchedSlugs = [];

        $rowsToInsert = [];

        foreach ($faqs as $faq) {
            $slug = $this->resolvePropertySlug($slugByOldId[$faq['old_property_id']] ?? '');

            if ($slug === '') {
                $skippedNoProperty++;
                continue;
            }

            $property = $propertiesBySlug->get($slug);

            if (!$property) {
                $unmatchedSlugs[$slug] = ($unmatchedSlugs[$slug] ?? 0) + 1;
                $skippedNoProperty++;
                continue;
            }

            $rowsToInsert[] = [
                'property_id' => $property->id,
                'question' => $faq['question'],
                'answer' => $faq['answer'],
                'sort_order' => $faq['sort_order'],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $propertiesTouched[$property->id] = $property->name;
        }

        if ($dryRun) {
            $this->warn('DRY RUN - no database changes made.');
            $this->table(
                ['Metric', 'Count'],
                [
                    ['FAQs to import', count($rowsToInsert)],
                    ['Properties matched', count($propertiesTouched)],
                    ['Skipped (no matching property)', $skippedNoProperty],
                ]
            );

            if (!empty($unmatchedSlugs)) {
                $this->warn('Unmatched slugs from dump:');
                foreach ($unmatchedSlugs as $slug => $count) {
                    $this->line("  - {$slug} ({$count} FAQs)");
                }
            }

            return 0;
        }

        DB::transaction(function () use ($replace, $rowsToInsert, $propertiesTouched, &$imported, &$skippedDuplicate) {
            if ($replace && !empty($propertiesTouched)) {
                $deleted = PropertyFaq::whereIn('property_id', array_keys($propertiesTouched))->delete();
                $this->info("Removed {$deleted} existing FAQs for matched properties.");
            }

            foreach ($rowsToInsert as $row) {
                $exists = PropertyFaq::where('property_id', $row['property_id'])
                    ->where('question', $row['question'])
                    ->exists();

                if ($exists) {
                    $skippedDuplicate++;
                    continue;
                }

                PropertyFaq::create([
                    'property_id' => $row['property_id'],
                    'question' => $row['question'],
                    'answer' => $row['answer'],
                    'sort_order' => $row['sort_order'],
                ]);

                $imported++;
            }
        });

        $this->info("Imported {$imported} FAQs for " . count($propertiesTouched) . ' properties.');
        $this->info("Skipped {$skippedNoProperty} FAQs (property not found by slug).");
        $this->info("Skipped {$skippedDuplicate} duplicate FAQs.");

        if (!empty($unmatchedSlugs)) {
            $this->warn('Unmatched slugs:');
            foreach ($unmatchedSlugs as $slug => $count) {
                $this->line("  - {$slug} ({$count} FAQs)");
            }
        }

        return 0;
    }

    /**
     * @return array<int, string> old property_list id => slug
     */
    private function parsePropertyListSlugs(string $sql): array
    {
        $map = [];

        if (!preg_match_all(
            "/^\((\d+),\s*(?:NULL|'[^']*'),\s*'((?:[^'\\\\]|\\\\.)*)',\s*'/m",
            $sql,
            $rows,
            PREG_SET_ORDER
        )) {
            return $map;
        }

        foreach ($rows as $row) {
            $map[(int) $row[1]] = stripcslashes($row[2]);
        }

        return $map;
    }

    private function resolvePropertySlug(string $slug): string
    {
        $aliases = [
            'dlf_404' => 'dlf-the-dahlias-sector-54-gurgaon',
        ];

        return $aliases[$slug] ?? $slug;
    }

    /**
     * @return list<array{old_property_id:int, question:string, answer:string, sort_order:int}>
     */
    private function parsePropertyFaqs(string $sql): array
    {
        $faqs = [];

        foreach ($this->extractInsertValuesBlocks($sql, 'property_faq') as $valuesSql) {
            foreach ($this->parseSqlTuples($valuesSql) as $row) {
                if (!isset($row[1], $row[2], $row[3], $row[4])) {
                    continue;
                }

                if (!is_int($row[1]) || !is_string($row[2]) || !is_string($row[3])) {
                    continue;
                }

                $faqs[] = [
                    'old_property_id' => $row[1],
                    'question' => $row[2],
                    'answer' => $row[3],
                    'sort_order' => is_int($row[4]) ? $row[4] : (int) $row[4],
                ];
            }
        }

        return $faqs;
    }

    /**
     * @return list<string>
     */
    private function extractInsertValuesBlocks(string $sql, string $table): array
    {
        $blocks = [];

        if (!preg_match_all(
            '/INSERT INTO `' . preg_quote($table, '/') . '`[^V]+VALUES\s*(.+?);\s*(?:--|INSERT|ALTER|COMMIT|$)/s',
            $sql,
            $matches
        )) {
            return $blocks;
        }

        foreach ($matches[1] as $valuesSql) {
            $blocks[] = trim($valuesSql);
        }

        return $blocks;
    }

    /**
     * @return list<list<mixed>>
     */
    private function parseSqlTuples(string $valuesSql): array
    {
        $pos = 0;
        $tuples = [];

        while ($pos < strlen($valuesSql)) {
            while ($pos < strlen($valuesSql) && !in_array($valuesSql[$pos], ['(', ','], true)) {
                $pos++;
            }

            if ($pos >= strlen($valuesSql)) {
                break;
            }

            if ($valuesSql[$pos] === ',') {
                $pos++;
            }

            if (($valuesSql[$pos] ?? '') !== '(') {
                continue;
            }

            try {
                $tuples[] = $this->parseSqlTuple($valuesSql, $pos);
            } catch (\Throwable) {
                break;
            }
        }

        return $tuples;
    }

    /**
     * @return list<mixed>
     */
    private function parseSqlTuple(string $input, int &$pos): array
    {
        while ($pos < strlen($input) && ctype_space($input[$pos])) {
            $pos++;
        }

        if (($input[$pos] ?? '') !== '(') {
            throw new \RuntimeException('Expected tuple start.');
        }

        $pos++;
        $values = [];

        while ($pos < strlen($input)) {
            while ($pos < strlen($input) && ctype_space($input[$pos])) {
                $pos++;
            }

            if ($input[$pos] === ')') {
                $pos++;
                break;
            }

            if ($values !== []) {
                if ($input[$pos] !== ',') {
                    throw new \RuntimeException('Expected comma in tuple.');
                }

                $pos++;
                while ($pos < strlen($input) && ctype_space($input[$pos])) {
                    $pos++;
                }
            }

            if ($input[$pos] === "'") {
                $values[] = $this->parseSqlString($input, $pos);
                continue;
            }

            if (str_starts_with(substr($input, $pos), 'NULL')) {
                $values[] = null;
                $pos += 4;
                continue;
            }

            if (preg_match('/^-?\d+(?:\.\d+)?/', substr($input, $pos), $match)) {
                $values[] = str_contains($match[0], '.') ? (float) $match[0] : (int) $match[0];
                $pos += strlen($match[0]);
                continue;
            }

            throw new \RuntimeException('Unexpected tuple value.');
        }

        return $values;
    }

    private function parseSqlString(string $input, int &$pos): string
    {
        if (($input[$pos] ?? '') !== "'") {
            throw new \RuntimeException('Expected string start.');
        }

        $pos++;
        $value = '';

        while ($pos < strlen($input)) {
            $ch = $input[$pos];

            if ($ch === '\\') {
                $pos++;
                if ($pos < strlen($input)) {
                    $value .= $input[$pos];
                    $pos++;
                }
                continue;
            }

            if ($ch === "'") {
                if (($input[$pos + 1] ?? '') === "'") {
                    $value .= "'";
                    $pos += 2;
                    continue;
                }

                $pos++;
                return $value;
            }

            $value .= $ch;
            $pos++;
        }

        throw new \RuntimeException('Unterminated SQL string.');
    }
}
