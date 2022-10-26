<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Provinsi extends Model
{
    use HasFactory;
    protected $table = 'master_provinsi';
    protected $primaryKey = 'master_provinsi_id';
    protected $fillable = ['master_provinsi_id', 'province_kode', 'province_name'];

    public function kotaKabupaten()
    {
        return $this->hasMany(KotaKabupaten::class);
    }

    

}
