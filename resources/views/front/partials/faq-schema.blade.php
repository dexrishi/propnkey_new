{{-- FAQPage JSON-LD: only render when valid Q&A items exist --}}
@php
    $schemaFaqs = collect($faqItems ?? [])
        ->map(function ($item) {
            if (is_object($item)) {
                return [
                    'question' => $item->question ?? '',
                    'answer' => $item->answer ?? '',
                ];
            }

            return [
                'question' => $item['question'] ?? '',
                'answer' => $item['answer'] ?? '',
            ];
        })
        ->map(function ($item) {
            return [
                'question' => trim(html_entity_decode(strip_tags((string) $item['question']), ENT_QUOTES | ENT_HTML5, 'UTF-8')),
                'answer' => trim(html_entity_decode(strip_tags((string) $item['answer']), ENT_QUOTES | ENT_HTML5, 'UTF-8')),
            ];
        })
        ->filter(function ($item) {
            return $item['question'] !== '' && $item['answer'] !== '';
        })
        ->values();

    $faqSchema = null;
    if ($schemaFaqs->isNotEmpty()) {
        $faqSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $schemaFaqs->map(function ($item) {
                return [
                    '@type' => 'Question',
                    'name' => $item['question'],
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $item['answer'],
                    ],
                ];
            })->all(),
        ];
    }
@endphp

@if($faqSchema)
<script type="application/ld+json">
{!! json_encode($faqSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endif
