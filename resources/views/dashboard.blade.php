@extends('layout.master')
@section('tab-title', 'Dashboard')
@section('title', 'Data Pegawai')
@section('content')
<div class="page-inner mt--5 animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title">Dashboard</h4>
                        <ul class="breadcrumbs">
							<li class="nav-home">
								<a href="#">
									<i class="flaticon-home"></i>
								</a>
							</li>
						</ul>
                    </div>
                </div>
                <div class="card-body">
                    <h2>Selamat Datang, Sdr. {{auth()->user()->name}}</h2>
                <p class="lead" align="justify">Sistem Informasi Penilaian Prestasi Kerja dan Dokumen Pegawai merupakan sebuah sistem yang dibangun untuk memenuhi persyaratan
                  dalam mata kuliah <b>Kuliah Praktek</b>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('page-script')
@include('sweetalert::alert')
@endpush