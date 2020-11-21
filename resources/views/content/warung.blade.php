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
                                <td class="text-center">{{ $i }}</td>
                                <td>{{ $barang->nama_barang }}</td>
                                <td>Rp. {{ $barang->harga_barang }}</td>
                                <td>asd</td>
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