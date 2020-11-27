@extends('layout.main')
@section('content')
<div class="row m-t-25">
    <div class="col-lg-6 col-sm-12">
        <div class="row">
            <div class="col-sm-6 col-lg-6">
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
            <div class="col-sm-6 col-lg-6">
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
            <div class="col-sm-6 col-lg-12">
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
                            <br><br>
                            <br><br>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
    <div class="col-lg-6 col-sm-12">
        <div class="au-card chart-percent-card">
            <div class="au-card-inner">
                <h3 class="title-2 tm-b-5">Presentasi Tagihan</h3>
                <div class="row no-gutters">
                    <div class="col-xl-6">
                        <div class="chart-note-wrap">
                            <div class="chart-note mr-0 d-block">
                                <span class="dot dot--green"></span>
                                <span>Sudah Dibayar</span>
                            </div>
                            <div class="chart-note mr-0 d-block">
                                <span class="dot dot--red"></span>
                                <span>Belum Dibayar</span>
                            </div>
                        </div>
                        <div class="chart-note-wrap">
                            <div class="chart-note mr-0 d-block">
                                <span class="dot dot--green"></span>
                                <span>{{ $sudahDibayar }} <i class="fa fa-users text-success"></i></span>
                            </div>
                            <div class="chart-note mr-0 d-block">
                                <span class="dot dot--red"></span>
                                <span>{{ $belumDibayar }} <i class="fa fa-users text-danger"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="percent-chart">
                            <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                    <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                </div>
                            </div>

                            <canvas id="percent-chart" height="735" width="632" class="chartjs-render-monitor" style="display: block; width: 241px; height: 280px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="card h-100"></div> --}}
    </div>
    
</div>
<div class="row ">
    <div class="col-lg-6 col-sm-12">
        <div class="au-card m-b-30">
            <div class="au-card-inner">
                <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                    </div>
                </div>
                <h3 class="title-2 m-b-40">Pendapatan 7 Hari Terakhir</h3>
                <canvas id="barChart" height="800" width="900" class="chartjs-render-monitor" style="display: block; width: 100px; height: 800px;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-sm-12">
        <div class="au-card m-b-30">
            <div class="au-card-inner">
                <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                    </div>
                </div>
                <h3 class="title-2 m-b-40">Pemancing 7 Hari Terakhir</h3>
                <canvas id="barChart2" height="800" width="900" class="chartjs-render-monitor" style="display: block; width: 100px; height: 300px;"></canvas>
            </div>
        </div>
    </div> 
</div>
    
@endsection

