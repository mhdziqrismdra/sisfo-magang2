<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;

class AkunController extends Controller
{

    //Menampilkan Seluruh Data Akun
    public function index()
    {
        $akun['data_akun'] = Pengguna::all();
        return view('akun.tabelAkun', $akun);
    }

    //Merubah Password Akun
    public function update(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            Pengguna::where(['id' => $id])->update([
                'password' => bcrypt($data['password'])
            ]);
            return redirect('/akun-pegawai')->with('success', 'Password berhasil diubah!');
        }
    }

    public function destroy($id)
    {
        Pengguna::destroy($id);
        return redirect('/akun-pegawai')->with('success', 'Penghapusan Akun Berhasil!');
    }
}
