<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{

    //Menampilkan data pegawai
    public function index()
    {
        $data['data_pegawai'] = Pegawai::all();
        return view('pegawai.data-pegawai', $data);
    }

    //Menyimpan data pegawai
    public function store(Request $request)
    {
        $this->validate($request, [
            'nip' => 'required',
            'nama_pegawai' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jabatan' => 'required',
            'golongan' => 'required',
            'alamat' => 'required'
        ]);

        $check = Pegawai::where([
            ['nip', $request->nip]
        ])->exists();
        if ($check) {
            return redirect('/data-pegawai')->with('warning', 'Gagal, NIP Telah Terdaftar!');
        } else {
            Pegawai::create([
                'nip' => $request->nip,
                'nama_pegawai' => $request->nama_pegawai,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'golongan' => $request->golongan,
                'jabatan' => $request->jabatan,
                'alamat' => $request->alamat
            ]);

            // mkdir($request->nip . '-' . $request->nama_pegawai);
            $folder = 'uploads/' . $request->nama_pegawai . '-' . $request->nip;
            mkdir($folder);
            return redirect('/data-pegawai')->with('success', 'Penambahan Data Berhasil!');
        }
    }


    //Menampilkan detail data pegawai berdasarkan nip
    public function show($nip)
    {
        $detail_pegawai = Pegawai::find($nip);
        return view('pegawai.detailDataPegawai', compact('detail_pegawai'));
    }

    //Melakukan update data pegawai
    public function update(Request $request, $nip = null)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            Pegawai::where(['nip' => $nip])->update([
                'nama_pegawai' => $data['nama_pegawai'], 'jenis_kelamin' => $data['jenis_kelamin'],
                'golongan' => $data['golongan'], 'jabatan' => $data['jabatan'], 'alamat' => $data['alamat']
            ]);
            return redirect('/data-pegawai')->with('success', 'Pengeditan Data Berhasil!');
        }
    }

    //Menghapus data pegawai
    public function destroy($nip)
    {
        $peg = Pegawai::findOrFail($nip);
        $folder = public_path() . '/uploads/' . $peg->nama_pegawai . '-' . $peg->nip;

        //Hapus file dan folder permanen
        $files    = glob($folder . '/*');
        foreach ($files as $file) {
            if (is_file($file))
                unlink($file); // hapus file
        }
        rmdir("$folder");

        Pegawai::destroy($nip);
        return redirect('/data-pegawai')->with('success', 'Penghapusan Data Berhasil!');
    }
}
