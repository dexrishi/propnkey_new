{{-- Expects: $permissionCatalog, $selectedPermissions (array of keys), $applyDefaultsOnRoleChange (bool) --}}
@php
    $selectedPermissions = $selectedPermissions ?? [];
    $applyDefaultsOnRoleChange = $applyDefaultsOnRoleChange ?? false;
    $roleDefaults = [
        'admin' => \App\Support\AdminPermissions::defaultsForRole('admin'),
        'seo' => \App\Support\AdminPermissions::defaultsForRole('seo'),
        'super_admin' => \App\Support\AdminPermissions::defaultsForRole('super_admin'),
    ];
@endphp

<div class="card mt-4" id="permissions-card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h5 class="card-title mb-0">Page Permissions</h5>
        <div class="btn-group btn-group-sm">
            <button type="button" class="btn btn-outline-primary" id="perm-select-all">Select All</button>
            <button type="button" class="btn btn-outline-secondary" id="perm-clear-all">Clear All</button>
        </div>
    </div>
    <div class="card-body">
        <p class="text-muted small mb-3">
            Select which admin pages this user can access after login. Super Admin always has full access.
            Dashboard and Profile are always available.
        </p>
        <div class="alert alert-light border py-2 mb-3" id="selected-role-banner">
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <span class="text-muted small">Selected role:</span>
                <span class="badge bg-secondary" id="selected-role-badge">—</span>
                <span class="small text-muted" id="selected-role-hint"></span>
            </div>
        </div>
        @error('permissions')
            <div class="alert alert-danger py-2">{{ $message }}</div>
        @enderror
        <div class="row g-2">
            @foreach($permissionCatalog as $key => $meta)
                <div class="col-md-6 col-lg-4">
                    <div class="form-check border rounded px-3 py-2 h-100 {{ $key === 'redirections' ? 'border-primary' : '' }}">
                        <input class="form-check-input permission-checkbox"
                               type="checkbox"
                               name="permissions[]"
                               value="{{ $key }}"
                               id="perm_{{ $key }}"
                               {{ in_array($key, $selectedPermissions, true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="perm_{{ $key }}">
                            <i class="bi {{ $meta['icon'] ?? 'bi-circle' }} me-1"></i>{{ $meta['label'] }}
                            @if(!empty($meta['path']))
                                <div class="small text-muted"><code>{{ $meta['path'] }}</code></div>
                            @endif
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.getElementById('role');
    const permissionsCard = document.getElementById('permissions-card');
    const applyDefaultsOnRoleChange = @json($applyDefaultsOnRoleChange);
    const checkboxes = () => document.querySelectorAll('.permission-checkbox');
    const roleDefaults = @json($roleDefaults);

    const roleMeta = {
        super_admin: { label: 'Super Admin', badge: 'bg-danger', hint: 'Full access to all pages. Permissions are not required.' },
        admin: { label: 'Admin', badge: 'bg-primary', hint: 'Can access only the pages you tick below (including /redirections).' },
        seo: { label: 'SEO', badge: 'bg-warning text-dark', hint: 'Can edit content but cannot delete. Includes /redirections by default.' },
    };

    function updateSelectedRoleBanner() {
        const badge = document.getElementById('selected-role-badge');
        const hint = document.getElementById('selected-role-hint');
        if (!badge || !hint || !roleSelect) return;

        const meta = roleMeta[roleSelect.value];
        if (!meta) {
            badge.className = 'badge bg-secondary';
            badge.textContent = 'Select a role';
            hint.textContent = '';
            return;
        }

        badge.className = 'badge ' + meta.badge;
        badge.textContent = meta.label;
        hint.textContent = meta.hint;
    }

    function togglePermissionsVisibility() {
        if (!roleSelect || !permissionsCard) return;
        const isSuper = roleSelect.value === 'super_admin';
        permissionsCard.style.display = isSuper ? 'none' : '';
        checkboxes().forEach(cb => { cb.disabled = isSuper; });
        updateSelectedRoleBanner();
    }

    function applyRoleDefaults(role) {
        const defaults = roleDefaults[role] || [];
        checkboxes().forEach(cb => {
            cb.checked = defaults.includes(cb.value);
        });
    }

    document.getElementById('perm-select-all')?.addEventListener('click', function () {
        checkboxes().forEach(cb => { if (!cb.disabled) cb.checked = true; });
    });
    document.getElementById('perm-clear-all')?.addEventListener('click', function () {
        checkboxes().forEach(cb => { if (!cb.disabled) cb.checked = false; });
    });

    roleSelect?.addEventListener('change', function () {
        togglePermissionsVisibility();
        if (applyDefaultsOnRoleChange && this.value && this.value !== 'super_admin') {
            applyRoleDefaults(this.value);
        }
    });

    togglePermissionsVisibility();
});
</script>
