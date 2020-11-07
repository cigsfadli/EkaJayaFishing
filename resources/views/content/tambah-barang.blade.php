@extends('layout.main')
@section('content')
<div class="row m-t-25">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <br>
                <h3>Formulir Tambah Barang</h3>
                <br>
                <form action="{{ route('warung.create') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Contoh: Kopi Good Day">
                    </div>
                    <div class="form-group">
                        <label for="harga_barang">Harga Barang &nbsp;(RP)</label>
                        <input type="text" class="form-control" name="harga_barang" id="harga_barang" placeholder="Contoh: 3000">
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
<div class="row">
    <div class="col-md-12">
        <div class="copyright">
            <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
        </div>
    </div>
</div>  
@endsection