<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;
    protected $table = 'tb_dokumen';
    protected $primaryKey = 'id_dokumen';
    protected $fillable = [
        'id_dokumen', 'nip', 'judul_dokumen', 'file_dokumen'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nip');
    }
}
