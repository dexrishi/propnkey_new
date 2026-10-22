@extends('layouts.admin')

@section('title', 'Create User')

@section('content')

                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h1 class="h3 mb-1">Create New User</h1>
                                <p class="text-muted mb-0">Add a new system user and assign page permissions</p>
                            </div>
                            <div>
                                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Back to Users
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">User Details</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('users.store') }}">
                                    @csrf
                                    
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name') }}" 
                                               required 
                                               autofocus
                                               placeholder="e.g., John Doe">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" 
                                               class="form-control @error('email') is-invalid @enderror" 
                                               id="email" 
                                               name="email" 
                                               value="{{ old('email') }}" 
                                               required
                                               placeholder="e.g., john@example.com">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="role" class="form-label">
                                            Role <span class="text-danger">*</span>
                                            <span class="badge bg-primary ms-2" id="role-inline-badge">Admin</span>
                                        </label>
                                        <select class="form-select @error('role') is-invalid @enderror" 
                                                id="role" 
                                                name="role" 
                                                required>
                                            <option value="">Select Role</option>
                                            <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                            <option value="admin" {{ old('role', 'admin') == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="seo" {{ old('role') == 'seo' ? 'selected' : '' }}>SEO</option>
                                        </select>
                                        <div class="form-text" id="role-inline-hint">Access only the pages you tick below, including /redirections.</div>
                                        @error('role')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                        <input type="password" 
                                               class="form-control @error('password') is-invalid @enderror" 
                                               id="password" 
                                               name="password" 
                                               required
                                               minlength="8"
                                               placeholder="Minimum 8 characters">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" 
                                               class="form-control" 
                                               id="password_confirmation" 
                                               name="password_confirmation" 
                                               required
                                               minlength="8"
                                               placeholder="Re-enter password">
                                    </div>

                                    @include('admin.users._permissions', [
                                        'permissionCatalog' => $permissionCatalog,
                                        'selectedPermissions' => old('permissions', $defaultPermissions),
                                        'applyDefaultsOnRoleChange' => true,
                                    ])

                                    <div class="d-flex gap-2 mt-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-circle me-2"></i>Create User
                                        </button>
                                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                                            <i class="bi bi-x-circle me-2"></i>Cancel
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Help Panel -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Role Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3 role-info-item" data-role="super_admin">
                                    <strong>Super Admin</strong>
                                    <p class="small text-muted mb-1">Full access + user management. Permissions not required.</p>
                                </div>
                                
                                <div class="mb-3 role-info-item" data-role="admin">
                                    <strong>Admin</strong>
                                    <p class="small text-muted mb-1">Access only the pages you tick below, including <code>/redirections</code>.</p>
                                </div>

                                <div class="mb-3 role-info-item" data-role="seo">
                                    <strong>SEO</strong>
                                    <p class="small text-muted mb-1">Can edit content but cannot delete. Defaults include <code>/redirections</code>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.getElementById('role');
    const badge = document.getElementById('role-inline-badge');
    const hint = document.getElementById('role-inline-hint');
    const meta = {
        super_admin: { label: 'Super Admin', badge: 'bg-danger', hint: 'Full access to all pages. Permissions are not required.' },
        admin: { label: 'Admin', badge: 'bg-primary', hint: 'Access only the pages you tick below, including /redirections.' },
        seo: { label: 'SEO', badge: 'bg-warning text-dark', hint: 'Can edit content but cannot delete. Includes /redirections by default.' },
    };

    function syncRoleUi() {
        const current = meta[roleSelect?.value] || null;
        if (badge) {
            badge.className = 'badge ms-2 ' + (current ? current.badge : 'bg-secondary');
            badge.textContent = current ? current.label : 'Select role';
        }
        if (hint) {
            hint.textContent = current ? current.hint : 'Choose a role to see what access this user will get.';
        }
        document.querySelectorAll('.role-info-item').forEach(item => {
            const active = current && item.dataset.role === roleSelect.value;
            item.classList.toggle('border', active);
            item.classList.toggle('rounded', active);
            item.classList.toggle('p-2', active);
            item.classList.toggle('bg-light', active);
        });
    }

    roleSelect?.addEventListener('change', syncRoleUi);
    syncRoleUi();
});
</script>
@endpush
