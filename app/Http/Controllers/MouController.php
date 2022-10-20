<?php

namespace App\Http\Controllers;

use App\Models\Mou;
use App\Models\Negara;
use Illuminate\Http\Request;
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\LaravelAdapter;

class MouController extends Controller
{
    public function index()
    {
        return view('mou.index');
    }

    public function list()
    {
        $sqlBuilder = Mou::select(['id','id as no', 'tanggal_kerja_sama', 'nama_lembaga_mitra', 'negara_id', 'provinsi_id', 'kota_kabupaten_id', 'kecamata_id', 'kelurahan_id', 'alamat', 'durasi_kerja_sama', 'status']);
            // ->join('Album', 'Album.AlbumId', 'Track.AlbumId')
            // ->join('MediaType', 'MediaType.MediaTypeId', 'Track.MediaTypeId');

        $dt = new Datatables(new LaravelAdapter);
        $dt->query($sqlBuilder);

        return $dt->generate();
    }

    public function create()
    {
        $data['title'] = "Tambah MOU";
        $data['negara_result']= Negara::all();

        $respon['status'] = true;
        $respon['action'] = 'create';
        $respon['view_modal_form'] = view('mou.form', $data)->render();
        echo json_encode($respon);
    }
}
