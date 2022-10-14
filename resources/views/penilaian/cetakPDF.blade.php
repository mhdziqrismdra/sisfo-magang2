
<!DOCTYPE html>
<html>
<head>
	<title>Penilaian Prestasi Kerja</title>
	<style type="text/css">
		table {
			border-style: double;
			border-width: 3px;
			border-color: white;
		}
		table tr .text2 {
			text-align: right;
			font-size: 13px;
		}
		table tr .text {
			text-align: center;
			font-size: 13px;
		}
		table tr td {
			font-size: 13px;
		}

        table.static {
            position: relative;
            border: 1px solid #543535;
        }
        .textPDF {
            text-align: center
        }

	</style>
</head>
<body>
    <?php 
            function formatTanggal($date)
            {
                // menggunakan class Datetime
                $datetime = DateTime::createFromFormat('Y-m-d', $date);
                return $datetime->format('d-m-Y');
            } 
        ?>
	<center>
		<table>
			<tr>
				<td><img src="{{asset('assets/img/logo_bkn.png')}}" width="90" height="90"></td>
				<td>
				<center>
					<font size="4">PENILAIAN PRESTASI KERJA</font><br>
					<font size="5"><b>BADAN KEPEGAWAIAN NEGARA</b></font><br>
					<font size="2">Kantor Regional XII - Kota Pekanbaru</font><br>
					<font size="2"><i>Jl. Hangtuah Ujung No.148, Sialang Sakti, Kec. Tenayan Raya, Kota Pekanbaru, Riau 28131</i></font>
				</center>
				</td>
			</tr>
			<tr>
				<td colspan="2"><hr></td>
			</tr>
        </table>
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
                @foreach ($penilaianPDF as $nilai)
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
		<br>
		<table width="800" align="right">
			<tr>
				<td width="430"><br><br><br><br><br><br><br></td>
				<td class="text" align="center">Kepala Sub Kepegawaian<br><br><br><br>Sandro, S.I.Kom</td>
			</tr>
	     </table>
	</center>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>