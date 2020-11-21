@extends('layout.main')
@section('content')
<div class="row m-t-25">
    <div class="col-md-12">
        <div class="card">
            <form action="" method="post">
                @csrf
                <input type="hidden" name="idrekap" value="{{ $id_rekap }}">
                <div class="card-header">
                    <i class="fa fa-calculator"></i> Hitung Jumlah Ikan
                </div>
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
                                <th>Nama Pemancing</th>
                                <th width="20%" class="text-center">Lapak</th>
                                <th width="20%" class="text-center">Jumlah Ikan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                                @foreach ($semuaPemancing as $pemancing)
                                <tr>
                                    <td class="align-middle text-center">{{ $no++ }}</td>
                                    <td class="align-middle">{{ $pemancing->nama_pemancing }} <input type="hidden" name="idpemancing[]" value="{{ $pemancing->id_pemancing }}"></td>
                                    <td class="align-middle text-center">{{ $pemancing->lapak_sekarang }} <input type="hidden" name="lapaksekarang[]" value="{{ $pemancing->lapak_sekarang }}"></td>
                                    <td class="align-middle text-center"><input type="number" name="jumlahikan[]" class="form-control"></td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection