<div class="modal-content">
    <form action="{{ url($action) }}" enctype="multipart/form-data" method="post" id="myForm">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <div class="card-title">{{ $title }}</div>
                    </div>
                    <div class="ml-md-auto py-2 py-md-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                
                @if (isset($is_perpanjang))
                    <div class="card card-dark bg-info-gradient">
                        <div class="card-body bubble-shadow">
                            <h3><i class="fas fa-info"></i> Informasi</h3>
                            <p>Silahkan perbaharui data untuk perpanjangan MOU</p>
                        </div>
                    </div>
                @endif

                <div class="form-group">
                    <label for="tanggal_kerja_sama">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal_kerja_sama" name="tanggal_kerja_sama"
                        value="{{ $tanggal_kerja_sama }}" placeholder="Masukan Tanggal ...">
                </div>
                <div class="form-group">
                    <label for="nama_lembaga_mitra">Nama Lembaga Mitra</label>
                    <input type="text" class="form-control" id="nama_lembaga_mitra" name="nama_lembaga_mitra"
                        value="{{ $nama_lembaga_mitra }}" placeholder="Masukan Nama Lembaga Mitra ...">
                </div>
                <div class="form-group">
                    <label for="negara_id">Negara</label>
                    <select class="form-control" id="negara_id" name="negara_id">
                        <option value="">--Pilih Negara--</option>
                        @foreach ($negara_result as $item)
                            <option value="{{ $item->id }}" {{ $negara_id == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_negara }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="indonesia">
                    <div class="form-group">
                        <label for="provinsi_id">Provinsi</label>
                        <select class="form-control" id="provinsi_id" name="provinsi_id">
                            <option value="">--Pilih Provinsi--</option>
                            @foreach ($provinsi_result as $item)
                                <option value="{{ $item->master_provinsi_id }}"
                                    {{ $provinsi_id == $item->master_provinsi_id ? 'selected' : '' }}>
                                    {{ $item->province_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kota_kabupaten_id">Kota/Kabupaten</label>
                        <select class="form-control" id="kota_kabupaten_id" name="kota_kabupaten_id">
                            <option value="">--Pilih Kota/Kabupaten--</option>
                            @foreach ($kota_kabupaten_result as $item)
                                <option value="{{ $item->master_kota_kabupaten_id }}"
                                    {{ $kota_kabupaten_id == $item->master_kota_kabupaten_id ? 'selected' : '' }}>
                                    {{ $item->kota_kabupaten_nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kecamata_id">Kecamatan</label>
                        <select class="form-control" id="kecamata_id" name="kecamata_id">
                            <option value="">--Pilih Kecamatan--</option>
                            @foreach ($kecamatan_result as $item)
                                <option value="{{ $item->master_kecamatan_id }}"
                                    {{ $kecamata_id == $item->master_kecamatan_id ? 'selected' : '' }}>
                                    {{ $item->kecamatan_nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kelurahan_id">Kelurahan</label>
                        <select class="form-control" id="kelurahan_id" name="kelurahan_id">
                            <option value="">--Pilih Kelurahan--</option>
                            @foreach ($kelurahan_result as $item)
                                <option value="{{ $item->master_kelurahan_id }}"
                                    {{ $kelurahan_id == $item->master_kelurahan_id ? 'selected' : '' }}>
                                    {{ $item->kelurahan_nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="5"
                        placeholder="Masukan Alamat ..."><?= $alamat ?></textarea>
                </div>
                <div class="form-group">
                    <label for="durasi_kerja_sama">Durasi</label>
                    <input type="number" class="form-control" id="durasi_kerja_sama" name="durasi_kerja_sama"
                        value="{{ $durasi_kerja_sama }}" placeholder="Masukan Durasi ...">
                </div>
                <div class="form-group">
                    <label for="dokumen">Dokumen</label>
                    <input type="file" class="form-control" id="dokumen" name="dokumen"
                        placeholder="Masukan Tanggal ...">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="">--Pilih Status--</option>
                        <option value="1" {{ $status == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ $status == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
            </div>
            <div class="card-action">
                <input type="hidden" name="id" id="id" value="<?= $id ?>">
                <input type="hidden" name="id_parent" id="id_parent" value="<?= $id_parent ?>">
                <button class="btn btn-danger" type="button" class="close" data-dismiss="modal"
                    aria-label="Close"><i class="fas fa-times"></i> Cancel</button>
                <button class="btn btn-success pull-right" id="submit"><i class="far fa-save"></i> Submit</button>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        let negara_id = '{{ $negara_id }}';
        if (negara_id == '102') {
            $('#indonesia').show();
        } else {
            $('#indonesia').hide();
        }
    });

    $(function() {
        // fungsi untuk cek negara indonesia atau tidak
        $("#negara_id").change(function() {
            let negara_id = $("#negara_id").val();
            // let negara_id = "102";
            if (negara_id == "102") {
                // load provisi jika negara indonesia
                tampilProvinsi();
                $('#indonesia').show();
            }
            return;
        });

        // fungsi untuk load kabupaten by provinsi
        $("#provinsi_id").change(function() {
            let provinsi_id = $("#provinsi_id").val();
            tampilKotaKabupaten(provinsi_id);
        });

        // fungsi load kecamatan by kabupaten
        $("#kota_kabupaten_id").change(function() {
            let kota_kabupaten_id = $("#kota_kabupaten_id").val();
            tampilKecamatan(kota_kabupaten_id);
        });

        // fungsi load kelurahan by kecamatan
        $("#kecamata_id").change(function() {
            let kecamata_id = $("#kecamata_id").val();
            tampilKelurahan(kecamata_id);
        });

        // function for form submission
        $('form#myForm').on('submit', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            getCSRF();
            $.ajax({
                url: $(this).attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: true,
                type: "POST",
                dataType: "JSON",
                success: function(respon) {
                    setCSRF(respon.token);
                    if (respon.status) {
                        messegeSuccess(respon.message);
                        $('#myDatatables').DataTable().ajax.reload(null, false);
                        $('#modal_form').modal('hide');
                    } else {
                        messegeWarning(respon.message);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert("Code Status : " + xhr.status + "\nMessege Error :" +
                        thrownError);
                }
            });
        });
    });

    function tampilProvinsi() {
        $.ajax({
            type: "GET",
            url: "{{ url('mou/provinsi') }}",
            dataType: "JSON",
            success: function(response) {
                let html = ``;
                if (response.status) {
                    let i;
                    html += `<option value="">--Pilih Provinsi--</option>`;
                    for (i = 0; i < response.provinsi_result.length; i++) {
                        html +=
                            `<option value="${response.provinsi_result[i].master_provinsi_id}">${response.provinsi_result[i].province_name}</option>`;
                    }
                } else {
                    html = `<option value="">--Pilih Provinsi--</option>`;
                }
                $('#provinsi_id').html(html);
            }
        });
    }

    function tampilKotaKabupaten(provinsi_id) {
        $.ajax({
            type: "GET",
            url: "{{ url('mou/kabupaten') }}",
            data: {
                provinsi_id: provinsi_id
            },
            dataType: "JSON",
            success: function(response) {
                let html = ``;
                if (response.status) {
                    let i;
                    html += `<option value="">--Pilih Kota/Kabupaten--</option>`;
                    for (i = 0; i < response.kabupaten_result.length; i++) {
                        html +=
                            `<option value="${response.kabupaten_result[i].master_kota_kabupaten_id}">${response.kabupaten_result[i].kota_kabupaten_nama}</option>`;
                    }
                } else {
                    html = `<option value="">--Pilih Kota/Kabupaten--</option>`;
                }
                $('#kota_kabupaten_id').html(html);
            }
        });
    }

    function tampilKecamatan(kota_kabupaten_id) {
        $.ajax({
            type: "GET",
            url: "{{ url('mou/kecamatan') }}",
            data: {
                kota_kabupaten_id: kota_kabupaten_id
            },
            dataType: "JSON",
            success: function(response) {
                let html = ``;
                if (response.status) {
                    let i;
                    html += `<option value="">--Pilih Kecamatan--</option>`;
                    for (i = 0; i < response.kecamatan_result.length; i++) {
                        html +=
                            `<option value="${response.kecamatan_result[i].master_kecamatan_id}">${response.kecamatan_result[i].kecamatan_nama}</option>`;
                    }
                } else {
                    html = `<option value="">--Pilih Kecamatan--</option>`;
                }
                $('#kecamata_id').html(html);
            }
        });
    }

    function tampilKelurahan(kecamata_id) {
        $.ajax({
            type: "GET",
            url: "{{ url('mou/kelurahan') }}",
            data: {
                kecamata_id: kecamata_id
            },
            dataType: "JSON",
            success: function(response) {
                let html = ``;
                if (response.status) {
                    let i;
                    html += `<option value="">--Pilih Kelurahan--</option>`;
                    for (i = 0; i < response.kelurahan_result.length; i++) {
                        html +=
                            `<option value="${response.kelurahan_result[i].master_kelurahan_id}">${response.kelurahan_result[i].kelurahan_nama}</option>`;
                    }
                } else {
                    html = `<option value="">--Pilih Kelurahan--</option>`;
                }
                $('#kelurahan_id').html(html);
            }
        });
    }
</script>
