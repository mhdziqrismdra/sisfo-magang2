@extends('layout.master')
@section('tab-title', 'Penilaian Prestasi Kerja')
@section('content')
<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-right">
                        <h4 class="card-title">Cetak Penilaian</h4>
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
								Cetak
							</li>
						</ul>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filter Tanggal -->
                    <form action="{{url('penilaian-prestasi-kerja/export/pdf')}}">
                        <div class="row">
                            <div class="col-md-6 pr-0">
                                <div class="form-group form-group-default">
                                    <label for="periode_awal">Dari Periode</label>
                                    <input type="date" autocomplete="off" class="form-control @error('periode_awal') is-invalid @enderror" 
                                    id="periode_awal" name="periode_awal">
                                    @error('periode_awal')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label for="periode_akhir">Hingga Periode</label>
                                    <input type="date" autocomplete="off" class="form-control @error('periode_akhir') is-invalid @enderror" 
                                    id="periode_akhir" name="periode_akhir">
                                    @error('periode_akhir')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary btn-round ml-auto">
                            <i class="fas fa-search"></i>
                            Cari Data Penilaian
                        </div>
                    </form>
                    <!-------------------------->
                    
                </div>
            </div>
            <div class="card">
                @if(!empty(request()->get('periode_awal')) && !empty(request()->get('periode_akhir')))
                <div class="card-header">
                    <div class="d-flex align-items-left">
                        <button onclick="window.open('{{ url('/penilaian-prestasi-kerja/export/pdf') . '/' . $periode_awal . '/' .  $periode_akhir}}','_blank')" class="btn btn-danger btn-round ml-auto">
                            <i class="fas fa-file-pdf"></i>
                            Cetak PDF
                        </button>
                        <button onclick="window.location.href='{{ url('penilaian-prestasi-kerja/export/excel') . '/' . $periode_awal . '/' .  $periode_akhir}}'" class="btn btn-success btn-round ml-3">
                            <i class="fas fa-file-excel"></i>
                            Cetak Excel
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Tabel Data Pegawai -->
                    <?php 
                        function formatTanggal($date)
                        {
                            // menggunakan class Datetime
                            $datetime = DateTime::createFromFormat('Y-m-d', $date);
                            return $datetime->format('d-m-Y');
                        } 
                    ?>
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Nama Pegawai</th>
                                    <th>NIP</th>
                                    <th>Periode Penilaian</th>
                                    <th>Atasan Langsung</th>
                                    <th>Atasan Pejabat Penilai</th>
                                    <th>Nilai Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            @foreach ($data_nilai as $nilai)
                                        <tr>
                                            <td>{{ $nilai->pegawai->nama_pegawai }}</td>
                                            <td>{{ $nilai->pegawai->nip }}</td>
                                            <td><?php echo '(' . formatTanggal("$nilai->periode_awal") . ')' . ' - ' . '(' . formatTanggal("$nilai->periode_akhir") . ')' ?></td>
                                            <td>{{ $nilai->atasan_langsung }}</td>
                                            <td>{{ $nilai->atasan_pejabat_penilai }}</td>
                                            <td>{{ $nilai->jumlah }}</td>
                                        </tr>
                            @endforeach
                            
                            </tbody>
                        </table>
                    </div>
                    
                </div>
        </div>
        @endif
    </div>
</div>
@endsection
@push('page-script')
@include('sweetalert::alert')
<script >
    $('#basic-datatables').DataTable();
</script>
@endpush