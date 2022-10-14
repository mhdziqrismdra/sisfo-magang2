@extends('layout.master')
@section('tab-title', 'Berkas dan Dokumen')
@section('content')
<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Daftar Dokumen</h4>
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
								Daftar Dokumen
							</li>
						</ul>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{-- {{url('data-pegawai/' . $pegawai['nip']) }} --}}">
                        @csrf
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="number" class="form-control @error('nip') is-invalid @enderror" 
                            id="nip" name="nip" value="{{$peg->nip}}" disabled>
                            @error('nip')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
    
                        <div class="form-group">
                            <label for="nama_pegawai">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror" 
                            id="nama_pegawai" name="nama_pegawai" value="{{$peg->nama_pegawai}}" disabled>
                            @error('nama_pegawai')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
    
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" class="form-control @error('jabatan') is-invalid @enderror" 
                            id="jabatan" name="jabatan" value="{{$peg->jabatan}}" disabled>
                            @error('jabatan')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <!-- Tabel Data Dokumen Pegawai -->
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Judul Dokumen</th>
                                    <th>Waktu Upload</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <?php 
                                function formatTanggal($date)
                                {
                                    // menggunakan class Datetime
                                    $datetime = DateTime::createFromFormat('Y-m-d', $date);
                                    return $datetime->format('d-m-Y');
                                } 
                            ?>
                            <tbody>
                                @foreach ($peg->dokumen as $dokumen)
                                    <tr>
                                        <td>{{$loop -> iteration}}</td>
                                        <td>{{$dokumen->judul_dokumen}}</td>
                                        <td>{{$dokumen->created_at}}</td>
                                        <td>
                                            <button onclick="window.location.href='{{ url('/berkas-dokumen/berkas/download/' . $dokumen->id_dokumen)}}'" type="button" data-toggle="tooltip" class="btn btn-icon btn-round btn-success">
                                                <i class="fas fa-file-download"></i>
                                            </button>
                                        
                                            @if (Str::length(Auth::guard('user')->user()) > 0)
                                            @if (auth()->user()->level == "Admin") 
                                            <form action="{{ url('/berkas-dokumen/berkas/' . $dokumen->id_dokumen)}}" class="d-inline" onsubmit="return confirm('Yakin ingin hapus dokumen ini?')" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-icon btn-round btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            @endif
                                            @endif
                                            @if (Str::length(Auth::guard('pengguna')->user()) > 0)
                                            @if (auth()->user()->level == "Pegawai") 
                                            <form action="{{ url('pegawai/berkas-dokumen/berkas/' . $dokumen->id_dokumen)}}" class="d-inline" onsubmit="return confirm('Yakin ingin hapus dokumen ini?')" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-icon btn-round btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            @endif
                                            @endif
                                            
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!----------------------->
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