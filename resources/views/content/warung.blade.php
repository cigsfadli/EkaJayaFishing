@extends('layout.main')
@section('content')
<div class="row m-t-25">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="bg-primary text-light">
                        <tr>
                            <th width="20px" class="text-center">No</th>
                            <th>Nama Barang</th>
                            <th>Harga Barang (Rp)</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($barangs as $barang)
                            <tr>
                                <td class="text-center align-middle">{{ $i }}</td>
                                <td class="align-middle">{{ $barang->nama_barang }}</td>
                                <td class="align-middle">Rp. {{ $barang->harga_barang }}</td>
                                <td>
                                    <small>
                                        <a href="{{ url('warung/edit-barang').'/'.$barang->id_barang }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                        <a href="{{ url('warung/hapus-barang').'/'.$barang->id_barang }}" class="btn btn-danger" onclick="return confirm('Yakin Mau Dihapus ?')"><i class="fa fa-trash"></i></a>
                                    </small>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection