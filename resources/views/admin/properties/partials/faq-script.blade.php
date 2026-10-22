<script>
document.addEventListener('DOMContentLoaded', function() {
    const faqContainer = document.getElementById('faqRowsContainer');
    const addFaqButton = document.getElementById('addFaqRow');

    if (!faqContainer || !addFaqButton) {
        return;
    }

    const ckeditorConfig = window.getAdminCkeditorConfig({
        height: 180,
        min_height: 140,
        menubar: false,
        toolbar:
            'undo redo | bold italic underline | bullist numlist | link | removeformat',
    });

    function renumberFaqRows() {
        faqContainer.querySelectorAll('.faq-row').forEach(function (row, index) {
            row.setAttribute('data-index', index);
            const badge = row.querySelector('.faq-row-badge');
            const title = row.querySelector('.faq-row-head-title');
            if (badge) {
                badge.textContent = String(index + 1);
            }
            if (title) {
                title.textContent = 'FAQ #' + (index + 1);
            }
        });
    }

    function initFaqAnswerEditor(textarea) {
        if (!textarea || textarea._faqCkeditor) {
            return;
        }

        // Skip while inside a hidden wizard step — retry when step becomes active
        const inactiveStep = textarea.closest('.wizard-step:not(.is-active)');
        const hiddenParent = textarea.closest('[style*="display: none"], [hidden]');
        if (inactiveStep || hiddenParent) {
            return;
        }

        if (typeof tinymce !== 'undefined' && tinymce.get(textarea.id)) {
            textarea._faqCkeditor = {
                updateSourceElement: function () { tinymce.get(textarea.id).save(); },
                setData: function (html) { tinymce.get(textarea.id).setContent(html || ''); },
                destroy: function () {
                    return new Promise(function (resolve) {
                        tinymce.get(textarea.id)?.remove();
                        resolve();
                    });
                },
            };
            return;
        }

        ClassicEditor
            .create(textarea, ckeditorConfig)
            .then(function (editor) {
                if (editor && editor._skippedHidden) {
                    return;
                }
                textarea._faqCkeditor = editor;
            })
            .catch(function (error) {
                console.error('Error initializing editor for FAQ answer:', error);
            });
    }

    function destroyFaqAnswerEditor(textarea) {
        const editor = textarea && textarea._faqCkeditor;

        if (!editor) {
            if (textarea && typeof tinymce !== 'undefined' && textarea.id && tinymce.get(textarea.id)) {
                tinymce.get(textarea.id).remove();
            }
            return Promise.resolve();
        }

        return editor.destroy().then(function () {
            delete textarea._faqCkeditor;
        });
    }

    function syncFaqAnswerEditors() {
        faqContainer.querySelectorAll('.faq-answer-editor').forEach(function (textarea) {
            if (textarea._faqCkeditor && textarea._faqCkeditor.updateSourceElement) {
                textarea._faqCkeditor.updateSourceElement();
            }
        });
        if (typeof tinymce !== 'undefined') {
            tinymce.triggerSave();
        }
    }

    window.initFaqEditors = function initFaqEditors() {
        faqContainer.querySelectorAll('.faq-answer-editor').forEach(initFaqAnswerEditor);
    };

    window.initFaqEditors();

    function createFaqRow() {
        const row = document.createElement('div');
        row.className = 'faq-row';
        row.innerHTML = `
            <div class="faq-row-head">
                <div class="d-flex align-items-center gap-2">
                    <span class="faq-row-badge">1</span>
                    <p class="faq-row-head-title">FAQ #1</p>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger remove-faq-row" title="Remove FAQ">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
            <div class="mb-3">
                <label class="form-label">Question</label>
                <input type="text" class="form-control" name="faq_questions[]"
                       placeholder="e.g. Who is the developer of this project?">
            </div>
            <div class="mb-0">
                <label class="form-label">Answer</label>
                <textarea class="form-control faq-answer-editor" name="faq_answers[]" rows="4"
                          placeholder="Write a clear answer"></textarea>
            </div>
        `;

        faqContainer.appendChild(row);
        renumberFaqRows();
        initFaqAnswerEditor(row.querySelector('.faq-answer-editor'));

        return row;
    }

    addFaqButton.addEventListener('click', function () {
        createFaqRow();
    });

    faqContainer.addEventListener('click', function (event) {
        const removeButton = event.target.closest('.remove-faq-row');

        if (!removeButton) {
            return;
        }

        const rows = faqContainer.querySelectorAll('.faq-row');
        const row = removeButton.closest('.faq-row');
        const textarea = row.querySelector('.faq-answer-editor');

        if (rows.length === 1) {
            row.querySelector('input[name="faq_questions[]"]').value = '';

            if (textarea && textarea._faqCkeditor && textarea._faqCkeditor.setData) {
                textarea._faqCkeditor.setData('');
            } else if (textarea) {
                textarea.value = '';
            }

            return;
        }

        destroyFaqAnswerEditor(textarea).then(function () {
            row.remove();
            renumberFaqRows();
        });
    });

    const propertyForm = document.getElementById('propertyForm');

    if (propertyForm) {
        propertyForm.addEventListener('submit', function () {
            syncFaqAnswerEditors();
        });
    }
});
</script>
