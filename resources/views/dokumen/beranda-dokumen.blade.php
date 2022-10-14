@extends('layout.master')
@section('tab-title', 'Berkas dan Dokumen')
@section('content')
<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Berkas dan Dokumen</h4>
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
								Berkas dan Dokumen
							</li>
						</ul>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Tabel Data Pegawai -->
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Jabatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($data_pegawai as $pegawai)
                                        <tr>
                                            <td>{{ $pegawai['nama_pegawai'] }}</td>
                                            <td>{{ $pegawai['nip'] }}</td>
                                            <td>{{ $pegawai['jenis_kelamin'] }}</td>
                                            <td>{{ $pegawai['jabatan'] }}</td>
                                            <td>
                                                <button onclick="window.location.href='{{url('/berkas-dokumen/file/' . $pegawai['nip'] )}}'" type="button" data-toggle="tooltip" data-original-title="Unggah Dokumen" class="btn btn-icon btn-round btn-primary">
                                                    <i class="fas fa-file-upload"></i>
                                                </button>
                                                <button onclick="window.location.href='{{url('berkas-dokumen/berkas/' . $pegawai['nip'] )}}'" type="button" data-toggle="tooltip" data-original-title="Lihat Dokumen" class="btn btn-icon btn-round btn-success">
                                                    <i class="fas fa-file"></i>
                                                </button>
                                        </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
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