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
                <div class="alert alert-primary">
                    <table>
                        <tr>
                            <td>Hari</td>
                            <td>:&nbsp;</td>
                            <td>{{ $rekap['hari'] }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:&nbsp;</td>
                            <td>{{ $rekap['tanggal'] }}</td>
                        </tr>
                        <tr>
                            <td>Jumlah Pemancing &nbsp;</td>
                            <td>:&nbsp;</td>
                            <td><span id="jumlah-pemancing"></span></td>
                        </tr>
                    </table>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <button type="button" class="btn au-btn--blue text-light float-right" data-toggle="modal" data-target="#exampleModalCenter">
                            <i class="fa fa-user-plus"></i> Tambah Pemancing
                        </button>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead class="bg-primary text-light">
                        <tr>
                            <th width="20px" class="text-center">No</th>
                            <th>Nama Pemancing</th>
                            <th width="20%" class="text-center">Lapak</i></th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="table-pemancing">
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <button class="btn au-btn--blue text-light" id="btn-kocok-lapak">
                    <i class="fa fa-random" ></i> Kocok Lapak Pemancingan
                </button>
                <a class="btn au-btn--blue text-light float-right" href="{{ url('/rekap-mancing') }}/{{ $rekap['id_rekap'] }}/detail-rekap/hitung-hadiah">
                    <i class="fa fa-calculator" ></i> Hitung Hadiah
                </a>
                <a class="btn au-btn--blue text-light float-right mr-4" href="{{ url('/rekap-mancing') }}/{{ $rekap['id_rekap'] }}/detail-rekap/hitung-ikan">
                    <i class="fa fa-calculator" ></i> Hitung Ikan
                </a>
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
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-user-plus"></i> Tambah Pemancing</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="tambah_nama_pemancing">Nama Pemancing</label>
                    <input type="text" name="tambah_nama_pemancing" id="tambah_nama_pemancing" class="form-control">
                    <small class="text-danger" id="error_tambah_pemancing"></small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" id="btn_tambah_nama_pemancing" class="btn au-btn--blue text-light">Tambah Pemancing</button>
                </div>

            </form>
        </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="formAddTagihanPemancing" method="POST" action="">
                <input type="hidden" name="id_pemancing" id="field-id-pemancing">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-money-bill-alt"></i> Tambah Tagihan Pemancing</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="tambah_nama_pemancing">Barang</label>
                    <select name="id_barang" id="field-id-barang" class="form-control" required>
                        <option value="">Pilih Barang</option>
                    </select>
                    <br>
                    <input type="number" name="jumlah_barang" id="field-jumlah-barang" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="btn_tambah_tagihan_pemancing" class="btn au-btn--blue text-light">Tambah Pemancing</button>
                </div>

            </form>
        </div>
        </div>
    </div>
@endsection

@section('js-plugins')
    <script>
        $(document).ready(function() {
            tabelBodyPemancing();
            jumlahPemancing();
            $("#btn_tambah_nama_pemancing").click(function() {
                addPemancing();
            });
            $("#formAddPemancing").submit(function(e) {
                e.preventDefault();
                addPemancing();
            });

            $("#btn-kocok-lapak").click(function(e) {
                e.preventDefault();
                var konfirmasi = confirm("kocok sekarang ?");
                if (konfirmasi == true) {
                    $.ajax({
                        beforeSend: () => {
                            $('#btn-kocok-lapak').attr('disabled', true)
                            $('#btn-kocok-lapak').css('cursor', 'not-allowed')
                        },
                        type: "GET",
                        url: "{{ url('/rekap-mancing/kocok-lapak-pemancing').'/'.$rekap['id_rekap'] }}",
                        success: function (response) {
                            $('#btn-kocok-lapak').attr('disabled', false)
                            $('#btn-kocok-lapak').css('cursor', 'pointer')
                            tabelBodyPemancing();
                        }
                    });
                }else{

                }

            });

            $("#formAddTagihanPemancing").submit(function(e) {
                e.preventDefault();

                var data = {
                    _token: "{{ csrf_token() }}",
                    idpemancing: $("#field-id-pemancing").val(),
                    idbarang: $("#field-id-barang").val(),
                    jumlah: $("#field-jumlah-barang").val(),
                };
                $.ajax({
                    type: "POST",
                    url: "{{ url('/tambah-tagihan') }}",
                    data: data,
                    success: function (response) {
                        alert(response.status);
                        $("#field-jumlah-barang").val('');
                        $('#exampleModalCenter2').modal('hide');
                    }
                });
            });
        });
        function addPemancing(){

            if ($("#tambah_nama_pemancing").val() == '') {
                $("#tambah_nama_pemancing").removeClass("border-danger");
                $("label[for=tambah_nama_pemancing]").removeClass("text-danger");
                $("#tambah_nama_pemancing").addClass("border-danger");
                $("label[for=tambah_nama_pemancing]").addClass("text-danger");
                $("#error_tambah_pemancing").html("Harus Diisi !");
            }else if(parseInt($("#tambah_nama_pemancing").val())){
                $("#tambah_nama_pemancing").removeClass("border-danger");
                $("label[for=tambah_nama_pemancing]").removeClass("text-danger");
                $("#tambah_nama_pemancing").addClass("border-danger");
                $("label[for=tambah_nama_pemancing]").addClass("text-danger");
                $("#error_tambah_pemancing").html("Harus Diisi Text !");
            }else{
                $("#tambah_nama_pemancing").removeClass("border-danger");
                $("label[for=tambah_nama_pemancing]").removeClass("text-danger");
                $("#error_tambah_pemancing").html("");
                tambahPemancing($("#tambah_nama_pemancing").val(), "{{ $rekap['id_rekap'] }}");

            }

        }
        function tambahPemancing(namaPemancing, idRekap) {
            var valueData = {
                _token: '{{ csrf_token() }}',
                namapemancing: namaPemancing,
                idrekap: idRekap
            };
            $.ajax({
                type: "POST",
                url: "{{ url('/rekap-mancing/detail-rekap/tambah-pemancing') }}",
                data: valueData,
                success: function (response) {
                    if (response.status == 'failed') {
                        alert(response.message);
                        $('#exampleModalCenter').modal('hide');
                    }else{

                        alert(response.status);
                        tabelBodyPemancing();
                        jumlahPemancing();
                        $('#exampleModalCenter').modal('hide');
                    }
                }
            });

        }
        function tabelBodyPemancing() {
            $.ajax({
                type: "GET",
                url: "{{ url('/rekap-mancing/pemancing').'/'.$rekap['id_rekap'] }}",
                success: function (response) {
                    document.getElementById('table-pemancing').innerHTML = response;
                    $("#tambah_nama_pemancing").val('');
                }
            });
        }
        function jumlahPemancing() {
            $.ajax({
                type: "GET",
                url: "{{ url('/rekap-mancing/jumlah-pemancing').'/'.$rekap['id_rekap'] }}",
                success: function (response) {
                    document.getElementById('jumlah-pemancing').innerHTML = response;
                }
            });
        }

        function konfirmasi(url) {
            if(confirm('Sudah Selesai Mancing ?') == true){
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function (response) {
                        alert(response.status);
                        tabelBodyPemancing();
                    }
                });
            }else{
                return false;
            }

        }

        function openModalTambahTagihan(idPemancing){

            document.getElementById('field-id-pemancing').value = idPemancing;

            $.ajax({
                type: "GET",
                url: "{{ url('/warung/barang-option') }}",
                success: function (response) {
                    document.getElementById("field-id-barang").innerHTML = response;
                }
            });
        }

    </script>
@endsection
