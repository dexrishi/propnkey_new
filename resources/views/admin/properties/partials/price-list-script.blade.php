<script>
(function () {
    const wrap = document.getElementById('priceListEditorWrap');
    const insertBtn = document.getElementById('insertPriceListTableBtn');
    if (!wrap) {
        return;
    }

    let syncQueued = false;

    function escapeHtml(text) {
        return String(text || '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }

    function normalizeTypeKey(type) {
        return String(type || '').replace(/\s+/g, ' ').trim().toLowerCase();
    }

    function defaultTypes() {
        try {
            const parsed = JSON.parse(wrap.getAttribute('data-default-types') || '[]');
            return Array.isArray(parsed) && parsed.length ? parsed : ['3 BHK', '3.5 BHK', '4 BHK'];
        } catch (e) {
            return ['3 BHK', '3.5 BHK', '4 BHK'];
        }
    }

    function selectedBedroomNames() {
        return Array.from(document.querySelectorAll('input[name="bedroom_configs[]"]:checked'))
            .map(function (input) {
                const label = input.closest('label');
                const span = label ? label.querySelector('span') : null;
                return (span ? span.textContent : '').trim();
            })
            .filter(Boolean);
    }

    function getPriceListEditor() {
        if (typeof tinymce === 'undefined') {
            return null;
        }
        return tinymce.get('price_list');
    }

    function getCurrentHtml() {
        const editor = getPriceListEditor();
        if (editor) {
            return editor.getContent() || '';
        }
        const textarea = document.getElementById('price_list');
        return textarea ? (textarea.value || '') : '';
    }

    function parseExistingRows(html) {
        const map = {};
        if (!html || !/<table[\s>]/i.test(html)) {
            return map;
        }

        const doc = new DOMParser().parseFromString('<div id="root">' + html + '</div>', 'text/html');
        const root = doc.getElementById('root');
        if (!root) {
            return map;
        }

        root.querySelectorAll('table tr').forEach(function (tr) {
            const cells = Array.from(tr.querySelectorAll('th, td')).map(function (cell) {
                return (cell.textContent || '').replace(/\u00a0/g, ' ').replace(/\s+/g, ' ').trim();
            });
            if (cells.length < 2) {
                return;
            }

            const joined = cells.join(' ').toLowerCase();
            if (joined.includes('type') && (joined.includes('area') || joined.includes('price'))) {
                return;
            }

            const type = cells[0] || '';
            const area = cells[1] || '';
            const price = cells[cells.length - 1] || '';
            const key = normalizeTypeKey(type);
            if (!key) {
                return;
            }

            map[key] = {
                type: type,
                area: /get\s*quote|get\s*price/i.test(area) ? '' : area,
                price: /get\s*quote|get\s*price/i.test(price) ? '' : price,
            };
        });

        return map;
    }

    function buildPriceListTableHtml(types, existingMap) {
        const list = (types && types.length) ? types : defaultTypes();
        existingMap = existingMap || {};
        let rows = '';

        list.forEach(function (type) {
            const prev = existingMap[normalizeTypeKey(type)] || {};
            const area = prev.area || '';
            const price = prev.price || '';
            rows += '<tr>' +
                '<td>' + escapeHtml(type) + '</td>' +
                '<td>' + (area ? escapeHtml(area) : '&nbsp;') + '</td>' +
                '<td>' + (price ? escapeHtml(price) : '&nbsp;') + '</td>' +
                '</tr>';
        });

        return '<table style="border-collapse: collapse; width: 100%;" border="1">' +
            '<thead><tr>' +
            '<th>Type</th><th>Area (in SQ.FT)</th><th>Price</th>' +
            '</tr></thead><tbody>' + rows + '</tbody></table><p></p>';
    }

    function setHtml(html) {
        const editor = getPriceListEditor();
        const textarea = document.getElementById('price_list');
        if (editor) {
            editor.setContent(html);
            editor.save();
        } else if (textarea) {
            textarea.value = html;
        }
        wrap.setAttribute('data-has-content', '1');
    }

    /**
     * Build/update Price List rows from Step 1 Bedroom Configuration.
     * Preserves Area/Price for matching types unless reset=true.
     */
    window.syncPriceListFromBedrooms = function (options) {
        options = options || {};
        const reset = !!options.reset;
        const types = selectedBedroomNames();

        if (!types.length) {
            // No BHK selected — keep current content unless forced reset to empty template
            if (reset) {
                setHtml(buildPriceListTableHtml(defaultTypes(), {}));
            }
            return;
        }

        const existingMap = reset ? {} : parseExistingRows(getCurrentHtml());
        setHtml(buildPriceListTableHtml(types, existingMap));
    };

    window.ensurePriceListTable = function (force) {
        if (force) {
            window.syncPriceListFromBedrooms({ reset: true });
            return;
        }

        const types = selectedBedroomNames();
        if (!types.length) {
            return;
        }

        const html = getCurrentHtml();
        const text = String(html).replace(/<[^>]+>/g, ' ').replace(/\u00a0/g, ' ').replace(/\s+/g, ' ').trim();
        const hasTable = /<table[\s>]/i.test(html || '');

        // Empty editor, or table types don't match selected BHKs → sync from bedrooms
        if (!text || !hasTable) {
            window.syncPriceListFromBedrooms({ reset: false });
            return;
        }

        const existingMap = parseExistingRows(html);
        const existingKeys = Object.keys(existingMap).sort().join('|');
        const selectedKeys = types.map(normalizeTypeKey).sort().join('|');
        if (existingKeys !== selectedKeys) {
            window.syncPriceListFromBedrooms({ reset: false });
        }
    };

    function queueSyncFromBedrooms() {
        if (syncQueued) {
            return;
        }
        syncQueued = true;
        setTimeout(function () {
            syncQueued = false;
            // Always mirror Step 1 selection into Price List (keep filled area/price)
            window.syncPriceListFromBedrooms({ reset: false });
        }, 50);
    }

    document.addEventListener('change', function (event) {
        const input = event.target;
        if (!input || input.name !== 'bedroom_configs[]') {
            return;
        }
        queueSyncFromBedrooms();
    });

    if (insertBtn) {
        insertBtn.addEventListener('click', function () {
            window.syncPriceListFromBedrooms({ reset: true });
        });
    }
})();
</script>
