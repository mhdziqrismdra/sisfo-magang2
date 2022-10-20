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
                                <a href="{{ url('/dashboard') }}">
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
                        <button type="button" class="btn btn-primary btn-round ml-auto" onclick="btnTambah()">
                            <i class="fa fa-plus"></i>
                            Tambah Data
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{-- tabel MOU --}}
                        <table id="myDatatables" class="display table table-striped table-hover" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Negara</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten/Kota</th>
                                    <th>Kecamatan</th>
                                    <th>Kelurahan</th>
                                    <th>ALamat</th>
                                    <th>Durasi</th>
                                    <th>Akhir</th>
                                    <th>Dokumen</th>
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
    $(document).ready(function() {
        dataTables();
    });

    function btnTambah() {
            $.ajax({
                url: "{{ url('mou/create') }}",
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

        function dataTables() {
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
                    url: "{{ url('mou/list') }}",
                    type: "GET",
                    dataType: "JSON",
                },
                columns: [{
                        data: "id",
                        orderable: false,
                        searchable: false
                    }, {
                        data: 'no',
                        orderable: false,
                        searchable: false
                    }, {
                        data: "kelas_jenjang"
                    },
                    {
                        data: "tanggal_kerja_sama",
                    },
                    {
                        data: "nama_lembaga_mitra",
                    },
                    {
                        data: "negara_id",
                    },
                    {
                        data: "provinsi_id",
                    },
                    {
                        data: "kecamata_id",
                    },
                    {
                        data: "kelurahan_id",
                    },
                    {
                        data: "alamat",
                    },
                    {
                        data: "durasi_kerja_sama",
                    },
                    {
                        data: "status",
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
</script>
@endsection