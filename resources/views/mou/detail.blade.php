<div class="modal-content">

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
            <table class="table">
                <tr>
                    <th>Tanggal</th>
                    <td>:</td>
                    <td>{{ $mouRow->tanggal_kerja_sama }}</td>
                </tr>
                <tr>
                    <th>Nama Lembaga Mitra</th>
                    <td>:</td>
                    <td>{{ $mouRow->nama_lembaga_mitra }}</td>
                </tr>
                <tr>
                    <th>Negara</th>
                    <td>:</td>
                    <td>{{ $mouRow->nama_negara }}</td>
                </tr>
                @if ($mouRow->negara_id == 102)
                    <tr>
                        <th>Provinsi</th>
                        <td>:</td>
                        <td>{{ $mouRow->province_name }}</td>
                    </tr>
                    <tr>
                        <th>Kota/Kabupaten</th>
                        <td>:</td>
                        <td>{{ $mouRow->province_name }}</td>
                    </tr>
                    <tr>
                        <th>Kecamatan</th>
                        <td>:</td>
                        <td>{{ $mouRow->kecamatan_nama }}</td>
                    </tr>
                    <tr>
                        <th>Kelurahan</th>
                        <td>:</td>
                        <td>{{ $mouRow->kelurahan_nama }}</td>
                    </tr>
                @endif
                <tr>
                    <th>Alamat</th>
                    <td>:</td>
                    <td>{{ $mouRow->alamat }}</td>
                </tr>
                <tr>
                    <th>Durasi</th>
                    <td>:</td>
                    <td>{{ $mouRow->durasi_kerja_sama }}</td>
                </tr>
                <tr>
                    <th>Tanggal Akhir Kerja Sama</th>
                    <td>:</td>
                    <td>{{ $mouRow->tanggal_akhir_kerja_sama }}</td>
                </tr>
                <tr>
                    <th>Dokumen</th>
                    <td>:</td>
                    <td>{{ $mouRow->dokumen }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>:</td>
                    <td>{{ $tanggal_6_bulan }}</td>
                </tr>
                @php
                    $total = 5 + 6;
                @endphp

                {{ $total }}

            </table>
            <div class="card-action">
                <input type="hidden" name="id" id="id" value="{{ $mouRow->id }}">
                <button class="btn btn-danger" type="button" class="close" data-dismiss="modal" aria-label="Close"><i
                        class="fas fa-times"></i> Cancel</button>
            </div>
        </div>
    </div>
</div>
