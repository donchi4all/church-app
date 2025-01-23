<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
            <span class="icofont-close js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>

<nav class="site-nav">
    <div class="container">
        <div class="site-navigation">
            {{-- <a href="{{ url('/') }}" class="logo m-0 float-left">Grace Operated Life International Ministry </a> --}}

            <!-- Logo Section -->
            <a href="{{ url('/') }}" class="logo m-0 float-left">
                <img src="{{ asset('logo_2.PNG') }}" alt="Grace Operated Life International Ministry Logo"
                    class="img-fluid" style="max-width: 200px; height: auto;">
            </a>

            {{-- <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="has-children">
                    <a href="#">Sermons</a>
                    <ul class="dropdown">
                        <li><a href="#">Sermons</a></li>
                        <li><a href="#">Sermons Single</a></li>
                        <li class="has-children">
                            <a href="#">Dropdown</a>
                            <ul class="dropdown">
                                <li><a href="#">Sub Menu One</a></li>
                                <li><a href="#">Sub Menu Two</a></li>
                                <li><a href="#">Sub Menu Three</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="{{ url('/ministry') }}">Ministries</a></li>
                <li><a href="{{ url('/contact') }}">Contact</a></li>
                <li class="cta-button"><a href="{{ url('/contact') }}">Request a prayer</a></li>
            </ul> --}}

            <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
                <li class="{{ request()->routeIs('home') ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
                <li class="{{ request()->routeIs('ministry') ? 'active' : '' }}"><a
                        href="{{ route('ministry') }}">Ministries</a></li>
                <li class="{{ request()->routeIs('contact') ? 'active' : '' }}"><a
                        href="{{ route('contact') }}">Contact</a></li>
                <li class="{{ request()->routeIs('partnership') ? 'active' : '' }}"><a
                        href="{{ route('partnership') }}">Partnership</a></li>
                <li class="{{ request()->routeIs('donation') ? 'active' : '' }}"><a
                        href="{{ route('donation') }}">Donation</a></li>
                {{-- <li class="{{ request()->routeIs('sermon.single') ? 'active' : '' }}"><a
                        href="{{ route('sermon.single') }}"> Sermon Single</a></li> --}}
                <li class="cta-button"><a href="{{ route('prayer.form') }}">Request a Prayer</a></li>
            </ul>
            <a href="#"
                class="burger ms-auto float-end site-menu-toggle js-menu-toggle d-inline-block d-lg-none light">
                <span></span>
            </a>
        </div>
    </div>
</nav>
