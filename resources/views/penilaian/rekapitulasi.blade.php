@extends('layout.master')
@section('tab-title', 'Penilaian Prestasi Kerja')
@section('content')
<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Rekapitulasi Nilai</h4>
                        <ul class="breadcrumbs">
							<li class="nav-home">
								<a href="#">
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
								Rekapitulasi Nilai
							</li>
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
            @if (Str::length(Auth::guard('user')->user()) > 0)
            @if (auth()->user()->level == "Admin") 
            <form method="GET" action="{{url('penilaian-prestasi-kerja/rekapitulasi/' . $peg->nip . '/search')}}">
            @endif
            @endif
            @if (Str::length(Auth::guard('pengguna')->user()) > 0)
            @if (auth()->user()->level == "Pegawai") 
            <form method="GET" action="{{url('pegawai/penilaian-prestasi-kerja/rekapitulasi/' . $peg->nip . '/search')}}">
            @endif
            @endif
                <?php 
                    function formatTanggal($date)
                    {
                        // menggunakan class Datetime
                        $datetime = DateTime::createFromFormat('Y-m-d', $date);
                        return $datetime->format('d-m-Y');
                    } 
                ?>
                <div class="form-group col-md-6">
                    <table>
                        <tr>
                            <td>Pilih Periode</td>
                            <td>:</td>
                            <td>
                                <select class="form-control" 
                                id="periode" name="periode">
                                <option value="" hidden {{ empty(request()->get('periode')) ? 'selected' : null }}>== Pilih Periode ==</option>
                                @foreach ($peg->penilaian as $item)
                                <option value="{{$item->periode_awal}}" {{ request()->get('periode') == $item->periode_awal ? 'selected' : null }}><?php echo '(' . formatTanggal("$item->periode_awal") . ')' . ' - ' . '(' . formatTanggal("$item->periode_akhir") . ')' ?></option>
                                @endforeach
                                </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-icon btn-round btn-primary ml-2"><i class="fas fa-search"></i></button>
                            </td>
                        </tr>
                    </table>         
                </div>
            </form>
            @if(!empty(request()->get('periode')))
            <div class="card">
                @foreach ($data_penilaian as $penilaian)
                @if (Str::length(Auth::guard('user')->user()) > 0)
                @if (auth()->user()->level == "Admin") 
                <div class="card-header">
                    <div class="d-flex align-items-center float-right">
                        <form action="{{ url('/penilaian-prestasi-kerja/' . $penilaian->id_penilaian)}}" class="d-inline" onsubmit="return confirm('Yakin ingin hapus data ini?')" method="POST">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-round ml-auto">
                                <i class="fas fa-trash">
                                    Hapus Penilaian
                                </i>
                            </button>
                        </form>     
                    </div> 
                </div>
                @endif
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                      <table id="basic-datatables" class="display table table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                              <th scope="col">NO</th>
                              <th scope="col">JENIS PENILAIAN</th>
                              <th scope="col">NILAI</th>
                            </tr>
                          </thead>
    
                          <tbody>
                            
                            <tr>
                                <td>1</td>
                                <td>CAPAIAN KERJA</td>
                                <td>{{$penilaian->capaian_kerja}}</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>ORIENTASI PELAYANAN</td>
                                <td>{{$penilaian->orientasi_pelayanan}}</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>INTEGRITAS</td>
                                <td>{{$penilaian->integritas}}</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>KOMITMEN</td>
                                <td>{{$penilaian->komitmen}}</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>DISIPLIN</td>
                                <td>{{$penilaian->disiplin}}</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>KERJASAMA</td>
                                <td>{{$penilaian->kerjasama}}</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>KEPEMIMPINAN</td>
                                <td>{{$penilaian->kepemimpinan}}</td>
                            </tr>
                            <tr>
                                <th colspan="2">JUMLAH</th>
                                <td>{{$penilaian->jumlah}}</td>
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
    
</div>
@endsection
@push('page-script')
@include('sweetalert::alert')
@endpush