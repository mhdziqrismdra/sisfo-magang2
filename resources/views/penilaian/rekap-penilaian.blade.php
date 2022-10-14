@extends('layout.master')
@section('tab-title', 'Penilaian Prestasi Kerja')
@section('content')
<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-right">
                        <h4 class="card-title">Rekap Penilaian</h4>
                        <ul class="breadcrumbs">
							<li class="nav-home">
								<a href="{{url('/dashboard')}}">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="{{url('penilaian-prestasi-kerja')}}">Penilaian Prestasi Kerja</a>
							</li>
                            <li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								Rekap
							</li>
						</ul>
                    </div>
                </div>
                <div class="card-body">
                    <?php 
                        function formatTanggal($date)
                        {
                            // menggunakan class Datetime
                            $datetime = DateTime::createFromFormat('Y-m-d', $date);
                            return $datetime->format('d-m-Y');
                        } 
                    ?>
                    <!-- Tabel Data Pegawai -->
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Periode Penilaian</th>
                                    <th>Atasan Langsung</th>
                                    <th>Atasan Pejabat Penilai</th>
                                    <th>Nilai Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($penilaian as $nilai)
                                        <tr>
                                            <td>{{ $nilai->pegawai->nama_pegawai}}</td>
                                            <td>{{ $nilai->nip }}</td>
                                            <td><?php echo '(' . formatTanggal("$nilai->periode_awal") . ')' . ' - ' . '(' . formatTanggal("$nilai->periode_akhir") . ')' ?></td>
                                            <td>{{ $nilai->atasan_langsung }}</td>
                                            <td>{{ $nilai->atasan_pejabat_penilai }}</td>
                                            <td>{{ $nilai->jumlah }}</td>
                                        </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-------------------------->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('page-script')
@include('sweetalert::alert')
<script >
    $('#basic-datatables').DataTable();
</script>
@endpush