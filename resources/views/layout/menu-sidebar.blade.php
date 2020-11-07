
<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{ asset('assets/images/icon/logo-1.png') }}" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="{{ ($menu == 'dashboard') ? 'active has-sub' : '' }}">
                    <a href="{{ route('dashboard.home') }}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class="{{ ($menu == 'laporan') ? 'active has-sub' : '' }}">
                    <a href="calendar.html">
                        <i class="fas fa-users"></i>Akun Pengguna</a>
                </li>
                <li class="{{ ($menu == 'warung' || $menu == 'tambah barang') ? 'active has-sub' : '' }}">
                    <a href="{{ route('warung.home') }}">
                        <i class="fas fa-shopping-basket"></i>Warung</a>
                </li>
                <li class="{{ ($menu == 'rekap mancing') ? 'active has-sub' : '' }}">
                    <a href="{{ route('rekap.home') }}">
                        <i class="fas fa-newspaper"></i>Rekap Mancing</a>
                </li>
                <li class="{{ ($menu == 'kasir') ? 'active has-sub' : '' }}">
                    <a href="form.html">
                        <i class="fas fa-money-bill-alt"></i>Kasir</a>
                </li>
                <li class="{{ ($menu == 'laporan') ? 'active has-sub' : '' }}">
                    <a href="calendar.html">
                        <i class="fas fa-newspaper"></i>Laporan</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->