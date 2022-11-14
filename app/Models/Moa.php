<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Moa extends Model
{
    use HasFactory;
    protected $table = 'tbl_moa';
    protected $primaryKey = 'id';
    protected $fillable = ['kategori_moa','tingkat_moa','tanggal','lembaga_mitra','negara_id','provinsi_id','kota_kabupaten_id','kecamata_id','kelurahan_id','alamat','durasi','tanggal_akhir','dokumen1','dokumen2','dokumen3','kode_prodi','status'];
}
