<?php 
 function formatTanggal($date)
    {
        // menggunakan class Datetime
        $datetime = DateTime::createFromFormat('Y-m-d', $date);
        return $datetime->format('d-m-Y');
    } 
    date_default_timezone_set('Asia/Jakarta');
        $tanggal = date("dmYhis");
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Penilaian Prestasi Kerja - ".$tanggal. ".xls");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export</title>
</head>
<body>
<table class="static" align="center" rules="all" border="1px" style="width: 95%;" align="center">
            <thead>
                <tr>
                    <th rowspan="2">Nama Pegawai</th>
                    <th rowspan="2" width="90">NIP</th>
                    <th colspan="8">Penilaian</th>
                    <th rowspan="2">Atasan Langsung</th>
                    <th rowspan="2">Atasan Pejabat Penilai</th>
                    <th rowspan="2">Periode</th>
                </tr>
                <tr>
                    <td class="textPDF">Capaian Kerja</td>
                    <td class="textPDF">Orientasi Pelayanan</td>
                    <td class="textPDF">Integritas</td>
                    <td class="textPDF">Komitmen</td>
                    <td class="textPDF">Disiplin</td>
                    <td class="textPDF">Kerjasama</td>
                    <td class="textPDF">Kepemimpinan</td>
                    <td class="textPDF">Nilai Akhir</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $nilai)
                    <tr>
                        <td>{{$nilai->pegawai->nama_pegawai}}</td>
                        <td>{{$nilai->pegawai->nip}}</td>
                        <td class="textPDF">{{$nilai->capaian_kerja}}</td>
                        <td class="textPDF">{{$nilai->orientasi_pelayanan}}</td>
                        <td class="textPDF">{{$nilai->integritas}}</td>
                        <td class="textPDF">{{$nilai->komitmen}}</td>
                        <td class="textPDF">{{$nilai->disiplin}}</td>
                        <td class="textPDF">{{$nilai->kerjasama}}</td>
                        <td class="textPDF">{{$nilai->kepemimpinan}}</td>
                        <td class="textPDF">{{$nilai->jumlah}}</td>
                        <td>{{$nilai->atasan_langsung}}</td>
                        <td>{{$nilai->atasan_pejabat_penilai}}</td>
                        <td><?php echo '(' . formatTanggal("$nilai->periode_awal") . ')' . ' s/d ' . '(' . formatTanggal("$nilai->periode_akhir") . ')' ?></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</body>
</html>