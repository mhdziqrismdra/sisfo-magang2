@extends('layout.master')
@section('tab-title', 'Memorandum of Understanding (MOU)')
@section('content')
<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Memorandum of Understanding (MOU)</h4>
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
								Memorandum of Understanding (MOU)
							</li>
						</ul>
                        <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                            <i class="fa fa-plus"></i>
                            Tambah Data
                        </button>
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
                            
                        </table>
                    </div>
                    <!-------------------------->
                    <!-- Modal Tambah Data -->
                    <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pegawai</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{url('data-pegawai/')}}" method="POST">
                              <div class="modal-body">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label for="nip">NIP</label>
                                            <input type="number" autocomplete="off" class="form-control @error('nip') is-invalid @enderror" 
                                            id="nip" name="nip">
                                            @error('nip')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <div class="form-group form-group-default">
                                            <label for="nama_pegawai">Nama Lengkap</label>
                                            <input type="text" autocomplete="off" class="form-control @error('nama_pegawai') is-invalid @enderror" 
                                            id="nama_pegawai" name="nama_pegawai">
                                            @error('nama_pegawai')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label for="jenis_kelamin">Jenis Kelamin</label>
                                            <select class="form-control @error('jenis_kelamin') is-invalid @enderror" 
                                            id="jenis_kelamin" name="jenis_kelamin">
                                            <option>Laki-laki</option>
                                            <option>Perempuan</option>
                                            </select>
                                            @error('jenis_kelamin')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label for="tempat_lahir">Tempat Lahir</label>
                                            <input type="text" autocomplete="off" class="form-control @error('tempat_lahir') is-invalid @enderror" 
                                            id="tempat_lahir" name="tempat_lahir">
                                            @error('tempat_lahir')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date" autocomplete="off" class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                            id="tanggal_lahir" name="tanggal_lahir">
                                            @error('tanggal_lahir')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-0">
                                        <div class="form-group form-group-default">
                                            <label for="golongan">Golongan</label>
                                            <select class="form-control @error('golongan') is-invalid @enderror" 
                                            id="golongan" name="golongan">
                                            <option>I A</option>
                                            <option>I B</option>
                                            <option>I C</option>
                                            <option>I D</option>
                                            <option>II A</option>
                                            <option>II B</option>
                                            <option>II C</option>
                                            <option>II D</option>
                                            <option>III A</option>
                                            <option>III B</option>
                                            <option>III C</option>
                                            <option>III D</option>
                                            <option>IV A</option>
                                            <option>IV B</option>
                                            <option>IV C</option>
                                            <option>IV D</option>
                                            <option>IV E</option>
                                            </select>
                                            @error('golongan')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label for="jabatan">Jabatan</label>
                                            <input type="text" autocomplete="off" class="form-control @error('jabatan') is-invalid @enderror" 
                                            id="jabatan" name="jabatan">
                                            @error('jabatan')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label for="alamat">Alamat</label>
                                            <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat"></textarea>
                                            @error('alamat')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" name="btnsubmit" class="btn btn-danger">Simpan</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                              </div>
                            </form>
                          </div>
                        </div>
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