
<!DOCTYPE html>
<html lang="en">

@include('layout.head')

<body class="animsition">
    <div class="page-wrapper">

        @include('layout.mobile-header')
        @include('layout.menu-sidebar')

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            @include('layout.header-desktop')

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">{{ $menu }}</h2>
                                    @if (Request::url() == url('/warung'))
                                        <a class="au-btn au-btn-icon au-btn--blue text-light" href="{{ route('warung.add') }}">
                                            <i class="zmdi zmdi-plus"></i>tambah barang</a>
                                    @endif
                                    @if (Request::url() == url('/rekap-mancing'))
                                        <a class="au-btn au-btn-icon au-btn--blue text-light" href="{{ route('rekap.create') }}">
                                            <i class="zmdi zmdi-plus"></i>tambah rekap</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @yield('content')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2020 <span class="text-primary">EkaJayaFishing</span>. All rights reserved!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
        </div>
        <!-- END PAGE CONTAINER-->

    </div>
    @yield('modals')
    @include('layout.js-plugins')
    @yield('js-plugins')
    <script>
        $(() => {
            var jam = {{ date('H', time()) }};
            if (jam <= 10 && jam >= 4) {
                $('#sapa').html('Selamat Pagi');
            }else if (jam >= 11 && jam <= 14) {
                $('#sapa').html('Selamat Siang');
            }else if (jam >= 14 && jam <= 17) {
                $('#sapa').html('Selamat Sore');
            }else {
                $('#sapa').html('Selamat Malam');
            }
            
        });
    </script>

</body>

</html>
<!-- end document-->
