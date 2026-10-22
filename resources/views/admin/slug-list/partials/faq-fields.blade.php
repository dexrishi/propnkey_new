@php
    $oldQuestions = old('faq_questions');
    $oldAnswers = old('faq_answers');
    $faqItems = [];

    if (is_array($oldQuestions) || is_array($oldAnswers)) {
        $questionRows = is_array($oldQuestions) ? $oldQuestions : [];
        $answerRows = is_array($oldAnswers) ? $oldAnswers : [];
        $rowCount = max(count($questionRows), count($answerRows));

        for ($index = 0; $index < $rowCount; $index++) {
            $faqItems[] = [
                'question' => $questionRows[$index] ?? '',
                'answer' => $answerRows[$index] ?? '',
            ];
        }
    } elseif (isset($slugList) && !empty($slugList->faq_items)) {
        $faqItems = collect($slugList->faq_items)
            ->map(function ($faqItem) {
                return [
                    'question' => $faqItem['question'] ?? '',
                    'answer' => $faqItem['answer'] ?? '',
                ];
            })
            ->all();
    }

    if (empty($faqItems)) {
        $faqItems = [['question' => '', 'answer' => '']];
    }
@endphp

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Page FAQs</h5>
        <button type="button" class="btn btn-sm btn-outline-primary" id="addSlugFaqRow">
            <i class="bi bi-plus-circle me-1"></i>Add FAQ
        </button>
    </div>
    <div class="card-body">
        <div id="slugFaqRowsContainer">
            @foreach($faqItems as $index => $faqItem)
                <div class="border rounded p-3 mb-3 slug-faq-row" data-index="{{ $index }}">
                    <div class="row g-3 align-items-start">
                        <div class="col-md-5">
                            <label class="form-label">Question</label>
                            <input type="text" class="form-control" name="faq_questions[]" value="{{ $faqItem['question'] }}" placeholder="Enter FAQ question">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Answer</label>
                            <textarea class="form-control" name="faq_answers[]" rows="2" placeholder="Enter FAQ answer">{{ $faqItem['answer'] }}</textarea>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label d-block">&nbsp;</label>
                            <button type="button" class="btn btn-outline-danger w-100 remove-slug-faq-row">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="form-text">Question aur answer dono filled honge tabhi FAQ save hoga. Ye listing pages ke slug par based hoga, jaise location, category, category + location, category + type, etc.</div>
    </div>
</div>