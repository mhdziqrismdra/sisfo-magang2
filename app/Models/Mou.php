<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mou extends Model
{
    use HasFactory;
    protected $table = 'tbl_mou';
    protected $primaryKey = 'id';
    protected $fillable = ['id','tanggal_kerja_sama','nama_lembaga_mitra','negara_id','provinsi_id','kota_kabupaten_id','kecamata_id','kelurahan_id','alamat','durasi_kerja_sama','status'];
}
