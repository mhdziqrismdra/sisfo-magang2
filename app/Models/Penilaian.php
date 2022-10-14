<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;
    protected $table = 'tb_penilaian';
    protected $primaryKey = 'id_penilaian';
    public $timestamps = false;
    protected $fillable = [
        'id_penilaian', 'nip', 'atasan_langsung', 'atasan_pejabat_penilai', 'periode_awal', 'periode_akhir', 'capaian_kerja',
        'orientasi_pelayanan', 'integritas', 'komitmen', 'disiplin', 'kerjasama', 'kepemimpinan', 'jumlah'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nip');
    }
}
