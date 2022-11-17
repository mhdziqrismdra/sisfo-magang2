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
    protected $fillable = ['mou_id', 'kategori_moa', 'tingkat_moa', 'tanggal', 'lembaga_mitra', 'negara_id', 'provinsi_id', 'kota_kabupaten_id', 'kecamata_id', 'kelurahan_id', 'alamat', 'durasi', 'tanggal_akhir', 'dokumen1', 'dokumen2', 'dokumen3', 'kode_prodi', 'status'];

    public function getMoaById($id = "")
    {
        $query = DB::table('tbl_moa')
            ->leftJoin('tbl_mou', 'tbl_mou.id', 'tbl_moa.mou_id')
            ->leftJoin('tb_prodi', 'tb_prodi.kode_prodi', 'tbl_moa.kode_prodi')
            ->leftJoin('master_negara', 'master_negara.id', 'tbl_moa.negara_id')
            ->leftJoin('master_provinsi', 'master_provinsi.master_provinsi_id', 'tbl_moa.provinsi_id')
            ->leftJoin('master_kota_kabupaten', 'master_kota_kabupaten.master_kota_kabupaten_id', 'tbl_moa.kota_kabupaten_id')
            ->leftJoin('master_kecamatan', 'master_kecamatan.master_kecamatan_id', 'tbl_moa.kecamata_id')
            ->leftJoin('master_kelurahan', 'master_kelurahan.master_kelurahan_id', 'tbl_moa.kelurahan_id')
            ->where("tbl_moa.id", "=", $id);
        return $query;
    }
}
