@extends('layout.main')
@section('content')
<div class="row m-t-25">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <br>
                <h3>Formulir Tambah Barang</h3>
                <br>
                <form action="{{ route('warung.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_barang" value="{{ $barang->id_barang }}">
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Contoh: Kopi Good Day" value="{{ $barang->nama_barang }}" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_barang">Harga Barang &nbsp;(RP)</label>
                        <input type="number" class="form-control" name="harga_barang" id="harga_barang" placeholder="Contoh: 3000" value="{{ $barang->harga_barang }}" required>
                    </div>
                    <br>
                    <div class="text-right">
                        <a href="{{ route('warung.home') }}" class="btn btn-danger"><i class="fa fa-times"></i> Batal</a>
                        <button class="btn text-light au-btn--blue"><i class="fa fa-plus"></i> Simpan Barang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>  
@endsection