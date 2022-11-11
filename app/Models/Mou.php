<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mou extends Model
{
    use HasFactory;
    protected $table = 'tbl_mou';
    protected $primaryKey = 'id';
    protected $fillable = ['tanggal_kerja_sama', 'nama_lembaga_mitra', 'periode','negara_id', 'provinsi_id', 'kota_kabupaten_id', 'kecamata_id', 'kelurahan_id', 'alamat', 'durasi_kerja_sama', 'tanggal_akhir_kerja_sama', 'status'];

    public function insertMOU($data = array())
    {
        DB::table('tbl_mou')->insert($data);
    }

    public function getMouById($id = "")
    {
        $query = DB::table('tbl_mou')
            ->join('master_negara', 'master_negara.id', '=', 'tbl_mou.negara_id')
            ->leftJoin('master_provinsi', 'master_provinsi.master_provinsi_id', '=', 'tbl_mou.provinsi_id')
            ->leftJoin('master_kota_kabupaten', 'master_kota_kabupaten.master_kota_kabupaten_id', '=', 'tbl_mou.kota_kabupaten_id')
            ->leftJoin('master_kecamatan', 'master_kecamatan.master_kecamatan_id', '=', 'tbl_mou.kecamata_id')
            ->leftJoin('master_kelurahan', 'master_kelurahan.master_kelurahan_id', '=', 'tbl_mou.kelurahan_id')
            ->where("tbl_mou.id", "=", $id);
        return $query;
    }

    // public function getMOU()
    // {
    //     $query = DB::table('tbl_mou')
    //         ->join('master_negara', 'master_negara.id', '=', 'tbl_mou.negara_id')
    //         ->leftJoin('master_provinsi', 'master_provinsi.master_provinsi_id', '=', 'tbl_mou.provinsi_id')
    //         ->leftJoin('master_kota_kabupaten', 'master_kota_kabupaten.master_kota_kabupaten_id', '=', 'tbl_mou.kota_kabupaten_id')
    //         ->leftJoin('master_kecamatan', 'master_kecamatan.master_kecamatan_id', '=', 'tbl_mou.kecamata_id')
    //         ->leftJoin('master_kelurahan', 'master_kelurahan.master_kelurahan_id', '=', 'tbl_mou.kecamata_id')
    //         ->select('tbl_mou.id', 'tbl_mou.id as no', 'tanggal_kerja_sama', 'nama_lembaga_mitra', 'master_negara.nama_negara', 'master_provinsi.province_name', 'master_kota_kabupaten.kota_kabupaten_nama', 'master_kecamatan.kecamatan_nama', 'master_kelurahan.kelurahan_nama', 'alamat', 'durasi_kerja_sama', 'status');
    //     return $query->addSelect(DB::raw('DATE_SUB(tbl_mou.tanggal_kerja_sama, INTERVAL 5 YEAR) as tanggal_akhir_kerja_sama'));
    // }
}
