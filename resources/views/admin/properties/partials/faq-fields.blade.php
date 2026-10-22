@php
    $oldQuestions = old('faq_questions');
    $oldAnswers = old('faq_answers');
    $faqItems = [];

    if (is_array($oldQuestions) || is_array($oldAnswers)) {
        $rowCount = max(count((array) $oldQuestions), count((array) $oldAnswers));
        for ($index = 0; $index < $rowCount; $index++) {
            $faqItems[] = [
                'question' => $oldQuestions[$index] ?? '',
                'answer' => $oldAnswers[$index] ?? '',
            ];
        }
    } elseif (isset($property) && $property->relationLoaded('faqs') && $property->faqs->count()) {
        $faqItems = $property->faqs->map(function ($faq) {
            return [
                'question' => $faq->question,
                'answer' => $faq->answer,
            ];
        })->values()->all();
    }

    if (empty($faqItems)) {
        $faqItems = [['question' => '', 'answer' => '']];
    }
@endphp

<style>
.faq-section-card .card-header {
    background: #fafbfa;
}
.faq-row {
    background: #fff;
    border: 1px solid #e4e8e5 !important;
    border-radius: 12px !important;
    padding: 1rem 1.1rem !important;
    margin-bottom: 0.85rem;
    transition: border-color 0.15s ease, box-shadow 0.15s ease;
}
.faq-row:hover {
    border-color: #c5d0c9 !important;
    box-shadow: 0 2px 8px rgba(26, 31, 28, 0.04);
}
.faq-row-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.75rem;
    margin-bottom: 0.85rem;
    padding-bottom: 0.65rem;
    border-bottom: 1px solid #eef1ef;
}
.faq-row-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 28px;
    height: 28px;
    padding: 0 0.5rem;
    border-radius: 8px;
    background: #e8f5ef;
    color: #1f6b4a;
    font-size: 0.8rem;
    font-weight: 700;
}
.faq-row-head-title {
    font-size: 0.9rem;
    font-weight: 650;
    color: #1a1f1c;
    margin: 0;
}
.faq-row .form-label {
    font-size: 0.82rem;
    font-weight: 600;
    color: #4a524d;
    margin-bottom: 0.35rem;
}
.faq-row .remove-faq-row {
    border-radius: 8px;
    padding: 0.3rem 0.55rem;
}
.faq-empty-hint {
    color: #6b746f;
    font-size: 0.86rem;
}
</style>

<div class="card mb-4 faq-section-card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h5 class="card-title mb-0">Property FAQs</h5>
            <small class="text-muted">Add common questions buyers ask about this property</small>
        </div>
        <button type="button" class="btn btn-sm btn-outline-primary" id="addFaqRow">
            <i class="bi bi-plus-circle me-1"></i>Add FAQ
        </button>
    </div>
    <div class="card-body">
        <div id="faqRowsContainer">
            @foreach($faqItems as $index => $faqItem)
                <div class="faq-row" data-index="{{ $index }}">
                    <div class="faq-row-head">
                        <div class="d-flex align-items-center gap-2">
                            <span class="faq-row-badge">{{ $index + 1 }}</span>
                            <p class="faq-row-head-title">FAQ #{{ $index + 1 }}</p>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-faq-row" title="Remove FAQ">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Question</label>
                        <input type="text" class="form-control" name="faq_questions[]"
                               value="{{ $faqItem['question'] }}"
                               placeholder="e.g. Who is the developer of this project?">
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Answer</label>
                        <textarea class="form-control faq-answer-editor" name="faq_answers[]" rows="4"
                                  placeholder="Write a clear answer">{{ $faqItem['answer'] }}</textarea>
                    </div>
                </div>
            @endforeach
        </div>
        <p class="faq-empty-hint mb-0 mt-1">
            <i class="bi bi-info-circle me-1"></i>
            Question aur answer dono filled honge tabhi FAQ save hoga.
        </p>
    </div>
</div>
