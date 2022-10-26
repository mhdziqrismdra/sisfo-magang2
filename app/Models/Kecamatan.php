<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kecamatan extends Model
{
    // use HasFactory;
    // protected $table = 'master_kecamatan';
    // protected $primaryKey = 'master_kecamatan_id';
    // protected $fillable = ['master_kecamatan_id',  'master_kota_kabupaten_id',  'kecamatan_kode', 'kecamatan_nama'];

    // public function kecamatan()
    // {
    //     return $this->hasMany(Kecamatan::class);
    // }

    // public function kotaKabupaten()
    // {
    //     return $this->belongsTo(KotaKabupaten::class);
    // }

    public function getKecamatanByKabupaten($master_kota_kabupaten_id= "")
    {
        $query = DB::table("master_kecamatan")
            ->where("master_kota_kabupaten_id", $master_kota_kabupaten_id)
            ->orderBy("kecamatan_nama");
        return $query;
    }
}
