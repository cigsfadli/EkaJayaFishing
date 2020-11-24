@extends('layout.main')
@section('content')
<div class="row m-t-25">
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c1">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="zmdi zmdi-account-o"></i>
                    </div>
                    <div class="text">
                        <h2>{{ $jumlah_pemancing }}</h2>
                        <span>Jumlah Pemancing</span>
                    </div>
                    <br><br><br>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c2">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                    <div class="text">
                        <h2>388,688</h2>
                        <span>items solid</span>
                    </div>
                    <br><br><br>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c3">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="fa fa-newspaper"></i>
                    </div>
                    <div class="text">
                        <h2>{{ $jumlah_rekap }}</h2>
                        <span>Jumlah Rekap</span>
                    </div>
                    <br><br><br>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item overview-item--c4">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <h1 class="text-light">RP</h1>
                        <br>
                    </div>
                    <div class="text">
                        <h2>{{ number_format($pendapatan, 0, '', '.') }}</h2>
                        <span>Total Pendapatan</span>
                    </div>
                    <br><br><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection