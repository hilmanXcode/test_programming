<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="#" class="text-nowrap logo-img">
                <img class="mt-4" src="{{ env('APP_URL') }}/assets/images/logos/GudangKu.png" width="180"
                    alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $page === 'dashboard' ? 'active' : '' }}" href="{{ route('dashboard') }}"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-receipt-2"></i>
                        </span>
                        <span class="hide-menu">Daftar Transaksi</span>
                    </a>

                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Manage</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $page === 'barang' ? 'active' : '' }}" href="{{ route('barang.index') }}"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-forklift"></i>
                        </span>
                        <span class="hide-menu">Barang</span>
                    </a>
                    <a class="sidebar-link" href="/asdasd" aria-expanded="false">
                        <span>
                            <i class="ti ti-user"></i>
                        </span>
                        <span class="hide-menu">Customer</span>
                    </a>

                </li>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
