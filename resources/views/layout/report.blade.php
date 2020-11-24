@php
    $no = 1;
@endphp
<html>
<head>
    <style>
        *{
            font-family: sans-serif;
        }
        .table-isi *{
            border: 2px solid #aaa;
            padding: 10px;
            text-align: left;
        }
        * .text-center{
            text-align: center;
        }
    </style>
</head>
<body>
    <br>
    <center>
        <span style="font-size: 20pt">PEMANCINGAN EKA JAYA</span>
    </center>
    <br>
    <br>
    <br>
    <table class="table-borderless">
        <tr>
            <td>Halaman&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>:&nbsp;&nbsp;</td>
            <td>Laporan Pemancingan Eka Jaya</td>
        </tr>
        <tr>
            <td>Dari</td>
            <td>:&nbsp;&nbsp;</td>
            <td>{{ $data['startdate'] }}</td>
        </tr>
        <tr>
            <td>Sampai&nbsp;&nbsp;</td>
            <td>:&nbsp;&nbsp;</td>
            <td>{{ $data['enddate'] }}</td>
        </tr>
    </table>
    <br>
    <table class="table table-isi"  style="border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th width="5%" class="text-center">No</th>
            <th width="35%">Tanggal</th>
            <th width="25%" class="text-center">Jumlah Pemancing</th>
            <th width="35%">Jumlah Pendapatan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataRekap as $rekap)
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td>{{ $rekap['tanggal'] }}</td>
                <td class="text-center">{{ $rekap['jumlah_pemancing'] }}</td>
                <td>RP {{ $rekap['jumlah_pendapatan'] }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3">Total Pendapatan</td>
            <td>RP {{ $totalPendapatan }}</td>
        </tr>
    </tbody>
    </table>
</body>
</html>