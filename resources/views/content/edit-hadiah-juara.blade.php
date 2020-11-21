@extends('layout.main')
@section('content')
<div class="row m-t-25">
    <div class="col-md-12">
        <div class="card">
            <form action="" method="POST">
                @csrf
                <div class="card-header">
                    Edit Jumlah Hadiah {{ $hadiah['jumlah_pemancing'] }} Orang Pemancing
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <small>
                            <label for="juara-1">Juara 1 (RP)</label>
                        </small>
                        <input type="hidden" name="id_juara_1" value="{{ $hadiah['id_juara_1'] }}">
                        <input type="text" class="form-control" name="hadiah_juara_1" value="{{ $hadiah['juara_1'] }}">
                    </div>
                    <div class="form-group">
                        <small>
                            <label for="juara-2">Juara 2 (RP)</label>
                        </small>
                        <input type="hidden" name="id_juara_2" value="{{ $hadiah['id_juara_2'] }}">
                        <input type="text" class="form-control" name="hadiah_juara_2" value="{{ $hadiah['juara_2'] }}">
                    </div>
                    <div class="form-group">
                        <small>
                            <label for="juara-3">Juara 3 (RP)</label>
                        </small>
                        <input type="hidden" name="id_juara_3" value="{{ $hadiah['id_juara_3'] }}">
                        <input type="text" class="form-control" name="hadiah_juara_3" value="{{ $hadiah['juara_3'] }}">
                    </div>
                </div>
                <div class="card-footer text-right" >
                    <button class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection