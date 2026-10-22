<script>
document.addEventListener('DOMContentLoaded', function () {
    const categorySelect = document.getElementById('property_category_id');
    const typeSelect = document.getElementById('property_type_id');

    if (!categorySelect || !typeSelect || categorySelect.tagName !== 'SELECT' || typeSelect.tagName !== 'SELECT') {
        return;
    }

    const placeholderText = (typeSelect.querySelector('option[value=""]') || {}).textContent || 'Select Property Type';
    const allTypeOptions = Array.from(typeSelect.querySelectorAll('option[data-category-id]')).map(function (option) {
        return {
            value: option.value,
            label: option.textContent.trim(),
            categoryId: String(option.getAttribute('data-category-id') || ''),
        };
    });

    // Map category id -> slug from options
    const categorySlugById = {};
    Array.from(categorySelect.querySelectorAll('option[value]:not([value=""])')).forEach(function (option) {
        categorySlugById[String(option.value)] = String(option.getAttribute('data-slug') || '').toLowerCase();
    });

    // Resolve Residential / Commercial category IDs by slug
    function findCategoryIdBySlug(slug) {
        const target = String(slug || '').toLowerCase();
        for (const id in categorySlugById) {
            if (categorySlugById[id] === target) {
                return id;
            }
        }
        return null;
    }

    function allowedCategoryIdsFor(selectedCategoryId) {
        if (!selectedCategoryId) {
            return null; // show all
        }

        const selectedSlug = categorySlugById[selectedCategoryId] || '';
        // Resale & Rental use Residential + Commercial property types
        if (selectedSlug === 'resale' || selectedSlug === 'rental') {
            const residentialId = findCategoryIdBySlug('residential');
            const commercialId = findCategoryIdBySlug('commercial');
            return [residentialId, commercialId].filter(Boolean);
        }

        return [selectedCategoryId];
    }

    function filterPropertyTypes() {
        const categoryId = String(categorySelect.value || '');
        const previousType = String(typeSelect.value || '');
        const allowedIds = allowedCategoryIdsFor(categoryId);

        typeSelect.innerHTML = '';
        const empty = document.createElement('option');
        empty.value = '';
        empty.textContent = placeholderText;
        typeSelect.appendChild(empty);

        let matchedPrevious = false;
        allTypeOptions.forEach(function (item) {
            if (allowedIds && allowedIds.indexOf(item.categoryId) === -1) {
                return;
            }
            const option = document.createElement('option');
            option.value = item.value;
            option.textContent = item.label;
            option.setAttribute('data-category-id', item.categoryId);
            typeSelect.appendChild(option);
            if (item.value === previousType) {
                matchedPrevious = true;
            }
        });

        typeSelect.value = matchedPrevious ? previousType : '';
    }

    categorySelect.addEventListener('change', filterPropertyTypes);
    filterPropertyTypes();
});
</script>
