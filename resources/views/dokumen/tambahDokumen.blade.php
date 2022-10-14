@extends('layout.master')
@section('tab-title', 'Berkas dan Dokumen')
@section('content')
<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Unggah Dokumen Pegawai</h4>
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
								<a href="{{url('berkas-dokumen')}}">Berkas dan Dokumen</a>
							</li>
                            <li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								Unggah Dokumen
							</li>
						</ul>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Form tambah Data Dokumen -->
                    @if (Str::length(Auth::guard('user')->user()) > 0)
                    @if (auth()->user()->level == "Admin") 
                    <form method="post" action="{{url('berkas-dokumen/') }}" enctype="multipart/form-data">
                    @endif
                    @endif
                    @if (Str::length(Auth::guard('pengguna')->user()) > 0)
                    @if (auth()->user()->level == "Pegawai") 
                    <form method="post" action="{{url('pegawai/berkas-dokumen/') }}" enctype="multipart/form-data">
                    @endif
                    @endif
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_pegawai">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror" 
                                    id="nama_pegawai" name="nama_pegawai" value="{{$pegawai['nama_pegawai']}}" readonly>
                                    @error('nama_pegawai')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nip">NIP</label>
                                    <input type="number" class="form-control @error('nip') is-invalid @enderror" 
                                    id="nip" name="nip" value="{{$pegawai['nip']}}" readonly>
                                    @error('nip')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="judul_dokumen">Judul Dokumen</label>
                                    <input type="text" autocomplete="off" class="form-control @error('judul_dokumen') is-invalid @enderror" 
                                    id="judul_dokumen" name="judul_dokumen">
                                    @error('judul_dokumen')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="file_dokumen">Dokumen</label>
                                  <input type="file" class="form-control" id="file_dokumen" name="file_dokumen">
                                    @error('file_dokumen')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success btn-round ml-auto">
                            <i class="fas fa-file-upload"></i>
                            Unggah Dokumen
                    </form>
                    <!----------------------->
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