<?php

namespace App\Http\Controllers;

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
        $sqlBuilder = Track::select([
            'TrackId',
            'Track.Name',
            'Title as Album',
            'MediaType.Name as MediaType',
            'UnitPrice',
            'Milliseconds',
            'Bytes',
        ])
            ->join('Album', 'Album.AlbumId', 'Track.AlbumId')
            ->join('MediaType', 'MediaType.MediaTypeId', 'Track.MediaTypeId');

        $dt = new Datatables(new LaravelAdapter);
        $dt->query($sqlBuilder);

        return $dt->generate();
    }

    public function create()
    {
        $data['title'] = "Tambah MOU";

        $respon['status'] = true;
        $respon['action'] = 'create';
        $respon['view_modal_form'] = view('mou.form', $data)->render();
        echo json_encode($respon);
    }
}
