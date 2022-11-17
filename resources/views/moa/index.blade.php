@extends('layout.master')
@section('tab-title', 'Memorandum of Understanding (MOU)')
@section('content')
    <div class="page-inner mt--5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Memorandum of Agreement (MOA)</h4>
                            <ul class="breadcrumbs">
                                <li class="nav-home">
                                    <a href="{{ url('/dashboard') }}">
                                        <i class="flaticon-home"></i>
                                    </a>
                                </li>
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    Memorandum of Agreement (MOA)
                                </li>
                            </ul>
                            <button type="button" class="btn btn-primary btn-round ml-auto" onclick="btnTambah()">
                                <i class="fa fa-plus"></i>
                                Tambah Data
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tahunKerjaSama">Tahun Kerja Sama</label>

                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="myDatatables" class="display table table-striped table-hover text-nowrap"
                                cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Action</th>
                                        <th>MOU</th>
                                        <th>Kategori</th>
                                        <th>Prodi</th>
                                        <th>Tingkat</th>
                                        <th>Tanggal</th>
                                        <th>Nama Lembaga</th>
                                        <th>Negara</th>
                                        <th>Provinsi</th>
                                        <th>Kabupaten/Kota</th>
                                        <th>Kecamatan</th>
                                        <th>Kelurahan</th>
                                        <th>ALamat</th>
                                        <th>Durasi</th>
                                        <th>Tanggal Akhir</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
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
@endpush

