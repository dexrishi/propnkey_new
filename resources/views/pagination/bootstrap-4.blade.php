@if ($paginator->hasPages())
    <nav aria-label="Property pagination">
        <ul class="pagination justify-content-center custom-pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link prev-next-btn" aria-hidden="true">
                        <i class="fa fa-angle-left"></i>
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link prev-next-btn" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <i class="fa fa-angle-left"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link dots">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link page-number active">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link page-number" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link prev-next-btn" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link prev-next-btn" aria-hidden="true">
                        <i class="fa fa-angle-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>

    <style>
    .custom-pagination {
        margin: 40px 0;
        padding: 0;
    }

    .custom-pagination .page-item {
        margin: 0 5px;
    }

    .custom-pagination .page-link {
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        padding: 12px 16px;
        font-weight: 600;
        font-size: 14px;
        color: #666;
        background: #fff;
        transition: all 0.3s ease;
        text-decoration: none;
        min-width: 45px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .custom-pagination .page-link:hover {
        background: #007bff;
        color: #fff;
        border-color: #007bff;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
    }

    .custom-pagination .page-item.active .page-link {
        background: #007bff;
        color: #fff;
        border-color: #007bff;
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.4);
    }

    .custom-pagination .page-item.disabled .page-link {
        background: #f8f9fa;
        color: #adb5bd;
        border-color: #e9ecef;
        cursor: not-allowed;
    }

    .custom-pagination .page-item.disabled .page-link:hover {
        background: #f8f9fa;
        color: #adb5bd;
        border-color: #e9ecef;
        transform: none;
        box-shadow: none;
    }

    .custom-pagination .prev-next-btn {
        padding: 12px 14px;
        min-width: 45px;
    }

    .custom-pagination .prev-next-btn i {
        font-size: 16px;
        font-weight: bold;
    }
    
    .custom-pagination .prev-next-btn i.fa {
        display: inline-block;
    }

    .custom-pagination .dots {
        border: none;
        background: transparent;
        color: #999;
        font-weight: normal;
        padding: 12px 8px;
        min-width: auto;
    }

    .custom-pagination .dots:hover {
        background: transparent;
        color: #999;
        border: none;
        transform: none;
        box-shadow: none;
    }

    /* Mobile responsive */
    @media (max-width: 768px) {
        .custom-pagination .page-item {
            margin: 0 2px;
        }
        
        .custom-pagination .page-link {
            padding: 10px 12px;
            font-size: 13px;
            min-width: 40px;
        }
        
        .custom-pagination .prev-next-btn {
            padding: 10px 12px;
            min-width: 40px;
        }
    }

    @media (max-width: 576px) {
        .custom-pagination .page-item {
            margin: 0 1px;
        }
        
        .custom-pagination .page-link {
            padding: 8px 10px;
            font-size: 12px;
            min-width: 35px;
        }
        
        .custom-pagination .prev-next-btn {
            padding: 8px 10px;
            min-width: 35px;
        }
    }
    </style>
@endif
