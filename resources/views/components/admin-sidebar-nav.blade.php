<nav class="nav flex-column admin-sidebar-nav p-2">
    @foreach($menuItems as $item)
        @if(($item['type'] ?? 'link') === 'group')
            @php
                $collapseId = $prefix . '-' . $item['id'];
                $isOpen = !empty($item['active']);
            @endphp
            <div class="admin-nav-group {{ $isOpen ? 'is-open' : '' }}">
                <button class="nav-link admin-nav-toggle {{ $isOpen ? 'active-group' : '' }}"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#{{ $collapseId }}"
                        aria-expanded="{{ $isOpen ? 'true' : 'false' }}"
                        aria-controls="{{ $collapseId }}">
                    <span class="admin-nav-toggle-label">
                        <i class="bi {{ $item['icon'] }} me-2"></i>{{ $item['label'] }}
                    </span>
                    <i class="bi bi-chevron-down admin-nav-caret"></i>
                </button>
                <div class="collapse {{ $isOpen ? 'show' : '' }}" id="{{ $collapseId }}">
                    <div class="admin-nav-children">
                        @foreach($item['children'] as $child)
                            <a class="nav-link admin-nav-child {{ !empty($child['active']) ? 'active' : '' }}"
                               href="{{ route($child['route']) }}">
                                <i class="bi {{ $child['icon'] }} me-2"></i>{{ $child['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <a class="nav-link {{ !empty($item['active']) ? 'active' : '' }}" href="{{ route($item['route']) }}">
                <i class="bi {{ $item['icon'] }} me-2"></i>{{ $item['label'] }}
            </a>
        @endif
    @endforeach
</nav>
