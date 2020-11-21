@extends('layout.main')
@section('content')
<div class="row m-t-25">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('warung.create') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap">
                    </div>
                    <div class="form-group">
                        <label for="username">Username  <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="username" id="username">
                        <small class="text-danger">ERROR</small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" id="password">
                        <small class="text-danger" id="errorPassword"></small>
                    </div>
                    <div class="form-group">
                        <label for="konfimasi_password">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="konfirmasi_password" id="konfirmasi_password">
                    </div>
                    <div class="form-group">
                        <label for="jenis_akun">Jenis Akun <span class="text-danger">*</span></label>
                        <select name="role" id="role" class="form-control">
                            <option value="kasir">Kasir</option>
                            <option value="kasir">Admin</option>
                            <option value="kasir">Super Admin</option>
                        </select>
                    </div>
                    <br>
                    <div class="text-right">
                        <a href="{{ route('warung.home') }}" class="btn btn-danger"><i class="fa fa-times"></i> Batal</a>
                        <button class="btn text-light au-btn--blue"><i class="fa fa-plus"></i> Tambah Barang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>  
@endsection

@section('js-plugins')
    <script>
        $(() => {
            $("#password").blur(() => {
                if ($("#password").val().length < 6) {
                    $("#errorPassword").html("Password Kurang Dari 6 Digit");
                }else{
                    $("#errorPassword").html("");

                }
            });
        });
    </script>
@endsection