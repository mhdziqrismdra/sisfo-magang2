@extends('layout.master')
@section('tab-title', 'Penilaian Prestasi Kerja')
@section('content')
<div class="page-inner mt--5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Data Penilaian</h4>
                        <ul class="breadcrumbs">
							<li class="nav-home">
								<a href="{{url('dashboard')}}">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								Penilaian Prestasi Kerja
							</li>
                    </div>
                </div>
                <div class="card-body">
                    @foreach ($data_pegawai as $item)
                    <!-- Modal Tambah Data Penilaian -->
                    <div class="modal fade" id="addRowModal-{{$item['nip']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Form Penilaian Prestasi Kerja</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{url('penilaian-prestasi-kerja/')}}" method="POST">
                              <div class="modal-body">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default">
                                            <label for="nip">NIP</label>
                                            <input type="number" autocomplete="off" class="form-control @error('nip') is-invalid @enderror" 
                                            id="nip" name="nip" value="{{$item['nip']}}" readonly>
                                            @error('nip')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-0">
                                        <div class="form-group form-group-default">
                                            <label for="nama_pegawai">Nama Lengkap</label>
                                            <input type="text" autocomplete="off" class="form-control @error('nama_pegawai') is-invalid @enderror" 
                                            id="nama_pegawai" name="nama_pegawai" value="{{$item['nama_pegawai']}}" readonly>
                                            @error('nama_pegawai')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-default">
                                            <label for="jabatan">Jabatan</label>
                                            <input type="text" autocomplete="off" class="form-control @error('jabatan') is-invalid @enderror" 
                                            id="jabatan" name="jabatan" value="{{$item['jabatan']}}" readonly>
                                            @error('jabatan')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-0">
                                        <div class="form-group form-group-default">
                                            <label for="atasan_langsung">Nama Atasan Langsung</label>
                                            <input type="text" autocomplete="off" class="form-control @error('atasan_langsung') is-invalid @enderror" 
                                            id="atasan_langsung" name="atasan_langsung">
                                            @error('nama_atasan_langsung')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <div class="form-group form-group-default">
                                            <label for="atasan_pejabat_penilai">Nama Atasan Pejabat Penilai</label>
                                            <input type="text" autocomplete="off" class="form-control @error('atasan_pejabat_penilai') is-invalid @enderror" 
                                            id="atasan_pejabat_penilai" name="atasan_pejabat_penilai">
                                            @error('atasan_pejabat_penilai')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror        
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-0">
                                        <div class="form-group form-group-default">
                                            <label for="periode_awal">Dari Periode</label>
                                            <input type="date" class="form-control @error('periode_awal') is-invalid @enderror" 
                                            id="periode_awal" name="periode_awal">
                                            @error('periode_awal')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror        
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <div class="form-group form-group-default">
                                            <label for="periode_akhir">Hingga Periode</label>
                                            <input type="date" class="form-control @error('periode_akhir') is-invalid @enderror" 
                                            id="periode_akhir" name="periode_akhir">
                                            @error('periode_akhir')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror        
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-0">
                                        <div class="form-group form-group-default">
                                            <label for="capaian_kerja">Capaian Kerja</label>
                                            <input type="text" autocomplete="off" id="" name="capaian_kerja" value="0" class="form-control capaian_kerja @error('capaian_kerja') is-invalid @enderror" >
                                            @error('capaian_kerja')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror        
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <div class="form-group form-group-default">
                                            <label for="orientasi_pelayanan">Orientasi Pelayanan</label>
                                            <input type="text" autocomplete="off" id="" name="orientasi_pelayanan" value="0" class="form-control orientasi_pelayanan @error('orientasi_pelayanan') is-invalid @enderror" >
                                            @error('orientasi_pelayanan')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror        
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-0">
                                        <div class="form-group form-group-default">
                                            <label for="integritas">Integritas</label>
                                            <input type="text" autocomplete="off" id="" name="integritas" value="0" class="form-control integritas @error('integritas') is-invalid @enderror">
                                            @error('integritas')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror        
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <div class="form-group form-group-default">
                                            <label for="komitmen">Komitmen</label>
                                            <input type="text" autocomplete="off" id="" name="komitmen" value="0" class="form-control komitmen @error('komitmen') is-invalid @enderror">
                                            @error('komitmen')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror        
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-0">
                                        <div class="form-group form-group-default">
                                            <label for="disiplin">Disiplin</label>
                                            <input type="text" autocomplete="off" id="" name="disiplin" value="0" class="form-control disiplin @error('disiplin') is-invalid @enderror">
                                            @error('disiplin')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror        
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <div class="form-group form-group-default">
                                            <label for="kerjasama">Kerjasama</label>
                                            <input type="text" autocomplete="off" id="" name="kerjasama" value="0" class="form-control kerjasama @error('kerjasama') is-invalid @enderror">
                                            @error('kerjasama')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror        
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-0">
                                        <div class="form-group form-group-default">
                                            <label for="kepemimpinan">Kepemimpinan</label>
                                            <input type="text" autocomplete="off" id="" name="kepemimpinan" value="0" class="form-control kepemimpinan @error('kepemimpinan') is-invalid @enderror">
                                            @error('kepemimpinan')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror      
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <div class="form-group form-group-default">
                                            <label for="jumlah">Jumlah</label>
                                            <input type="text" id="" name="jumlah" value="0" class="form-control jumlah @error('jumlah') is-invalid @enderror" readonly="">
                                            @error('jumlah')
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
                    @endforeach
                    
                    <!-- Tabel Data Pegawai -->
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" >
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
                                                <button type="button" class="btn btn-icon btn-round btn-primary" data-toggle="modal" data-target="#addRowModal-{{$pegawai['nip']}}">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                                <button onclick="window.location.href='{{ url('/penilaian-prestasi-kerja/rekapitulasi/' . $pegawai['nip'] )}}'" type="button" class="btn btn-icon btn-round btn-warning">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-------------------------->
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
    $(document).ready(function() {
        $('#basic-datatables').DataTable({
        });
    });
