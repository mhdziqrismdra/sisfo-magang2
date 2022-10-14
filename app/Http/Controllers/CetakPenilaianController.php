<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Penilaian;

use App\Http\Controllers\Controller;
use App\Exports\PenilaianExport;
use Maatwebsite\Excel\Facades\Excel;

class CetakPenilaianController extends Controller
{

    //Menampilkan Rekap Penilaian
    public function index()
    {
        $penilaian = Penilaian::with(['pegawai'])->get();
        return view('penilaian.rekap-penilaian', compact('penilaian'));
    }

    //Search berdasarkan periode penilaian
    public function search(Request $request)
    {
        // dd($request->all());
        $periode_awal = $request->periode_awal;
        $periode_akhir = $request->periode_akhir;

        // dd($periode_akhir);
        $data_nilai = Penilaian::with(['pegawai'])->whereBetween('periode_akhir', [$periode_awal, $periode_akhir])->get();
        return view('penilaian.laporanPenilaian', compact('data_nilai', 'periode_awal', 'periode_akhir'));
    }

    //Export data ke PDF
    public function pdfExport($periode_awal, $periode_akhir)
    {
        $penilaianPDF = Penilaian::with(['pegawai'])->whereBetween('periode_akhir', [$periode_awal, $periode_akhir])->get();
        return view('penilaian.cetakPDF', compact('penilaianPDF'));
    }

    public function exportExcel($periode_awal, $periode_akhir)
    {
        $data = Penilaian::with(['pegawai'])->whereBetween('periode_akhir', [$periode_awal, $periode_akhir])->get();
        return view('tes/export', compact('data'));
    }

    //Export data ke Excel
    public function penilaianexport($periode_awal, $periode_akhir)
    {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date("dmYhis");
        return Excel::download(new PenilaianExport($periode_awal, $periode_akhir), 'Penilaian Prestasi Kerja' . '-' . $tanggal . '.xlsx');
    }
}
