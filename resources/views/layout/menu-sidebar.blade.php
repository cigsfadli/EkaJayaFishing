
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
                @if (session('user')['role'] == "super admin" || session('user')['role'] == "admin")
                <li class="{{ ($menu == 'dashboard') ? 'active has-sub' : '' }}">
                    <a href="{{ route('dashboard.home') }}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                    </li>
                @endif
                @if (session('user')['role'] == "super admin") 
                    <li class="{{ ($menu == 'akun pengguna' || $menu == 'tambah akun pengguna') ? 'active has-sub' : '' }}">
                        <a href="{{ url('/akun-pengguna') }}">
                            <i class="fas fa-users"></i>Akun Pengguna</a>
                    </li>
                @endif
                    
                @if (session('user')['role'] == "super admin" || session('user')['role'] == "admin")
                <li class="{{ ($menu == 'warung' || $menu == 'tambah barang') ? 'active has-sub' : '' }}">
                    <a href="{{ route('warung.home') }}">
                        <i class="fas fa-shopping-basket"></i>Warung</a>
                </li>
                <li class="{{ ($menu == 'hadiah juara' || $menu == 'edit hadiah juara') ? 'active has-sub' : '' }}">
                    <a href="{{ route('hadiah-juara.home') }}">
                        <i class="fas fa-trophy"></i>Hadiah Juara</a>
                </li>
                @endif
                <li class="{{ ($menu == 'rekap mancing' || $menu == 'detail rekap' || $menu == 'hitung ikan') ? 'active has-sub' : '' }}">
                    <a href="{{ route('rekap.home') }}">
                        <i class="fas fa-newspaper"></i>Rekap Mancing</a>
                    </li>
                <li class="{{ ($menu == 'kasir' || $menu == 'detail tagihan') ? 'active has-sub' : '' }}">
                    <a href="{{ url('/kasir') }}">
                        <i class="fas fa-money-bill-alt"></i>Kasir</a>
                    </li>
                @if (session('user')['role'] == "super admin" || session('user')['role'] == "admin")
                <li class="{{ ($menu == 'laporan') ? 'active has-sub' : '' }}">
                    <a href="calendar.html">
                        <i class="fas fa-newspaper"></i>Laporan</a>
                </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->