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
                            <th width="20%" class="text-center"><i class="fa fa-users"></i></th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekaps as $rekap)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td>{{ $rekap['tanggal_rekap'] }}</td>
                                <td class="text-center">{{ $rekap['jumlah_pemancing'] }}</td>
                                <td class="text-center"><a href="{{ url('/rekap-mancing/'.$rekap['id_rekap']).'/detail-rekap' }}"><i class="fa fa-list"></i> Detail Rekap</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection