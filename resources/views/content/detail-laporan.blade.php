@extends('layout.main')
@section('content')
<div class="row m-t-25">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ url('/kasir') }}" class="text-primary"><i class="fa fa-arrow-alt-circle-left"></i> &nbsp;Kembali</a>
            </div>
            <div class="card-body">

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $err)
                            <small>{{ $err }}</small>
                        @endforeach
                    </div>
                @endif
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td class="pt-1 pb-0 font-weight-bold text-uppercase">Tanggal Transaksi</td>
                            <td class="pt-1 pb-0 text-center">:</td>
                            <td class="pt-1 pb-0 " colspan="2"></td>
                            <td class="pt-1 pb-0 text-right text-uppercase">{{ $tagihan['tanggal'] }}</td>
                        </tr>
                        <tr>
                            <td class="pt-1 pb-0 font-weight-bold text-uppercase">Nama Pemancing</td>
                            <td class="pt-1 pb-0 text-center">:</td>
                            <td class="pt-1 pb-0 " colspan="2"></td>
                            <td class="pt-1 pb-0 text-right text-uppercase">{{ $tagihan['nama_pemancing'] }}</td>
                        </tr>
                        <tr>
                            <td class="pt-4 pb-1 text-uppercase font-weight-bold">Tagihan</td>
                        </tr>
                        <tr>
                            <td class="pt-0 pb-0">Mancing</td>
                            <td class="pt-0 pb-0 text-center">{{ $tagihan['mancing']['jumlah'] }}</td>
                            <td class="pt-0 pb-0"> X {{ $tagihan['mancing']['harga'] }}</td>
                            <td class="pt-0 pb-0">RP</td>
                            <td class="text-right pt-0 pb-0">{{ $tagihan['mancing']['subTotal'] }}</td>
                        </tr>
                        @foreach ($tagihan['tagihan'] as $item)
                            <tr>
                                <td class="pt-0 pb-0">{{ $item['namaBarang'] }}</td>
                                <td class="pt-0 pb-0 text-center">{{ $item['jumlah'] }} </td>
                                <td class="pt-0 pb-0">X {{ $item['harga'] }}</td>
                                <td class="pt-0 pb-0">RP</td>
                                <td class="text-right pt-0 pb-0">{{ $item['subTotal'] }}</td>
                            </tr>
                        @endforeach
                        
                        <tr>
                            <td class="pb-0 pt-4 font-weight-bold text-uppercase">sub total</td>
                            <td class="pb-0 pt-4 text-center">:</td>
                            <td class="pb-0 pt-4 "></td>
                            <td class="pb-0 pt-4 ">RP</td>
                            <td class="pb-0 pt-4 text-right text-uppercase">{{ $tagihan['sub_total'] }}</td>
                        </tr>
                        <tr>
                            <td class="pb-2 pt-1 font-weight-bold text-uppercase">hadiah</td>
                            <td class="pb-2 pt-1 text-center">:</td>
                            <td class="pb-0 pt-4 "></td>
                            <td class="pb-2 pt-1 ">RP</td>
                            <td class="pb-2 pt-1 text-right text-uppercase">{{ $tagihan['hadiah']  == 0 ? 0 : $tagihan['hadiah'] }}</td>
                        </tr>
                        <tr>
                            <td class="pb-0 pt-1 align-baseline font-weight-bold text-uppercase">ikan garung</td>
                            <td class="pb-0 pt-1 align-baseline text-center">:</td>
                            <td class="pb-0 pt-1 align-baseline " colspan="2"></td>
                            <td class="pb-0 pt-1 align-baseline text-right">
                                <input type="number" class="form-control w-50 float-right p-0 pl-2" id="jumlahIkanGarung">
                                <small>
                                    Jumlah Ikan : ( ons ) &nbsp;
                                </small>
                                <br><br>
                                <input type="number" class="form-control w-50 float-right p-0 pl-2" id="hargaIkanGarung">
                                <small>
                                    Harga / ons : ( RP ) &nbsp;
                                </small>
                                <br><br>
                                <small>
                                    Total Ikan garung : ( RP ) &nbsp; 
                                </small>
                                <span id="totalIkanGarung">0</span>
                            </td>
                        </tr>
                        <tr>
                            <td> </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="pb-2 pt-0 align-middle font-weight-bold text-uppercase">total</td>
                            <td class="pb-2 pt-0 align-middle text-center">:</td>
                            <td class="pb-2 pt-4 "></td>
                            <td class="pb-2 pt-0 align-middle ">RP</td>
                            <td class="pb-2 pt-0 align-middle text-right text-uppercase" id="totalTagihan">{{ $tagihan['sub_total'] - $tagihan['hadiah'] }}</td>
                        </tr>
                        <tr>
                            <td class="pb-2 pt-1 align-middle font-weight-bold text-uppercase">tunai</td>
                            <td class="pb-2 pt-1 align-middle text-center">:</td>
                            <td class="pb-2 pt-1 align-middle "></td>
                            <td class="pb-2 pt-1 align-middle ">RP</td>
                            <td class="pb-2 pt-1 align-middle text-right text-uppercase">
                                <input type="number" class="form-control w-50 float-right p-0 pl-2" id="jumlahTunai">
                            </td>
                        </tr>
                        <tr>
                            <td class="pb-0 pt-1 align-middle font-weight-bold text-uppercase">kembalian</td>
                            <td class="pb-0 pt-1 align-middle text-center">:</td>
                            <td class="pb-0 pt-1 align-middle "></td>
                            <td class="pb-0 pt-1 align-middle ">RP</td>
                            <td class="pb-0 pt-1 align-middle text-right text-uppercase" id="totalKembalian">{{ ($tagihan['sub_total'] - $tagihan['hadiah']) == 0 ? 0 : '-'.($tagihan['sub_total'] - $tagihan['hadiah']) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary text-light" id="btnBayarDanCetak"><i class="fa fa-money-bill-alt"></i> &nbsp; Bayar & Cetak Struk</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-plugins')
    <script>
        $(() => {
            if ($('#jumlahTunai').val() == '') {
                $('#btnBayarDanCetak').attr('disabled', true)
                $('#btnBayarDanCetak').css('cursor', 'not-allowed')
            }

            $('#jumlahIkanGarung').keyup(() => {
                var jumlahIkanGarung =  $('#jumlahIkanGarung').val()!= "" ? parseInt($('#jumlahIkanGarung').val()) : 0;
                var hargaIkanGarung = $('#hargaIkanGarung').val() != "" ? parseInt($('#hargaIkanGarung').val()) : 0;
                var totalIkanGarung = jumlahIkanGarung * hargaIkanGarung;

                var totalTagihan = parseInt("{{ $tagihan['sub_total'] - $tagihan['hadiah'] }}");

                if (totalIkanGarung != 0) {
                    totalTagihan -= totalIkanGarung;
                }
                $("#totalIkanGarung").html(-totalIkanGarung);
                $("#totalTagihan").html(totalTagihan);                
                $("#totalKembalian").html(totalTagihan * -1);
                
            });
            
            $('#hargaIkanGarung').keyup(() => {
                var jumlahIkanGarung =  $('#jumlahIkanGarung').val()!= "" ? parseInt($('#jumlahIkanGarung').val()) : 0;
                var hargaIkanGarung = $('#hargaIkanGarung').val() != "" ? parseInt($('#hargaIkanGarung').val()) : 0;
                var totalIkanGarung = jumlahIkanGarung * hargaIkanGarung;

                var totalTagihan = parseInt("{{ $tagihan['sub_total'] - $tagihan['hadiah'] }}");

                if (totalIkanGarung != 0) {
                    totalTagihan -= totalIkanGarung;
                }
                $("#totalIkanGarung").html(-totalIkanGarung);
                $("#totalTagihan").html(totalTagihan);                
                $("#totalKembalian").html(totalTagihan * -1);
                
            });
            $('#jumlahIkanGarung').focus(() => {
                $('#jumlahIkanGarung').on('wheel.disableScroll', (e) => {
                    e.preventDefault();
                });
            });
            
            $('#hargaIkanGarung').focus(() => {
               $('#hargaIkanGarung').on('wheel.disableScroll', (e) => {
                   e.preventDefault();
               });
            });

            $('#jumlahTunai').keyup(() => {
                var tunai = $('#jumlahTunai').val() != '' ? parseInt($('#jumlahTunai').val()) : 0;
                var total = parseInt($("#totalTagihan").html());

                
                $("#totalKembalian").html(tunai - total);
                if($('#jumlahTunai').val() == ''){
                    $('#btnBayarDanCetak').attr('disabled', true)
                    $('#btnBayarDanCetak').css('cursor', 'not-allowed')
                }else{
                    $('#btnBayarDanCetak').attr('disabled', false)
                    $('#btnBayarDanCetak').css('cursor', 'pointer')
                }

            });

            $('#jumlahTunai').focus(() => {
                $('#jumlahTunai').on('wheel.disableScroll', (e) => {
                    e.preventDefault();
                });
            });

            $("#btnBayarDanCetak").click(() => {
                $.ajax({beforeSend: () => {
                        $('#btnBayarDanCetak').attr('disabled', true)
                        $('#btnBayarDanCetak').css('cursor', 'not-allowed')
                    },
                    type: "POST",
                    url: "{{ url('/kasir').'/'.$tagihan['id_pemancing'] }}/cetak-struk",
                    data: {
                        _token: "{{ csrf_token() }}",
                        jumlahikangarung:  $('#jumlahIkanGarung').val()!= "" ? parseInt($('#jumlahIkanGarung').val()) : 0,
                        hargaikangarung: $('#hargaIkanGarung').val() != "" ? parseInt($('#hargaIkanGarung').val()) : 1700,
                        ikangarung: $("#totalIkanGarung").html(),
                        total: $("#totalTagihan").html(),
                        tunai: $('#jumlahTunai').val(),
                        kembalian: $("#totalKembalian").html(),
                    },
                    success: function (response) {
                        console.log(response);
                        setTimeout(() => {
                            $('#btnBayarDanCetak').attr('disabled', false)
                            $('#btnBayarDanCetak').css('cursor', 'pointer')
                            window.location.href = "{{ url('/kasir') }}"
                        }, 3000);
                        
                    }
                });
            });

        });
    </script>
@endsection