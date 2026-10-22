<!-- header -->
<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-8 align-self-center">
                <a href="{{ route('home') }}">
                    <img src="{{ asset(\App\Helpers\SiteConfigHelper::siteLogo()) }}" alt="{{ \App\Helpers\SiteConfigHelper::siteName() }}">
                </a>
            </div>
            <div class="col-md-2 col-4 align-self-center">
            <div id="nav-icon3">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas" id="myDiv" style="display: none;">
    <div class="container">
        <div class="row">
            <!-- Desktop: Left Column (Text & Contact) -->
            <div class="col-md-6 leftbar-desktop">
                <div class="leftbar">
                    <div class="navbar19_tagline">{!! \App\Helpers\SiteConfigHelper::headerTagline() !!}</div>
                    <div class="navbar19_company-name">{{ \App\Helpers\SiteConfigHelper::companyName() }}<br></div>
                    <div class="navbar-contact-details">
                        <div class="navbar-contact-row_component">
                            <div class="navbar-contact-row_key">office</div>
                            <div class="navbar-contact-row_value"><a href="tel:{{ \App\Helpers\SiteConfigHelper::officePhone() }}" class="navbar-contact-row_value-link">{{ \App\Helpers\SiteConfigHelper::officePhone() }}</a></div>
                        </div>
                    </div>
                    <div class="navbar-contact-row_component">
                        <div class="navbar-contact-row_key">e-mail<br></div>
                        <div class="navbar-contact-row_value-link"><a href="mailto:{{ \App\Helpers\SiteConfigHelper::contactEmail() }}" class="navbar-contact-row_value-link">{{ \App\Helpers\SiteConfigHelper::contactEmail() }}</a></div>
                    </div>
                    <div class="navbar-contact-row_component">
                        <div class="navbar-contact-row_key">address<br></div>
                        <div class="navbar-contact-row_value-link">{!! \App\Helpers\SiteConfigHelper::officeAddress() !!}</div>
                    </div>
                    <div class="undersec">
                        <div class="copy">
                            <p>{{ \App\Helpers\SiteConfigHelper::copyrightText() }}</p>
                        </div>
                        <div class="Priva">
                            <p><a href="{{ \App\Helpers\SiteConfigHelper::get('privacy_policy_url', '#') }}" class="text-white">Privacy Policy</a></p>
                        </div>
                        <div class="social">
                            <ul>
                                @php $socialUrls = \App\Helpers\SiteConfigHelper::socialUrls(); @endphp
                                <li><a href="{{ $socialUrls['facebook'] }}"><i class="fab fa-facebook"></i></a></li>
                                <li><a href="{{ $socialUrls['instagram'] }}"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="{{ $socialUrls['linkedin'] }}"><i class="fab fa-linkedin"></i></a></li>
                                <li><a href="{{ $socialUrls['youtube'] }}"><i class="fab fa-youtube"></i></a></li>
                                <li><a href="{{ $socialUrls['tiktok'] }}"><i class="fab fa-tiktok"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Desktop: Right Column (Menu) -->
            <div class="col-md-6 navlisk-desktop">
                <div class="navlisk">
                    <ul>
                        @if(isset($menus) && $menus->count() > 0)
                            @foreach($menus as $menu)
                                <li>
                                    @if($menu->hasChildren())
                                        <a href="{{ $menu->url ?: '#' }}" class="dropdown-toggle" data-toggle="dropdown">
                                            {{ $menu->title }}
                                        </a>
                                        <ul class="dropdown-menu">
                                            @foreach($menu->children as $child)
                                                <li><a href="{{ $child->url ?: '#' }}">{{ $child->title }}</a></li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <a href="{{ $menu->url ?: '#' }}">{{ $menu->title }}</a>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            
            <!-- Mobile: Reordered Layout (Text, Menu, Contact) -->
            <div class="col-md-12 mobile-menu-order">
                <!-- Text (Tagline) - First -->
                <div class="navbar19_tagline mobile-tagline">{!! \App\Helpers\SiteConfigHelper::headerTagline() !!}</div>
                
                <!-- Menu - Second -->
                <div class="navlisk mobile-menu">
                    <ul>
                        @if(isset($menus) && $menus->count() > 0)
                            @foreach($menus as $menu)
                                <li>
                                    @if($menu->hasChildren())
                                        <a href="{{ $menu->url ?: '#' }}" class="dropdown-toggle" data-toggle="dropdown">
                                            {{ $menu->title }}
                                        </a>
                                        <ul class="dropdown-menu">
                                            @foreach($menu->children as $child)
                                                <li><a href="{{ $child->url ?: '#' }}">{{ $child->title }}</a></li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <a href="{{ $menu->url ?: '#' }}">{{ $menu->title }}</a>
                                    @endif
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                
                <!-- Contact Details - Third -->
                <div class="navbar-contact-details mobile-contact">
                    <!-- Company Name above office phone -->
                    <div class="navbar19_company-name mobile-company-name">{{ \App\Helpers\SiteConfigHelper::companyName() }}<br></div>
                    <div class="navbar-contact-row_component">
                        <div class="navbar-contact-row_key">office</div>
                        <div class="navbar-contact-row_value"><a href="tel:{{ \App\Helpers\SiteConfigHelper::officePhone() }}" class="navbar-contact-row_value-link">{{ \App\Helpers\SiteConfigHelper::officePhone() }}</a></div>
                    </div>
                    <div class="navbar-contact-row_component">
                        <div class="navbar-contact-row_key">e-mail<br></div>
                        <div class="navbar-contact-row_value-link"><a href="mailto:{{ \App\Helpers\SiteConfigHelper::contactEmail() }}" class="navbar-contact-row_value-link">{{ \App\Helpers\SiteConfigHelper::contactEmail() }}</a></div>
                    </div>
                    <div class="navbar-contact-row_component">
                        <div class="navbar-contact-row_key">address<br></div>
                        <div class="navbar-contact-row_value-link">{!! \App\Helpers\SiteConfigHelper::officeAddress() !!}</div>
                    </div>
                </div>
                
                <!-- Footer Section -->
                <div class="undersec mobile-footer">
                    <div class="copy">
                        <p>{{ \App\Helpers\SiteConfigHelper::copyrightText() }}</p>
                    </div>
                    <div class="Priva">
                        <p><a href="{{ \App\Helpers\SiteConfigHelper::get('privacy_policy_url', '#') }}" class="text-white">Privacy Policy</a></p>
                    </div>
                    <div class="social">
                        <ul>
                            @php $socialUrls = \App\Helpers\SiteConfigHelper::socialUrls(); @endphp
                            <li><a href="{{ $socialUrls['facebook'] }}"><i class="fab fa-facebook"></i></a></li>
                            <li><a href="{{ $socialUrls['instagram'] }}"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="{{ $socialUrls['linkedin'] }}"><i class="fab fa-linkedin"></i></a></li>
                            <li><a href="{{ $socialUrls['youtube'] }}"><i class="fab fa-youtube"></i></a></li>
                            <li><a href="{{ $socialUrls['tiktok'] }}"><i class="fab fa-tiktok"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>