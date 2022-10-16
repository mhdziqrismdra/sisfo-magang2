<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function getEmail()
    {

        return view('auth.forgotPassword');
    }

    public function postEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(60);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::send('auth.verifyPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->from('kokochi055@gmail.com');
            $message->subject('Reset Password Notification');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }
    
    //Auth login berdasarkan akun di tabel pengguna atau users
    public function login(Request $request)
    {
        // dd($request->all());
        if (Auth::guard('pengguna')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('dashboard')->with('success', 'Login Berhasil!');
        } elseif (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('dashboard')->with('success', 'Login Berhasil!');
        }
        return redirect('login')->with('warning', 'Gagal, Email atau password salah!');
    }

    //Auth logout berdasarkan akun di tabel pengguna atau users
    public function logout()
    {
        // dd($request->all());
        if (Auth::guard('pengguna')->check()) {
            Auth::guard('pengguna')->logout();
        } elseif (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
        }
        Auth::logout();
        return redirect('/')->with('success', 'Anda telah telah logout!');
    }

    //Menyimpan data registrasi akun
    public function simpanregistrasi(Request $request)
    {

        $validation = $request->validate([
            'name' => 'required',
            'nip' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        //Validasi Nip Terdaftar / Tidak di Database
        $nipTerdaftar = Pegawai::where([
            ['nip', $request->nip]
        ])->exists();
        if (!$nipTerdaftar) {
            return redirect('/')->with('warning', 'NIP ini tidak terdaftar');
        } else {
            $checknip = Pengguna::where([
                ['nip', $request->nip]
            ])->exists();
            $checkemail_user = Pengguna::where([
                ['email', $request->email]
            ])->exists();
            $checkemail_pengguna = User::where([
                ['email', $request->email]
            ])->exists();
            //Validasi akun dengan nip yang telah teregistrasi
            if ($checknip) {
                return redirect('/')->with('warning', 'NIP ini telah melakukan registrasi!');
            } elseif ($checkemail_user || $checkemail_pengguna) { //Validasi akun dengan email yang telah teregistrasi
                return redirect('/')->with('warning', 'Email ini telah melakukan registrasi!');
            } else {
                Pengguna::create([
                    'name' => $request->name,
                    'nip' => $request->nip,
                    'email' => $request->email,
                    'level' => 'Pegawai',
                    'password' => bcrypt($request->password),
                    'remember_token' => Str::random(60),
                ]);
                return redirect('/')->with('success', 'Registrasi Akun Berhasil!');
            }
        }
    }
}
