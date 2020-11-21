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
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="20px" class="text-center">No</th>
                            <th>Tanggal Rekap</th>
                            <th width="30%">Tagihan (RP)</th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($tagihan as $tagihan)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td>{{ $tagihan['nama_pemancing'] }}</td>
                                <td>{{ $tagihan['tagihan'] }}</td>
                                <td class="text-center">
                                    {{-- <small><a href="#" class="text-primary">Detail Tagihan</a></small> --}}
                                    <small><a href="{{ url('/kasir').'/'.$tagihan['id_pemancing'] }}/detail-tagihan" class="text-success"><i class="fa fa-money-bill-alt"></i> Bayar</a></small>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection