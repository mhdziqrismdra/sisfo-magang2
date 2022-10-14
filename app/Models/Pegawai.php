<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $table = 'tb_pegawai';
    public $timestamps = false;
    protected $primaryKey = 'nip';

    protected $fillable = ['nip', 'nama_pegawai', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'jabatan', 'golongan', 'alamat'];

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'nip', 'nip');
    }
    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'nip', 'nip');
    }
    public function pengguna()
    {
        return $this->hasOne(Pengguna::class, 'nip', 'nip');
    }
}
