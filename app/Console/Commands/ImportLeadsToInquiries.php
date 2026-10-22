<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Inquiry;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ImportLeadsToInquiries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inquiries:import-leads 
                            {file=old/leads.json : Path to leads JSON file (relative to project root)}
                            {--dry-run : Run without inserting into database}
                            {--chunk=500 : Number of records per insert chunk}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import leads from leads.json into the inquiries table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = base_path($this->argument('file'));
        $dryRun = $this->option('dry-run');
        $chunkSize = (int) $this->option('chunk');

        $this->info('Importing leads from: ' . $filePath);

        if (!file_exists($filePath)) {
            $this->error('File not found: ' . $filePath);
            return 1;
        }

        $jsonContent = file_get_contents($filePath);
        $leads = json_decode($jsonContent, true);

        if (!is_array($leads)) {
            $this->error('Invalid JSON: expected an array of lead objects.');
            return 1;
        }

        $total = count($leads);
        $this->info('Found ' . $total . ' leads to import.');

        if ($dryRun) {
            $this->warn('DRY RUN – no data will be written.');
        }

        $skipped = 0;
        $imported = 0;
        $chunks = array_chunk($leads, $chunkSize);
        $bar = $this->output->createProgressBar($total);
        $bar->start();

        foreach ($chunks as $chunk) {
            $rows = [];
            foreach ($chunk as $lead) {
                $name = $this->trim($lead['name'] ?? '', 255);
                $email = $this->trim($lead['email'] ?? '', 150);
                $phone = $this->trim((string) ($lead['phone'] ?? ''), 20);

                if (empty($name) || empty($email) || empty($phone)) {
                    $skipped++;
                    $bar->advance();
                    continue;
                }

                $datetime = $lead['datetime'] ?? null;
                try {
                    $createdAt = $datetime ? Carbon::parse($datetime) : now();
                } catch (\Exception $e) {
                    $createdAt = now();
                }

                $rows[] = [
                    'name'         => $name,
                    'company'      => null,
                    'email'        => $email,
                    'phone'        => $phone,
                    'user_message' => $this->trim($lead['message'] ?? null, 65535),
                    'project_name' => null,
                    'form_name'    => $this->trim($lead['form_name'] ?? null, 255),
                    'url'          => $this->trim($lead['url'] ?? null, 500),
                    'status'       => 'new',
                    'notes'        => null,
                    'created_at'   => $createdAt->format('Y-m-d H:i:s'),
                    'updated_at'   => $createdAt->format('Y-m-d H:i:s'),
                ];
                $imported++;
                $bar->advance();
            }

            if (!$dryRun && !empty($rows)) {
                DB::table('inquiries')->insert($rows);
            }
        }

        $bar->finish();
        $this->newLine(2);
        $this->info('Done.');
        $this->table(
            ['Metric', 'Count'],
            [
                ['Imported', $imported],
                ['Skipped (missing name/email/phone)', $skipped],
                ['Total processed', $total],
            ]
        );

        return 0;
    }

    /**
     * Trim string to max length; null/empty stays null.
     */
    private function trim($value, int $maxLength): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }
        $s = trim((string) $value);
        if ($s === '') {
            return null;
        }
        if (strlen($s) <= $maxLength) {
            return $s;
        }
        return substr($s, 0, $maxLength);
    }
}