@section('js-plugins')
    <script>
        var labelTujuhHariTerakhir = [];
        var pendapatanTujuhHariTerakhir = [];
        var pemancingTujuhHariTerakhir = [];
    </script>

    @foreach ($labelTujuhHariTerakhir as $label)
    <script>
        labelTujuhHariTerakhir.push("{{ $label }}");
    </script>
    @endforeach
    
    @foreach ($pendapatanTujuhHariTerakhir as $pendapatan)
        <script>
            pendapatanTujuhHariTerakhir.push("{{ $pendapatan }}");
        </script>
    @endforeach

    @foreach ($pemancingTujuhHariTerakhir as $pemancing)
        <script>
            pemancingTujuhHariTerakhir.push("{{ $pemancing }}");
        </script>
    @endforeach

    <script>
        $(() => {
            var sudahDibayar = parseInt("{{ $sudahDibayar }}") == 0 && parseInt("{{ $belumDibayar }}") == 0 ? 1 : parseInt("{{ $sudahDibayar }}")
            var belumDibayar = parseInt("{{ $belumDibayar }}")
            console.log(pemancingTujuhHariTerakhir);
            percenCart(sudahDibayar, belumDibayar)
            barCart(labelTujuhHariTerakhir, pendapatanTujuhHariTerakhir)
            barCart2(labelTujuhHariTerakhir, pemancingTujuhHariTerakhir)
        }); 
        
        function percenCart(sudahDibayar, belumDibayar){
            try {
            
            // Percent Chart
            var ctx = document.getElementById("percent-chart");
            if (ctx) {
                ctx.height = 280;
                var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    datasets: [
                    {
                        label: "My First dataset",
                        data: [sudahDibayar, belumDibayar],
                        backgroundColor: [
                        '#00ad5f',
                        '#fa4251'
                        ],
                        hoverBackgroundColor: [
                        '#00ad5f',
                        '#fa4251'
                        ],
                        borderWidth: [
                        0, 0
                        ],
                        hoverBorderColor: [
                        'transparent',
                        'transparent'
                        ]
                    }
                    ],
                    labels: [
                    'Sudah Dibayar',
                    'Belum Dibayar'
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    cutoutPercentage: 55,
                    animation: {
                    animateScale: true,
                    animateRotate: true
                    },
                    legend: {
                    display: false
                    },
                    tooltips: {
                    titleFontFamily: "Poppins",
                    xPadding: 15,
                    yPadding: 10,
                    caretPadding: 0,
                    bodyFontSize: 16
                    }
                }
                });
            }

            } catch (error) {
            console.log(error);
            }
        }
        function barCart(labelTujuhHariTerakhir, pendapatanTujuhHariTerakhir) {
            
            try {
                //bar chart
                var ctx = document.getElementById("barChart");
                if (ctx) {
                ctx.height = 700;
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    defaultFontFamily: 'Poppins',
                    data: {
                    labels: labelTujuhHariTerakhir,
                    datasets: [
                        {
                        label: "Pendapatan",
                        data: pendapatanTujuhHariTerakhir,
                        borderColor: "rgba(0, 123, 255, 0.9)",
                        borderWidth: "0",
                        backgroundColor: "rgba(0, 123, 255, 0.5)",
                        fontFamily: "Poppins"
                        },
                        // {
                        //   label: "Jumlah Pendapatan",
                        //   data: [28, 48, 40, 19, 86, 27, 90],
                        //   borderColor: "rgba(0,0,0,0.09)",
                        //   borderWidth: "0",
                        //   backgroundColor: "rgba(0,0,0,0.07)",
                        //   fontFamily: "Poppins"
                        // }
                    ]
                    },
                    options: {
                    legend: {
                        position: 'top',
                        labels: {
                        fontFamily: 'Poppins'
                        }

                    },
                    scales: {
                        xAxes: [{
                        ticks: {
                            fontFamily: "Poppins"

                        }
                        }],
                        yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            fontFamily: "Poppins"
                        }
                        }]
                    }
                    }
                });
                }


            } catch (error) {
                console.log(error);
            }
        }
        function barCart2(labelTujuhHariTerakhir, pemancingTujuhHariTerakhir) {
            
            try {
                //bar chart
                var ctx = document.getElementById("barChart2");
                if (ctx) {
                ctx.height = 700;
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    defaultFontFamily: 'Poppins',
                    data: {
                    labels: labelTujuhHariTerakhir,
                    datasets: [
                        {
                        label: "Pemancing",
                        data: pemancingTujuhHariTerakhir,
                        borderColor: "rgba(0, 123, 255, 0.9)",
                        borderWidth: "0",
                        backgroundColor: "rgba(0, 123, 255, 0.5)",
                        fontFamily: "Poppins"
                        },
                        // {
                        //   label: "Jumlah Pendapatan",
                        //   data: [28, 48, 40, 19, 86, 27, 90],
                        //   borderColor: "rgba(0,0,0,0.09)",
                        //   borderWidth: "0",
                        //   backgroundColor: "rgba(0,0,0,0.07)",
                        //   fontFamily: "Poppins"
                        // }
                    ]
                    },
                    options: {
                    legend: {
                        position: 'top',
                        labels: {
                        fontFamily: 'Poppins'
                        }

                    },
                    scales: {
                        xAxes: [{
                        ticks: {
                            fontFamily: "Poppins"

                        }
                        }],
                        yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            fontFamily: "Poppins"
                        }
                        }]
                    }
                    }
                });
                }


            } catch (error) {
                console.log(error);
            }
        }
    </script>  
@endsection