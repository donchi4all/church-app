<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bold ms-2">Golim Admin</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
            <i class="bx bx-chevron-left bx-sm"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-smile"></i>
                <div>Dashboard</div>
            </a>
        </li>

        <!-- Users -->
        <li class="menu-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
            <a href="{{ route('admin.users') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div>Users</div>
            </a>
        </li>

        <!-- Donations -->
        <li class="menu-item {{ request()->routeIs('admin.donations.list') ? 'active' : '' }}">
            <a href="{{ route('admin.donations.list') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-donate-heart"></i>
                <div>Donations</div>
            </a>
        </li>

        <!-- Prayer Requests -->
        <li class="menu-item {{ request()->routeIs('admin.prayer.request.list') ? 'active' : '' }}">
            <a href="{{ route('admin.prayer.request.list') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-message-alt"></i>
                <div>Prayer Requests</div>
            </a>
        </li>

        <!-- Partnerships -->
        <li class="menu-item {{ request()->routeIs('admin.partnership') ? 'active' : '' }}">
            <a href="{{ route('admin.partnership') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-copy"></i>
                <div>Partnerships</div>
            </a>
        </li>

        <!-- Contacts -->
        <li class="menu-item {{ request()->routeIs('admin.contacts.list') ? 'active' : '' }}">
            <a href="{{ route('admin.contacts.list') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-envelope"></i>
                <div>Contacts</div>
            </a>
        </li>

        <!-- Settings -->
        <li class="menu-item {{ request()->routeIs('admin.setting.hero.list', 'admin.setting.recent.list', 'admin.setting.upcoming.list', 'admin.setting.about.list', 'admin.setting.testimony.list') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div>Settings</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.setting.hero.list') ? 'active' : '' }}">
                    <a href="{{ route('admin.setting.hero.list') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-image"></i>
                        <div>Hero Management</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.setting.recent.list') ? 'active' : '' }}">
                    <a href="{{ route('admin.setting.recent.list') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-calendar-event"></i>
                        <div>Recent Sermon Management</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.setting.upcoming.list') ? 'active' : '' }}">
                    <a href="{{ route('admin.setting.upcoming.list') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-calendar-star"></i>
                        <div>Upcoming Sermon Management</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.setting.about.list') ? 'active' : '' }}">
                    <a href="{{ route('admin.setting.about.list') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-info-circle"></i>
                        <div>About Management</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.setting.testimony.list') ? 'active' : '' }}">
                    <a href="{{ route('admin.setting.testimony.list') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-chat"></i>
                        <div>Testimony Management</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