</script>
<script type="text/javascript">
    $(document).on('keyup',  '.disiplin, .integritas, .orientasi_pelayanan, .komitmen, .kerjasama, .kepemimpinan, .capaian_kerja', function(e){
        e.preventDefault();
        let el = $(this).parent().parent().parent().parent();
        penilaianKaryawan(el);
    });
    

    function penilaianKaryawan(el = '')
    {
        var orientasi_pelayanan = $(el.find('.orientasi_pelayanan')).val();
        var integritas = $(el.find('.integritas')).val();
        var komitmen = $(el.find('.komitmen')).val();
        var disiplin = $(el.find('.disiplin')).val();
        var kerjasama = $(el.find('.kerjasama')).val();
        var kepemimpinan = $(el.find('.kepemimpinan')).val();
        var capaian_kerja = $(el.find('.capaian_kerja')).val();

        if (kepemimpinan == 0){
            var total = (parseInt(orientasi_pelayanan) + parseInt(integritas) + parseInt(komitmen) + 
            parseInt(disiplin) + parseInt(kerjasama)) / 5;
            var totalakhir = total * 0.4;
            var totalcapaiankerja = parseInt(capaian_kerja) * 0.6;
            var jumlah = totalakhir + totalcapaiankerja;
            var hasil = jumlah.toFixed(2);
            $("#total").val(total);
            $("#totalakhir").val(totalakhir);
            $("#totalcapaiankerja").val(totalcapaiankerja);
            //$("#jumlah").val(hasil);
            $(el.find('.jumlah')).val(hasil);
        }
        else{
            var total = (parseInt(orientasi_pelayanan) + parseInt(integritas) + parseInt(komitmen) + 
            parseInt(disiplin) + parseInt(kerjasama) + parseInt(kepemimpinan)) / 6;
            var totalakhir = total * 0.4;
            var totalcapaiankerja = parseInt(capaian_kerja) * 0.6;
            var jumlah = totalakhir + totalcapaiankerja;
            var hasil = jumlah.toFixed(2);
            $("#total").val(total);
            $("#totalakhir").val(totalakhir);
            $("#totalcapaiankerja").val(totalcapaiankerja);
            //$("#jumlah").val(hasil);
            $(el.find('.jumlah')).val(hasil);
        }
    }
</script>
@endpush