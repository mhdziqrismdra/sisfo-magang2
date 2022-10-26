<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kelurahan extends Model
{
    public function getkelurahanByKecamatan($master_kecamatan_id= "")
    {
        $query = DB::table("master_kelurahan")
            ->where("master_kecamatan_id", $master_kecamatan_id)
            ->orderBy("kelurahan_nama");
        return $query;
    }
}
