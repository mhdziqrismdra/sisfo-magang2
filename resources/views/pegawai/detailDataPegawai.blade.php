@extends('layout.master')
@section('tab-title', 'Data Pegawai')
@section('content')
<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Detail Data Pegawai</h4>
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
								<a href="{{url('/data-pegawai')}}">Data Pegawai</a>
							</li>
                            <li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
                            <li class="nav-item">
								Detail Pegawai
							</li>
                    </div>
                </div>
                <?php 
                    function tgl_indo($tanggal)
                    {
                        $bulan = array (
                            1 => 'Januari',
                            'Februari',
                            'Maret',
                            'April',
                            'Mei',
                            'Juni',
                            'Juli',
                            'Agustus',
                            'September',
                            'Oktober',
                            'November',
                            'Desember'
                        );
                        $pecahkan = explode('-', $tanggal);
                        return $pecahkan[2] . ' ' . $bulan [(int)$pecahkan[1]] . ' ' . $pecahkan[0];
                    }
                    
                ?>
                <div class="card-body">
                    <table id="general-table" class="table table-striped table-vcenter table-hover">
                        <tbody>  
                            <tr>
                              <td><strong>NIP</strong></td>
                              <td>{{$detail_pegawai->nip}}</td>
                          </tr>
    
                          <tr>
                              <td><strong>Nama Pegawai</strong></td>
                              <td>{{$detail_pegawai->nama_pegawai}}</td>
                          </tr>
    
                          <tr>
                              <td><strong>Jenis Kelamin</strong></td>
                              <td>{{$detail_pegawai->jenis_kelamin}}</td>
                          </tr>

                          <tr>
                              <td><strong>Tempat, Tanggal Lahir</strong></td>
                              <td>{{$detail_pegawai->tempat_lahir}}, <?php echo tgl_indo("$detail_pegawai->tanggal_lahir") ?></td>
                          </tr>
    
                          <tr>
                              <td><strong>Golongan</strong></td>
                              <td>{{$detail_pegawai->golongan}}</td>
                          </tr>
    
                          <tr>
                              <td><strong>Jabatan</strong></td>
                              <td>{{$detail_pegawai->jabatan}}</td>
                          </tr>
    
                          <tr>
                              <td><strong>Alamat</strong></td>
                              <td><?php echo str_replace("\n", "<br>", $detail_pegawai->alamat) ?></td>
                          </tr>
                      </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
@push('page-script')
@include('sweetalert::alert')
@endpush