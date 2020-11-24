@extends('auth.layout')
@section('content')
    
<div class="login-wrap">
    <div class="login-content">
        <div class="row">
            <div class="col-md-12">
                <small>
                    <a href="{{ url('/') }}"><i class="fa fa-arrow-alt-circle-left"></i> Kembali</a>
                </small>
            </div>
        </div>
        <br>
        <div class="login-form">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <span>{{ $error }}</span>
                    @endforeach
                </div>
            @endif
            <form action="" method="post">
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input class="au-input au-input--full" type="text" name="nama_lengkap" placeholder="Nama Lengkap" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input class="au-input au-input--full" type="text" name="username" placeholder="Username" value="{{ $user->username }}">
                </div>
                <div class="form-group">
                    <label>Password Baru</label>
                    <input class="au-input au-input--full" type="password" name="password_baru" placeholder="Password Baru">
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password Baru</label>
                    <input class="au-input au-input--full" type="password" name="konfirmasi_password_baru" placeholder="Konfirmasi Password Baru">
                </div>
                <br>
                <button class="au-btn au-btn--block au-btn--blue m-b-20" type="submit"><i class="fa fa-save"></i> Simpan Profil</button>
            </form>
            <div class="register-link">
            </div>
        </div>
    </div>
</div>
@endsection