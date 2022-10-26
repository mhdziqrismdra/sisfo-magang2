<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KotaKabupaten extends Model
{
    // use HasFactory;
    // protected $table = 'master_kota_kabupaten';
    // protected $primaryKey = 'master_kota_kabupaten_id';
    // protected $fillable = ['master_kota_kabupaten_id',  'master_provinsi_id',  'kota_kabupaten_kode', 'kota_kabupaten_nama'];

    // public function kecamatan()
    // {
    //     return $this->hasMany(Kecamatan::class);
    // }

    // public function provinsi()
    // {
    //     return $this->belongsTo(Provinsi::class);
    // }

    public function getKotaKabupatenByProvinsi($master_provinsi_id = "")
    {
        $query = DB::table("master_kota_kabupaten")
            ->where("master_provinsi_id", $master_provinsi_id)
            ->orderBy("kota_kabupaten_nama");
        return $query;
    }
}
