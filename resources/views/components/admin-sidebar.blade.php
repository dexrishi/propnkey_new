<!-- Sidebar - Desktop -->
<div class="col-md-3 col-lg-2 d-none d-md-block">
    <div class="card admin-sidebar-card">
        <div class="card-body p-0">
            @include('components.admin-sidebar-nav', ['menuItems' => $menuItems, 'prefix' => 'desktop'])
            @if(!empty($canUsePropertyTools))
            <div class="border-top p-3">
                <p class="small text-muted mb-2 fw-semibold text-uppercase">Tools</p>
                <form action="{{ route('properties.images.regenerate-all-thumbnails') }}" method="POST"
                      onsubmit="return confirm('Regenerate thumbnails for ALL property images? This may take a few minutes.');">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-warning w-100">
                        <i class="bi bi-arrow-repeat me-1"></i>Regenerate All Thumbnails
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Mobile Sidebar Offcanvas -->
<div class="offcanvas offcanvas-start d-md-none" tabindex="-1" id="sidebarMenu">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">{{ config('app.name') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-0">
        @include('components.admin-sidebar-nav', ['menuItems' => $menuItems, 'prefix' => 'mobile'])
        @if(!empty($canUsePropertyTools))
        <div class="border-top p-3">
            <p class="small text-muted mb-2 fw-semibold text-uppercase">Tools</p>
            <form action="{{ route('properties.images.regenerate-all-thumbnails') }}" method="POST"
                  onsubmit="return confirm('Regenerate thumbnails for ALL property images? This may take a few minutes.');">
                @csrf
                <button type="submit" class="btn btn-sm btn-warning w-100">
                    <i class="bi bi-arrow-repeat me-1"></i>Regenerate All Thumbnails
                </button>
            </form>
        </div>
        @endif
    </div>
</div>
