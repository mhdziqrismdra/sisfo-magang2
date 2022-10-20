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
            <div class="form-group">
                <label for="tanggal_kerja_sama">Tanggal</label>
                <input type="date" class="form-control" id="tanggal_kerja_sama" name="tanggal_kerja_sama"
                    placeholder="Masukan Tanggal ...">
            </div>
            <div class="form-group">
                <label for="nama_lembaga_mitra">Nama Lembaga Mitra</label>
                <input type="text" class="form-control" id="nama_lembaga_mitra" name="nama_lembaga_mitra"
                    placeholder="Masukan Nama Lembaga Mitra ...">
            </div>
            <div class="form-group">
                <label for="negara_id">Negara</label>
                <select class="form-control" id="negara_id" name="negara_id">
                    <option value="">--Pilih Negara--</option>
                    @foreach ($negara_result as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_negara }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="tanggal_kerja_sama">Tanggal</label>
                <input type="date" class="form-control" id="tanggal_kerja_sama" name="tanggal_kerja_sama"
                    placeholder="Masukan Tanggal ...">
            </div>
            <div class="form-group">
                <label for="tanggal_kerja_sama">Tanggal</label>
                <input type="date" class="form-control" id="tanggal_kerja_sama" name="tanggal_kerja_sama"
                    placeholder="Masukan Tanggal ...">
            </div>
            <div class="form-group">
                <label for="tanggal_kerja_sama">Tanggal</label>
                <input type="date" class="form-control" id="tanggal_kerja_sama" name="tanggal_kerja_sama"
                    placeholder="Masukan Tanggal ...">
            </div>
            <div class="form-group">
                <label for="tanggal_kerja_sama">Tanggal</label>
                <input type="date" class="form-control" id="tanggal_kerja_sama" name="tanggal_kerja_sama"
                    placeholder="Masukan Tanggal ...">
            </div>
            <div class="form-group">
                <label for="tanggal_kerja_sama">Tanggal</label>
                <input type="date" class="form-control" id="tanggal_kerja_sama" name="tanggal_kerja_sama"
                    placeholder="Masukan Tanggal ...">
            </div>
        </div>
        <div class="card-action">
            <button class="btn btn-danger" type="button" class="close" data-dismiss="modal"
                aria-label="Close">Cancel</button>
            <button class="btn btn-success pull-right">Submit</button>
        </div>
    </div>
</div>
