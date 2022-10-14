<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Penilaian;

class PenilaianController extends Controller
{

    //Menampilkan data pegawai
    public function index()
    {
        $data['data_pegawai'] = Pegawai::all();
        return view('penilaian.beranda-penilaian', $data);
    }

    //Menyimpan data penilaian prestasi kerja
    public function store(Request $request)
    {
        $this->validate($request, [
            'nip' => 'required',
            'periode_awal' => 'required',
            'periode_akhir' => 'required',
            'capaian_kerja' => 'required',
            'orientasi_pelayanan' => 'required',
            'integritas' => 'required',
            'komitmen' => 'required',
            'disiplin' => 'required',
            'kerjasama' => 'required',
            'kepemimpinan' => 'required',
            'jumlah' => 'required'
        ]);

        //Seleksi periode telah ada atau belum
        $check = Penilaian::where([
            ['periode_awal', $request->periode_awal],
            ['nip', $request->nip],
        ])->exists();
        if ($check) {
            return redirect('/penilaian-prestasi-kerja/')->with('warning', 'Gagal, Periode Telah Ada!');
        } else {
            Penilaian::create([
                'nip' => $request->nip,
                'atasan_langsung' => $request->atasan_langsung,
                'atasan_pejabat_penilai' => $request->atasan_pejabat_penilai,
                'periode_awal' => $request->periode_awal,
                'periode_akhir' => $request->periode_akhir,
                'capaian_kerja' => $request->capaian_kerja,
                'orientasi_pelayanan' => $request->orientasi_pelayanan,
                'integritas' => $request->integritas,
                'komitmen' => $request->komitmen,
                'disiplin' => $request->disiplin,
                'kerjasama' => $request->kerjasama,
                'kepemimpinan' => $request->kepemimpinan,
                'jumlah' => $request->jumlah
            ]);

            return redirect('/penilaian-prestasi-kerja/rekapitulasi/' . $request->nip . '/search?periode=' . $request->periode_awal)->with('success', 'Penilaian Berhasil!');
        }
    }

    //Menampilkan data yang berelasi antara tabel pegawai dengan penilaian
    public function show($nip)
    {
        $peg = Pegawai::with(['penilaian'])->where('nip', $nip)->first();
        return view('penilaian.rekapitulasi', compact('peg'));
    }

    //Searching pegawai berdasarkan nip
    public function search(Request $request, $nip)
    {
        $periode = $request->get('periode');
        $peg = Pegawai::where('nip', $nip)->first();
        $data_penilaian = $peg->penilaian()->where('periode_awal', $periode)->get();
        return view('penilaian.rekapitulasi', compact('peg', 'data_penilaian'));
    }

    //Menghapus data penilaian
    public function destroy($id_penilaian)
    {
        Penilaian::destroy($id_penilaian);
        return redirect('/penilaian-prestasi-kerja')->with('success', 'Penghapusan Data Penilaian Berhasil!');
    }
}
