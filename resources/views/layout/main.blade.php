
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
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
        </div>
        <!-- END PAGE CONTAINER-->

    </div>
    @include('layout.js-plugins')

</body>

</html>
<!-- end document-->
