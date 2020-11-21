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
                    <a href="{{ url('/akun-pengguna/tambah-akun-pengguna') }}" class="btn btn-primary float-right mb-3"><i class="fa fa-user-plus"></i> Tambah Akun Pngguna</a>

                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th width="20px" class="text-center">No</th>
                                <th>Nama Pengguna</th>
                                <th>Jenis Akun</th>
                                <th width="20%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($semuaPengguna as $pengguna)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $pengguna['nama_pengguna'] }}</td>
                                    <td>{{ $pengguna['jenis_akun'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>
@endsection