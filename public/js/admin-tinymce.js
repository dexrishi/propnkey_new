(function () {
    'use strict';

    if (typeof tinymce === 'undefined') {
        console.error('TinyMCE is not loaded.');
        return;
    }

    const TINYMCE_BASE = (document.currentScript && document.currentScript.src)
        ? document.currentScript.src.replace(/\/admin-tinymce\.js(\?.*)?$/, '/tinymce')
        : '/js/tinymce';

    // Prefer asset path from a data attribute if present
    const configuredBase = document.querySelector('meta[name="tinymce-base"]')?.content;
    const baseUrl = configuredBase || TINYMCE_BASE;

    const defaultConfig = {
        base_url: baseUrl,
        suffix: '.min',
        license_key: 'gpl',
        menubar: 'file edit view insert format tools table',
        plugins:
            'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount emoticons',
        toolbar:
            'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist outdent indent | emoticons charmap removeformat',
        font_size_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt',
        font_family_formats:
            'System Font=-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif;' +
            'Arial=arial,helvetica,sans-serif;' +
            'Georgia=georgia,palatino,serif;' +
            'Times New Roman=times new roman,times,serif;' +
            'Courier New=courier new,courier,monospace;' +
            'Verdana=verdana,geneva,sans-serif',
        height: 280,
        min_height: 180,
        resize: true,
        branding: true,
        promotion: false,
        convert_urls: false,
        relative_urls: false,
        remove_script_host: false,
        content_style:
            'body { font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif; font-size: 14px; line-height: 1.6; }',
    };

    function resolveElement(elementOrConfig) {
        if (typeof elementOrConfig === 'string') {
            return document.querySelector(elementOrConfig);
        }

        if (elementOrConfig instanceof HTMLElement) {
            return elementOrConfig;
        }

        if (elementOrConfig && elementOrConfig.attachTo) {
            const attachTo = elementOrConfig.attachTo;
            return typeof attachTo === 'string' ? document.querySelector(attachTo) : attachTo;
        }

        return null;
    }

    function ensureTextareaId(element) {
        if (!element.id) {
            element.id = 'tinymce_' + Math.random().toString(36).slice(2, 10);
        }
        return element.id;
    }

    function buildEditorApi(editor, element) {
        return {
            getData: function () {
                return editor.getContent();
            },
            setData: function (html) {
                editor.setContent(html || '');
            },
            updateSourceElement: function () {
                editor.save();
            },
            destroy: function () {
                return new Promise(function (resolve) {
                    editor.remove();
                    resolve();
                });
            },
            sourceElement: element,
            model: {
                document: {
                    on: function () {},
                },
            },
            _tinymce: editor,
        };
    }

    function getTinyConfig(overrides) {
        overrides = overrides || {};

        // Ignore CKEditor-style toolbar objects; TinyMCE uses its own toolbar string
        const { toolbar, table, language, licenseKey, ...rest } = overrides;

        return Object.assign({}, defaultConfig, rest);
    }

    window.getAdminCkeditorConfig = function (overrides) {
        return getTinyConfig(overrides);
    };

    window.getAdminTinymceConfig = function (overrides) {
        return getTinyConfig(overrides);
    };

    window.createAdminClassicEditor = function (elementOrConfig, maybeConfig) {
        const element = resolveElement(elementOrConfig);
        const config =
            maybeConfig ||
            (elementOrConfig && !(elementOrConfig instanceof HTMLElement) && typeof elementOrConfig !== 'string'
                ? elementOrConfig
                : {});

        if (!element) {
            return Promise.reject(new Error('TinyMCE: target element not found.'));
        }

        // Hidden fields break TinyMCE sizing/layout — skip until visible
        const isVisible = !!(element.offsetWidth || element.offsetHeight || element.getClientRects().length);
        if (!isVisible) {
            return Promise.resolve({
                getData: function () { return element.value || ''; },
                setData: function (html) { element.value = html || ''; },
                updateSourceElement: function () {},
                destroy: function () { return Promise.resolve(); },
                sourceElement: element,
                model: { document: { on: function () {} } },
                _skippedHidden: true,
            });
        }

        // Already initialized
        const existing = tinymce.get(element.id);
        if (existing) {
            return Promise.resolve(buildEditorApi(existing, element));
        }

        const id = ensureTextareaId(element);
        const initConfig = getTinyConfig(config);

        return new Promise(function (resolve, reject) {
            tinymce
                .init(
                    Object.assign({}, initConfig, {
                        target: element,
                        setup: function (editor) {
                            editor.on('init', function () {
                                resolve(buildEditorApi(editor, element));
                            });
                        },
                    })
                )
                .then(function (editors) {
                    if (!editors || !editors.length) {
                        reject(new Error('TinyMCE failed to initialize on #' + id));
                    }
                })
                .catch(reject);
        });
    };

    window.ClassicEditor = {
        create: function (elementOrConfig, maybeConfig) {
            return window.createAdminClassicEditor(elementOrConfig, maybeConfig);
        },
    };

    // Sync all TinyMCE instances into their textareas before any form submit
    document.addEventListener(
        'submit',
        function () {
            if (typeof tinymce !== 'undefined') {
                tinymce.triggerSave();
            }
        },
        true
    );
})();
