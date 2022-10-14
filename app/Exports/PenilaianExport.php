<?php

namespace App\Exports;

use App\Models\Penilaian;
use App\Models\Pegawai;
use GuzzleHttp\Psr7\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class PenilaianExport implements FromCollection
{

    protected $periode_awal;
    protected $periode_akhir;

    function __construct($periode_awal, $periode_akhir)
    {
        $this->periode_awal = $periode_awal;
        $this->periode_akhir = $periode_akhir;
    }

    public function collection()
    {
        return Penilaian::all();
    }
}
