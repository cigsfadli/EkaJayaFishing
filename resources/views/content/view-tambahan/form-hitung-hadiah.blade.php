<div class="card-header">
    <i class="fa fa-calculator"></i> &nbsp; Hitung Hadiah Juara Sesi {{ $sesi }}
</div>
<div class="card-body">
    <div class="alert alert-primary">
        <table>
            <tr>
                <td>Jumlah Pemancing</td>
                <td>&nbsp;&nbsp;:&nbsp;&nbsp;</td>
                <td>{{ $jumlahPemancing }}</td>
            </tr>
        </table>
    </div>
    <form action="" method="post" class="form">
        @csrf
        <input type="hidden" name="sesi_ke" value="{{ $sesi }}">
        <input type="hidden" name="idRekap" value="{{ $idRekap }}">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pemancing</th>
                    <th class="text-center">Lapak</th>
                    <th class="text-center">Jumlah Ikan</th>
                    <th>Hadiah</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach ($dataSesiMancing as $pemancing)
                    <input type="hidden" name="id_temp_hitung_ikan[]" value="{{ $pemancing->id_temp_hitung_ikan }}">
                    <input type="hidden" name="id_pemancing[]" value="{{ $pemancing->id_pemancing }}">
                    <tr>
                        <td>
                            {{ $no++ }}
                        </td>
                        <td>
                            {{ $pemancing->nama_pemancing }}
                        </td>
                        <td class="text-center">
                            {{ $pemancing->lapak }}
                        </td>
                        <td class="text-center">
                            {{ $pemancing->jumlah_ikan }}
                        </td>
                        <td>
                            <input type="number" name="hadiah[]" id="hadiah" class="form-control">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary float-right mt-4">Simpan</button>
    </form>
</div>
