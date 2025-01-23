<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            {{-- <!-- GitHub Button -->
            <li class="nav-item lh-1 me-3">
                <a class="github-button" href="https://github.com/themeselection/sneat-html-admin-template-free" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star on GitHub">Star</a>
            </li> --}}

            <!-- User Dropdown -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ asset('backend/assets/img/avatars/1.png') }}" alt class="rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    {{-- <li><a class="dropdown-item" href="#"><i class="bx bx-user me-2"></i> Profile</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bx bx-cog me-2"></i> Settings</a></li>
                    <li><hr class="dropdown-divider" /></li> --}}
                    <li><a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="bx bx-power-off me-2"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
