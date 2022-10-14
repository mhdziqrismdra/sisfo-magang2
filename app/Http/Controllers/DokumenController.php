<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class DokumenController extends Controller
{

    //Menampilkan data pegawai
    public function index()
    {
        $data['data_pegawai'] = Pegawai::all();
        return view('dokumen.beranda-dokumen', $data);
    }

    //Menampilkan form tambah dokumen
    public function create($nip)
    {
        $data['pegawai'] = Pegawai::find($nip);
        return view('dokumen.tambahDokumen', $data);
    }

    //Menyimpan data dokumen pegawai untuk level admin
    public function store(Request $request)
    {
        $this->validate($request, [
            'nip' => 'required',
            'nama_pegawai' => 'required',
            'judul_dokumen' => 'required',
            'file_dokumen' => 'required'
        ]);

        $file_dokumen = $request->file('file_dokumen');
        $ekstensi = $file_dokumen->getClientOriginalExtension();
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date("dmYhis");

        $nama_dokumen = $request->judul_dokumen . '-' . $tanggal . '.' . $ekstensi;

        Dokumen::create([
            'nip' => $request->nip,
            'judul_dokumen' => $request->judul_dokumen,
            'file_dokumen' => $nama_dokumen
        ]);

        $destinationPath = 'uploads/' . $request->nama_pegawai . '-' . $request->nip;
        $file_dokumen->move($destinationPath, $nama_dokumen);

        return redirect('/berkas-dokumen/file/' . $request->nip)->with('success', 'Dokumen Berhasil Diunggah!');
    }

    //Menyimpan data dokumen pegawai untuk level pegawai
    public function storePeg(Request $request)
    {
        $this->validate($request, [
            'nip' => 'required',
            'nama_pegawai' => 'required',
            'judul_dokumen' => 'required',
            'file_dokumen' => 'required'
        ]);

        $file_dokumen = $request->file('file_dokumen');
        $ekstensi = $file_dokumen->getClientOriginalExtension();
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date("dmYhis");

        $nama_dokumen = $request->judul_dokumen . '-' . $tanggal . '.' . $ekstensi;

        Dokumen::create([
            'nip' => $request->nip,
            'judul_dokumen' => $request->judul_dokumen,
            'file_dokumen' => $nama_dokumen
        ]);

        $destinationPath = 'uploads/' . $request->nama_pegawai . '-' . $request->nip;
        $file_dokumen->move($destinationPath, $nama_dokumen);

        return redirect('/pegawai/berkas-dokumen/file/' . $request->nip)->with('success', 'Dokumen Berhasil Diunggah!');
    }

    //Menampilkan dokumen-dokumen pegawai berdasarkan nip yang dipilih
    public function show($nip)
    {
        $peg = Pegawai::with(['dokumen'])->where('nip', $nip)->first();
        return view('dokumen.tabelDokumen', compact('peg'));
    }

    //Hapus dokumen level admin
    public function destroy($id_dokumen)
    {
        $dokumen = Dokumen::findorFail($id_dokumen);
        $nip = $dokumen->nip;
        $peg = Pegawai::findorFail($nip);

        //Hapus File Permanen
        $file = public_path() . '/uploads/' . $peg->nama_pegawai . '-' . $peg->nip . '/' . $dokumen->file_dokumen;
        unlink($file);
        Dokumen::destroy($id_dokumen);
        return redirect('/berkas-dokumen/berkas/' . $peg->nip)->with('success', 'Dokumen Berhasil Dihapus!');
    }

    //Hapus dokumen level pegawai
    public function destroyPeg($id_dokumen)
    {
        $dokumen = Dokumen::findorFail($id_dokumen);
        $nip = $dokumen->nip;
        $peg = Pegawai::findorFail($nip);

        //Hapus File Permanen
        $file = public_path() . '/uploads/' . $peg->nama_pegawai . '-' . $peg->nip . '/' . $dokumen->file_dokumen;
        unlink($file);
        Dokumen::destroy($id_dokumen);
        return redirect('/pegawai/berkas-dokumen/berkas/' . $peg->nip)->with('success', 'Dokumen Berhasil Dihapus!');
    }

    //Download dokumen
    public function download($id_dokumen)
    {
        $dokumen = Dokumen::findorFail($id_dokumen);
        $nip = $dokumen->nip;
        $peg = Pegawai::findorFail($nip);
        $file = public_path() . '/uploads/' . $peg->nama_pegawai . '-' . $peg->nip . '/' . $dokumen->file_dokumen;
        return response()->download($file, $dokumen->file_dokumen);
    }
}
