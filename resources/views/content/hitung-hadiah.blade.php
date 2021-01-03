@extends('layout.main')
@section('content')
<div class="row m-t-25">
    <div class="col-md-12">
        <select class="form-control" id="pilihSesi">
            <option value="">Pilih Sesi</option>
            @foreach ($sesi as $sesi)
                <option value="{{ $sesi->sesi_ke }}">Sesi Ke {{ $sesi->sesi_ke }}</option>
            @endforeach
        </select>
        <br>
        <div class="card" id="card">

        </div>
    </div>
</div>
@endsection
@section('js-plugins')
    <script>
        $(()=>{
            $("#pilihSesi").change(() => {
                var sesi =$("#pilihSesi").val();
                var url = "{{ url('/rekap-mancing/').'/'.$idRekap.'/detail-rekap/get-juara/' }}"+ sesi;
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function (response) {
                        $("#card").html(response)
                    }
                });
            });
        });
    </script>
@endsection
