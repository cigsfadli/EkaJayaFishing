@extends('layout.main')
@section('content')
<div class="row m-t-25">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $err)
                            <small>{{ $err }}</small>
                        @endforeach
                    </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="20px" class="text-center">No</th>
                            <th class="text-left">Nama Pemancing</th>
                            <th class="text-left">Total Kasbon</th>
                            <th width="150px" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($semuaHutang as $hutang)
                            <tr>
                                <td class="text-center">{{ $no++  }}</td>
                                <td>{{ $hutang->nama_pemancing }}</td>
                                <td>{{ $hutang->total_kasbon }}</td>
                                <td class="text-center small">
                                    <button type="button" class="text-success" data-toggle="modal" data-target="#exampleModalCenter" data-nama="{{ $hutang->nama_pemancing }}" data-kasbon="{{ $hutang->total_kasbon }}" onclick="setDataPembayaranHutang( '{{ $hutang->nama_pemancing }}' , '{{ $hutang->total_kasbon }}', '{{ $hutang->id_kasbon }}' )">
                                        <i class="fa fa-money-bill-alt"></i> Bayar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modals')
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="formAddPemancing" method="POST" action="">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-money-bill-alt"></i> Bayar Kasbon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Detail Kasbon</h5>
                    <br>
                    <table class="table table-borderless small">
                        <tr>
                            <td style="padding: 5px 0;font-weight: 600" width="50%">Nama Pemancing</td>
                            <td style="padding: 5px 0;font-weight: 600" width="10%"> &nbsp; : &nbsp; </td>
                            <td style="padding: 5px 0;font-weight: 600" class="text-right text-uppercase" id="detailNamaPemancingKasbon">Nama Pemancing</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 0;font-weight: 600">Total Kasbon</td>
                            <td style="padding: 5px 0;font-weight: 600"> &nbsp; :  &nbsp;RP </td>
                            <td style="padding: 5px 0;font-weight: 600" class="text-right" id="detailTotalKasbon">Nama Pemancing</td>
                        </tr>
                    </table>
                    <br>
                    <label for="bayar_hutang">
                        <h5>Jumlah Bayar</h5>
                    </label>
                    <input type="number" name="bayar_hutang" id="bayar_hutang" class="form-control" min="0">
                    <small class="text-danger" id="error_tambah_pemancing"></small>
                    <br>
                    <table class="table table-borderless">
                        <tr>
                            <td style="padding: 5px 0;font-weight: 600" width="50%">Kembalian</td>
                            <td style="padding: 5px 0;font-weight: 600" width="10%"> &nbsp; :  &nbsp;RP </td>
                            <td style="padding: 5px 0;font-weight: 600" class="text-right" id="detailKembalian">Nama Pemancing</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <span class="d-none" id="id_kasbon"></span>
                    <button type="button" id="btn_bayar_dan_cetak" class="btn au-btn--blue text-light">Bayar & Cetak</button>
                    <button type="button" id="btn_bayar" class="btn au-btn--blue text-light">Bayar</button>
                </div>

            </form>
        </div>
        </div>
    </div>
@endsection
@section('js-plugins')
    <script>
        $(document).ready(() => {
            $("#bayar_hutang").keyup(() => {
                $("#detailKembalian").html( (parseInt ($("#detailTotalKasbon").html() ) -  parseInt( $("#bayar_hutang").val() )) * -1 );
            });

            $("#btn_bayar").click(() => {
                var valueData = {
                    _token: '{{ csrf_token() }}',
                    id_kasbon:  $("#id_kasbon").html(),
                    namapemancing: $("#detailNamaPemancingKasbon").html(),
                    total:  $("#detailTotalKasbon").html(),
                    bayar:  $("#bayar_hutang").val()
                }
                $.ajax({
                    type: "POST",
                    url: "/buku-hutang/bayar",
                    data: valueData,
                    success: function (response) {
                        alert(response.message);
                        window.location.href = '/buku-hutang';
                    }
                });
            });

            $("#btn_bayar_dan_cetak").click(() => {
                var valueData = {
                    _token: '{{ csrf_token() }}',
                    id_kasbon:  $("#id_kasbon").html(),
                    namapemancing: $("#detailNamaPemancingKasbon").html(),
                    total:  $("#detailTotalKasbon").html(),
                    bayar:  $("#bayar_hutang").val()
                }
                $.ajax({
                    type: "POST",
                    url: "/buku-hutang/bayar-dan-cetak",
                    data: valueData,
                    success: function (response) {
                        alert(response.message);
                        window.location.href = '/buku-hutang';
                    }
                });
            })
        });

        function setDataPembayaranHutang(namaPemancing, totalKasbon, idKasbon){
            document.getElementById("detailNamaPemancingKasbon").innerHTML = namaPemancing;
            document.getElementById("detailTotalKasbon").innerHTML = totalKasbon;
            document.getElementById("id_kasbon").innerHTML = idKasbon;
            document.getElementById("detailKembalian").innerHTML = totalKasbon * -1;
        }
    </script>
@endsection
