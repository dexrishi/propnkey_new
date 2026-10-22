<script>
document.addEventListener('DOMContentLoaded', function () {
    const faqContainer = document.getElementById('slugFaqRowsContainer');
    const addFaqButton = document.getElementById('addSlugFaqRow');

    if (!faqContainer || !addFaqButton) {
        return;
    }

    function createFaqRow() {
        const row = document.createElement('div');
        row.className = 'border rounded p-3 mb-3 slug-faq-row';
        row.innerHTML = `
            <div class="row g-3 align-items-start">
                <div class="col-md-5">
                    <label class="form-label">Question</label>
                    <input type="text" class="form-control" name="faq_questions[]" placeholder="Enter FAQ question">
                </div>
                <div class="col-md-5">
                    <label class="form-label">Answer</label>
                    <textarea class="form-control" name="faq_answers[]" rows="2" placeholder="Enter FAQ answer"></textarea>
                </div>
                <div class="col-md-2">
                    <label class="form-label d-block">&nbsp;</label>
                    <button type="button" class="btn btn-outline-danger w-100 remove-slug-faq-row">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        `;

        return row;
    }

    addFaqButton.addEventListener('click', function () {
        faqContainer.appendChild(createFaqRow());
    });

    faqContainer.addEventListener('click', function (event) {
        const removeButton = event.target.closest('.remove-slug-faq-row');

        if (!removeButton) {
            return;
        }

        const rows = faqContainer.querySelectorAll('.slug-faq-row');
        const row = removeButton.closest('.slug-faq-row');

        if (rows.length === 1) {
            row.querySelector('input[name="faq_questions[]"]').value = '';
            row.querySelector('textarea[name="faq_answers[]"]').value = '';
            return;
        }

        row.remove();
    });
});
</script>