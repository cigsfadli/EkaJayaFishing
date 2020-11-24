@extends('layout.main')
@section('content')
<div class="row m-t-25">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td width="50%">Tanggal Dari</td>
                        <td width="50%">Tanggal Sampai</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="date" name="startdate" id="startdate" class="form-control" value="{{ date('Y-m-d', time()) }}">
                        </td>
                        <td>
                            <input type="date" name="enddate" id="enddate" class="form-control" value="{{ date('Y-m-d', time()) }}">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary text-light" id="btnSearchData"><i class="fa fa-newspaper"></i> &nbsp; Lihat Laporan</button>
            </div>
        </div>
    </div>
    <div class="col-md-12 d-none" id="priview">
        <div class="card">
            <div class="card-header">
                <span class="text-primary"><i class="fa fa-eye"></i> Preview Laporan</span>
            </div>
            <div class="card-body">
                <div class="alert alert-primary">
                    <table>
                        <tr>
                            <td>Dari Tanggal</td>
                            <td>:&nbsp;&nbsp;</td>
                            <td><span id="dariTanggal"></span></td>
                        </tr>
                        <tr>
                            <td>Sampai Tanggal&nbsp;&nbsp;</td>
                            <td>:&nbsp;&nbsp;</td>
                            <td><span id="sampaiTanggal"></span></td>
                        </tr>
                    </table>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th width="35%">Tanggal</th>
                            <th width="25%" class="text-center">Jumlah Pemancing</th>
                            <th width="35%">Jumlah Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody id="laporanDetail"></tbody>
                </table>
            </div>
            <div class="card-footer text-right">
                <a href="#" class="btn btn-primary text-light" id="btnSavePDF"><i class="fa fa-save"></i> &nbsp; Simpan Sebagai PDF</a href="#">
            </div>
        </div>
    </div>
</div>
@endsection
@section('js-plugins')
    <script>
        $(() => {
            $("#btnSearchData").click(() =>{
                var dateFrom = new Date($("#startdate").val());
                var dateTo = new Date($("#enddate").val());
                
                var bulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
                var hari = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];

                $("#dariTanggal").html(hari[dateFrom.getDay()]+", "+dateFrom.getDate()+" "+bulan[dateFrom.getMonth()]+" "+dateFrom.getFullYear());
                $("#sampaiTanggal").html(hari[dateTo.getDay()]+", "+dateTo.getDate()+" "+bulan[dateTo.getMonth()]+" "+dateTo.getFullYear());

                $.ajax({
                    type: "POST",
                    url: "{{ url('/laporan-get') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        startdate: $("#startdate").val(),
                        enddate: $("#enddate").val()
                    },
                    success: function (response) {
                        $("#priview").removeClass('d-none');
                        $("#laporanDetail").html(response);
                        $("#btnSavePDF").attr('href', "{{ url('/laporan-print') }}?startdate=" + $("#startdate").val() + "&enddate=" + $("#enddate").val() );
                    }
                });
            });
        });
    </script>
@endsection