@section('script-js')
    <script>
        setInterval(function() {
            $(".berkedip").toggle();
        }, 300);

        $(document).ready(function() {
            dataTables();
        });

        $(function() {
            // fungsi untuk cek negara indonesia atau tidak
            $("#tahunKerjaSama").change(function() {
                let tahunKerjaSama = $("#tahunKerjaSama").val();
                if (tahunKerjaSama == "") {
                    messegeWarning("Pilih Tahun Kerja Sama");
                    $("#tahunKerjaSama").focus();
                    return false;
                }
                dataTables(tahunKerjaSama);
            });
        });

        function btnTambah() {
            $.ajax({
                url: "{{ url('moa/create') }}",
                type: "GET",
                dataType: "JSON",
                success: function(respon) {
                    if (respon.status) {
                        $('#view_modal_form').html(respon.view_modal_form);
                        $('#modal_form').modal('show');
                    } else {
                        alert("error");
                    }
                },
            });
        }

        function dataTables(tahunKerjaSama = "") {
            api_data_table();
            $("#myDatatables").DataTable({
                initComplete: function() {
                    var api = this.api();
                    $('#myDatatables_filter input')
                        .off(".DT")
                        .on("keyup.DT", function(e) {
                            if (e.keyCode == 13) {
                                api.search(this.value).draw();
                            }
                        });
                },
                oLanguage: {
                    sProcessing: '<i class="fas fa-circle-notch"></i><span>Loading...</span> '
                },
                dom: "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-6'i><'col-sm-6'p>>",
                bDestroy: true,
                processing: true,
                serverSide: true,
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                scrollX: true,
                lengthMenu: [
                    [10, 25, 50, 100, 200, -1],
                    [10, 25, 50, 100, 200, "All"]
                ],
                buttons: [{
                        extend: "copy",
                        exportOptions: {
                            columns: [1, 2, 3]
                        }
                    }, {
                        extend: "csv",
                        exportOptions: {
                            columns: [1, 2, 3]
                        }
                    },
                    {
                        extend: "excel",
                        exportOptions: {
                            columns: [1, 2, 3]
                        }
                    },
                    {
                        extend: "pdf",
                        exportOptions: {
                            columns: [1, 2, 3]
                        }
                    },
                    {
                        extend: "print",
                        exportOptions: {
                            columns: [1, 2, 3]
                        }
                    },
                    {
                        extend: "colvis",
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }
                ],
                ajax: {
                    url: "{{ url('moa/list') }}",
                    type: "GET",
                    dataType: "JSON",
                },
                columns: [{
                        data: "no",
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    }, {
                        data: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            let date_sekarang = new Date();
                            let tanggal_akhir = new Date(row['tanggal_akhir']);
                            let btnPerpanjang = ``;
                            if (tanggal_akhir < date_sekarang) {
                                btnPerpanjang = `<button type="button" onclick="btnPerpanjang('${data}')" title="Perpanjang" class="btn btn-success btn-sm">
                                                    <i class="fas fa-calendar-plus"></i>
                                                </button>`;
                            }
                            return `<div class="btn-group" role="group" aria-label="Basic example">
                                        ${btnPerpanjang}
                                        <button type="button" onclick="btnDetail('${data}')" title="Detail" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" onclick="btnEdit('${data}')" title="Edit" class="btn btn-warning btn-sm">
                                            <i class="far fa-edit"></i>
                                        </button>
                                        <button type="button" onclick="btnDelete('${data}')" title="Delete" class="btn btn-danger btn-sm">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </div>`;
                        }
                    }, {
                        data: "nama_lembaga_mitra",
                    }, {
                        data: "kategori_moa",
                    }, {
                        data: "nama_prodi",
                    }, {
                        data: "tingkat_moa",
                    }, {
                        data: "tanggal",
                    }, {
                        data: "lembaga_mitra",
                    }, {
                        data: "nama_negara",
                    },
                    {
                        data: "province_name",
                    },
                    {
                        data: "kota_kabupaten_nama",
                    },
                    {
                        data: "kecamatan_nama",
                    },
                    {
                        data: "kelurahan_nama",
                    },
                    {
                        data: "alamat",
                    },
                    {
                        data: "durasi",
                    },
                    {
                        data: "tanggal_akhir",
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return getFormattedDate(data);
                        }
                    }, {
                        data: "status",
                        searchable: false,
                        orderable: false,
                        render: function(data, type, row, meta) {
                            let date_sekarang = new Date();
                            let tanggal_akhir = new Date(row['tanggal_akhir']);
                            var taggal_6_bulan = addMonths(date_sekarang, 6)
                            let result = ``;
                            if (tanggal_akhir > date_sekarang && tanggal_akhir <
                                new Date(taggal_6_bulan)) {
                                result = "<div class='berkedip'>Akan Berakhir</div>";
                            } else if (tanggal_akhir < date_sekarang) {
                                result = "Berakhir";
                            } else {
                                result = "Aktif";
                            }
                            return result;
                        }
                    }
                ],
                order: [
                    [2, 'asc']
                ],
                rowCallback: function(row, data, iDisplayIndex) {
                    var info = this.fnPagingInfo();
                    var page = info.iPage;
                    var length = info.iLength;
                    var index = page * length + (iDisplayIndex + 1);
                    $('td:eq(0)', row).html(index);
                }
            });
        }

        function getFormattedDate(date) {
            var dt = new Date(date);
            var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            var mmddyyyy = dt.getDate() + ' ' + months[dt.getMonth()] + ' ' + dt.getFullYear();
            return mmddyyyy;
        }

        function addMonths(isoDate, numberMonths) {
            var dateObject = new Date(isoDate),
                day = dateObject.getDate(); // returns day of the month number

            // avoid date calculation errors
            dateObject.setHours(20);

            // add months and set date to last day of the correct month
            dateObject.setMonth(dateObject.getMonth() + numberMonths + 1, 0);

            // set day number to min of either the original one or last day of month
            dateObject.setDate(Math.min(day, dateObject.getDate()));

            return dateObject.toISOString().split('T')[0];
        };

        function btnPerpanjang(id) {
            swalLoading();
            getCSRF();
            $.ajax({
                url: "{{ url('moa/perpanjang') }}",
                data: {
                    moa_id: id,
                },
                type: "PUT",
                dataType: "JSON",
                success: function(respon) {
                    Swal.close();
                    setCSRF(respon.token);
                    if (respon.status) {
                        $('#view_modal_form').html(respon.view_modal_form);
                        $('#modal_form').modal('show');
                    } else {
                        alert("error");
                    }
                },
            });
        }

        function btnEdit(id) {
            swalLoading();
            getCSRF();
            $.ajax({
                url: "{{ url('moa/update') }}",
                data: {
                    moa_id: id,
                },
                type: "PUT",
                dataType: "JSON",
                success: function(respon) {
                    Swal.close();
                    setCSRF(respon.token);
                    if (respon.status) {
                        $('#view_modal_form').html(respon.view_modal_form);
                        $('#modal_form').modal('show');
                    } else {
                        alert("error");
                    }
                },
            });
        }

        function btnDetail(id) {
            swalLoading();
            getCSRF();
            $.ajax({
                url: "{{ url('moa/detail') }}",
                data: {
                    moa_id: id,
                },
                type: "PUT",
                dataType: "JSON",
                success: function(respon) {
                    Swal.close();
                    setCSRF(respon.token);
                    if (respon.status) {
                        $('#view_modal_form').html(respon.view_modal_form);
                        $('#modal_form').modal('show');
                    } else {
                        alert("error");
                    }
                },
            });
        }

        function btnDelete(params) {
            messegeWarning("Belum Dibuat");
        }

        function name(params) {
            let date_now = new Date();
            let date_warning = new Date(row['tgl_warning']);
            let date_actual = new Date(data);
        }
    </script>
@endsection
