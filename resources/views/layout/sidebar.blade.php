<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{asset('assets/img/profile.jpg')}}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <p>{{Auth::user()}}</p>
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            @if (Str::length(Auth::guard('pengguna')->user()) > 0)
                                {{auth()->user()->name}}
                                <span class="user-level">{{auth()->user()->level}}</span>

                            @elseif (Str::length(Auth::guard('user')->user()) > 0)
                                {{auth()->user()->name}}
                                <span class="user-level">{{auth()->user()->level}}</span>
                            @endif
                            <span class="caret"></span>
                        </span>
                    </a>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item {{request()->is('dashboard')? 'active' : ''}}">
                    <a href="{{url('dashboard')}}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @if (Str::length(Auth::guard('user')->user()) > 0)
                @if (auth()->user()->level == "Admin")  
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu Admin</h4>
                </li>
                <li class="nav-item {{request()->is('akun-pegawai')? 'active' : ''}}"> 
                    <a href="{{url('akun-pegawai')}}">
                        <i class="fas fa-address-card"></i>
                        <p>Akun Pegawai</p>
                    </a>
                </li>
                @endif
                @endif
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu Utama</h4>
                </li>
                <li class="nav-item">
                    <a href="{{url('mou')}}">
                        <i class="far fa-file"></i>
                        <p>Memorandum of Understanding (MOU)</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('moa')}}">
                        <i class="far fa-file"></i>
                        <p>Memorandum of Agreement (MOA)</p>
                    </a>
                </li>
                @if (Str::length(Auth::guard('user')->user()) > 0)
                @if (auth()->user()->level == "Admin")  
                <li class="nav-item {{request()->is('data-pegawai')? 'active' : ''}}"> 
                    <a href="{{url('data-pegawai')}}">
                        <i class="far fa-user"></i>
                        <p>Data Pegawai</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('berkas-dokumen')}}">
                        <i class="far fa-file"></i>
                        <p>Berkas dan Dokumen</p>
                    </a>
                </li>
                <li class="nav-item {{request()->is('penilaian-prestasi-kerja')? 'active' : ''}}{{request()->is('penilaian-prestasi-kerja/cetak')? 'active' : ''}}">
                    <a data-toggle="collapse" href="#forms">
                        <i class="fas fa-pencil-ruler"></i>
                        <p>Penilaian Prestasi Kerja</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{url('penilaian-prestasi-kerja')}}">
                                    <span class="sub-item">Penilaian Pegawai</span>
                                </a>
                                <a href="{{url('penilaian-prestasi-kerja/rekap-penilaian')}}">
                                    <span class="sub-item">Rekap Penilaian</span>
                                </a>
                                <a href="{{url('penilaian-prestasi-kerja/export/pdf')}}">
                                    <span class="sub-item">Cetak Penilaian</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
                @endif

                @if (Str::length(Auth::guard('pengguna')->user()) > 0)
                @if (auth()->user()->level == "Pegawai")  
                <li class="nav-item">
                    <a href="{{url('pegawai/berkas-dokumen/file/' . auth()->user()->nip)}}">
                        <i class="fas fa-file-upload"></i>
                        <p>Unggah Berkas dan Dokumen</p>
                    </a>
                    <a href="{{url('pegawai/berkas-dokumen/berkas/' . auth()->user()->nip)}}">
                        <i class="far fa-file"></i>
                        <p>Histori Berkas dan Dokumen</p>
                    </a>
                </li>
                <li class="nav-item {{request()->is('penilaian-prestasi-kerja/rekapitulasi/')? 'active' : ''}}"> 
                    <a href="{{url('pegawai/penilaian-prestasi-kerja/rekapitulasi/' . auth()->user()->nip)}}">
                        <i class="fas fa-pencil-ruler"></i>
                        <p>Penilaian Prestasi Kerja</p>
                    </a>
                </li>
                @endif
                @endif
                {{-- <li class="nav-item">
                    <a href="{{url('logout')}}">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li> --}}
            </ul>
        </div>
    </div>
</div>