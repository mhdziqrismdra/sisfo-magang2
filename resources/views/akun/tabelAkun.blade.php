@extends('layout.master')
@section('tab-title', 'Berkas dan Dokumen')
@section('content')
<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Data Akun</h4>
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
								Data Akun
							</li>
						</ul>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Tabel Data Akun -->
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Nama Akun</th>
                                    <th>Email</th>
                                    <th>NIP</th>
                                    <th>Waktu Registrasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($data_akun as $ac)
                                        <tr>
                                            <td>{{ $ac['name'] }}</td>
                                            <td>{{ $ac['email'] }}</td>
                                            <td>{{ $ac['nip'] }}</td>
                                            <td>{{ $ac['created_at'] }}</td>
                                            <td>
                                                <button type="button" class="btn btn-icon btn-round btn-success" data-toggle="modal" data-target="#addRowModal{{$ac['id']}}">
                                                    <i class="fas fa-pen"></i>
                                                </button>
                                                <form action="{{ url('/akun-pegawai/' . $ac['id'])}}" class="d-inline" onsubmit="return confirm('Yakin ingin hapus akun ini?')" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-icon btn-round btn-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                                    <div class="modal fade" id="addRowModal{{$ac['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                          <div class="modal-content">
                                                            <div class="modal-header">
                                                              <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                              </button>
                                                            </div>
                                                            <form action="{{url('akun-pegawai/ubah/' . $ac->id)}}" method="POST">
                                                              <div class="modal-body">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group form-group-default">
                                                                            <label for="nip">Nama Akun</label>
                                                                            <input type="text" autocomplete="off" class="form-control @error('email') is-invalid @enderror" 
                                                                            id="email" name="nama_pegawai" value="{{$ac->name}}" readonly>
                                                                            @error('nip')
                                                                                <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group form-group-default">
                                                                            <label for="nip">Email</label>
                                                                            <input type="email" autocomplete="off" class="form-control @error('email') is-invalid @enderror" 
                                                                            id="email" name="email" value="{{$ac->email}}" readonly>
                                                                            @error('nip')
                                                                                <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group form-group-default">
                                                                            <label for="nip">Password Baru</label>
                                                                            <input type="password" autocomplete="off" class="form-control @error('nip') is-invalid @enderror" 
                                                                            id="nip" name="password">
                                                                            @error('nip')
                                                                                <div class="text-danger">{{ $message }}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                              <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger">Ubah</button>
                                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                                                              </div>
                                                            </form>
                                                          </div>
                                                        </div>
                                                    </div>
                                                
                                            </td>
                                        </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Modal Ubah Password -->
                    {{-- <div class="modal fade" id="addRowModal-{{$item['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{url('akun-pegawai/ubah/' . $item->id)}}" method="POST">
                              <div class="modal-body">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label for="nip">Nama Akun</label>
                                            <input type="text" autocomplete="off" class="form-control @error('email') is-invalid @enderror" 
                                            id="email" name="nama_pegawai" value="{{$item->name}}" readonly>
                                            @error('nip')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label for="nip">Email</label>
                                            <input type="email" autocomplete="off" class="form-control @error('email') is-invalid @enderror" 
                                            id="email" name="email" value="{{$item->email}}" readonly>
                                            @error('nip')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label for="nip">Password Baru</label>
                                            <input type="password" autocomplete="off" class="form-control @error('nip') is-invalid @enderror" 
                                            id="nip" name="password">
                                            @error('nip')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Ubah</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                              </div>
                            </form>
                          </div>
                        </div>
                    </div> --}}
                    
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