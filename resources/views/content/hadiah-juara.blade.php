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
                            <th class="text-center">Jumlah Pemancing</th>
                            <th width="20%" class="text-center">Juara 1</th>
                            <th width="20%" class="text-center">Juara 2</th>
                            <th width="20%" class="text-center">Juara 3</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($semuaHadiah as $hadiah)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center">{{ $hadiah['jumlah_pemancing'] }} &nbsp;Orang</td>
                                <td class="text-center">{{ $hadiah['juara_1'] }}</td>
                                <td class="text-center">{{ $hadiah['juara_2'] }}</td>
                                <td class="text-center">{{ $hadiah['juara_3'] }}</td>
                                <td class="text-center">
                                    <a href="{{ url('hadiah-juara') }}/{{ $hadiah['jumlah_pemancing'] }}/edit" class="text-warning"><i class="fa fa-edit"></i></a>
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