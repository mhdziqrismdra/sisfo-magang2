<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\KotaKabupaten;
use App\Models\Mou;
use App\Models\Negara;
use App\Models\Provinsi;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\LaravelAdapter;

class MoaController extends Controller
{
    public function index()
    {
        $data['tahunKerjaSama'] = Mou::selectRaw('YEAR(tanggal_kerja_sama) as tahun')->orderBy('tanggal_kerja_sama')->get();
        return view('moa.index', $data);
    }

    public function list(Request $request)
    {
        $tahuKerjaSama = $request->tahuKerjaSama;
        $dateMinus5Year = date('Y-m-d', strtotime(date('Y-m-d') . ' - 5 years')); // tanggal kurang dari 5 tahun sekarang
        $datePlus5Year = date('Y-m-d', strtotime(date('Y-m-d') . ' + 5 years')); // tanggal lebih dari 5 tahun sekarang
        $sqlBuilder = Mou::select(['tbl_mou.id as no', 'tbl_mou.id', 'tanggal_kerja_sama', 'nama_lembaga_mitra', 'periode', 'master_negara.nama_negara', 'master_provinsi.province_name', 'master_kota_kabupaten.kota_kabupaten_nama', 'master_kecamatan.kecamatan_nama', 'master_kelurahan.kelurahan_nama', 'alamat', 'durasi_kerja_sama', 'tanggal_akhir_kerja_sama', 'status'])
            ->join('master_negara', 'master_negara.id', 'tbl_mou.negara_id')
            ->leftJoin('master_provinsi', 'master_provinsi.master_provinsi_id', 'tbl_mou.provinsi_id')
            ->leftJoin('master_kota_kabupaten', 'master_kota_kabupaten.master_kota_kabupaten_id', 'tbl_mou.kota_kabupaten_id')
            ->leftJoin('master_kecamatan', 'master_kecamatan.master_kecamatan_id', 'tbl_mou.kecamata_id')
            ->leftJoin('master_kelurahan', 'master_kelurahan.master_kelurahan_id', 'tbl_mou.kelurahan_id');

        if ($tahuKerjaSama != "") {
            if ($tahuKerjaSama == ">5") {
                $sqlBuilder->whereDate('tanggal_kerja_sama', '>', $datePlus5Year);
            } else {
                $sqlBuilder->whereYear('tanggal_kerja_sama', '=', $tahuKerjaSama);
            }
        } else {
            $sqlBuilder->whereDate('tanggal_kerja_sama', '>', $dateMinus5Year);
        }
        // ->where('status', '=', '1');


        $oMou = new Mou();
        $dt = new Datatables(new LaravelAdapter);
        $dt->query($sqlBuilder);

        return $dt->generate();
    }

    public function create()
    {
        $oKotaKabupaten = new KotaKabupaten();
        $oKecamatan = new Kecamatan();
        $oKelurahan = new Kelurahan();

        $data['title'] = "Tambah MOU";
        $data['action'] = 'mou/create/action';
        $data['id'] = "";
        $data['periode'] = "";
        $data['tanggal_kerja_sama'] = "";
        $data['nama_lembaga_mitra'] = "";
        $data['negara_id'] = "";
        $data['provinsi_id'] = "";
        $data['kota_kabupaten_id'] = "";
        $data['kecamata_id'] = "";
        $data['kelurahan_id'] = "";
        $data['alamat'] = "";
        $data['durasi_kerja_sama'] = "";
        $data['status'] = "";
        $data['negara_result'] = Negara::all();
        $data['provinsi_result'] = Provinsi::orderBy('province_name')->get();
        $data['kota_kabupaten_result'] = $oKotaKabupaten->getKotaKabupatenByProvinsi()->get();
        $data['kecamatan_result'] = $oKecamatan->getKecamatanByKabupaten()->get();
        $data['kelurahan_result'] = $oKelurahan->getkelurahanByKecamatan()->get();

        $respon['status'] = true;

        $respon['view_modal_form'] = view('mou.form', $data)->render();
        return response()->json($respon);
    }

    public function createAction(Request $request)
    {
        $oMou = new Mou();
        // if country id 102 is indonesia
        if ($request->negara_id == '102') {
            $validator = Validator::make($request->all(), [
                'tanggal_kerja_sama'     => 'required',
                'nama_lembaga_mitra'   => 'required',
                'negara_id'   => 'required',
                'provinsi_id'   => 'required',
                'kota_kabupaten_id' => 'required',
                'kecamata_id'   => 'required',
                'kelurahan_id'   => 'required',
                'alamat'   => 'required',
                'durasi_kerja_sama'   => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'tanggal_kerja_sama'     => 'required',
                'nama_lembaga_mitra'   => 'required',
                'negara_id'   => 'required',
                'alamat'   => 'required',
                'durasi_kerja_sama'   => 'required',
            ]);
        }


        // check validation
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'token' => csrf_token(),
                    'message' => $validator->errors()->all()
                ]
            );
        }

        // check uploaded files
        if ($request->file('dokumen')) {

            $file = $request->file('dokumen');
            $extension = $file->getClientOriginalExtension();
            $filename = "Doc_MOU_" . time().".".$extension;            
            $location = 'uploads/mou/';
            // Upload file
            $file->move($location, $filename);
            $dataInsert['dokumen'] = $filename;
        }

        // if validation success
        if ($request->negara_id == '102') {
            $dataInsert['provinsi_id'] = $request->provinsi_id;
            $dataInsert['kota_kabupaten_id'] = $request->kota_kabupaten_id;
            $dataInsert['kecamata_id'] = $request->kecamata_id;
            $dataInsert['kelurahan_id'] = $request->kelurahan_id;
        }
        $dataInsert['periode'] = 1;
        $dataInsert['tanggal_kerja_sama'] = $request->tanggal_kerja_sama;
        $dataInsert['nama_lembaga_mitra'] = $request->nama_lembaga_mitra;
        $dataInsert['negara_id'] = $request->negara_id;
        $dataInsert['alamat'] = $request->alamat;
        $dataInsert['durasi_kerja_sama'] = $request->durasi_kerja_sama;
        $dataInsert['tanggal_akhir_kerja_sama'] = date('Y-m-d', strtotime($request->tanggal_kerja_sama . ' + ' . $request->durasi_kerja_sama . ' years'));
        $dataInsert['status'] = 1;

        $dataGet = Mou::create($dataInsert);

        $respon['status'] = true;
        $respon['token'] = csrf_token();
        $respon['message'] = "Berhasil menyimpan data MOU";

        return response()->json($respon);
    }

    public function update(Request $request)
    {
        $oKotaKabupaten = new KotaKabupaten();
        $oKecamatan = new Kecamatan();
        $oKelurahan = new Kelurahan();

        $id = $request->mou_id;
        $mowRow = Mou::where('id', $id)->first();

        $data['title'] = "Update MOU";
        $data['action'] = 'mou/update/action';
        $data['id'] = $id;
        $data['periode'] = $mowRow->periode;
        $data['tanggal_kerja_sama'] = $mowRow->tanggal_kerja_sama;
        $data['nama_lembaga_mitra'] = $mowRow->nama_lembaga_mitra;
        $data['negara_id'] = $mowRow->negara_id;
        $data['provinsi_id'] = $mowRow->provinsi_id;
        $data['kota_kabupaten_id'] = $mowRow->kota_kabupaten_id;
        $data['kecamata_id'] = $mowRow->kecamata_id;
        $data['kelurahan_id'] = $mowRow->kelurahan_id;
        $data['alamat'] = $mowRow->alamat;
        $data['durasi_kerja_sama'] = $mowRow->durasi_kerja_sama;
        $data['status'] = $mowRow->status;
        $data['negara_result'] = Negara::all();
        $data['provinsi_result'] = Provinsi::orderBy('province_name')->get();
        $data['kota_kabupaten_result'] = $oKotaKabupaten->getKotaKabupatenByProvinsi($mowRow->provinsi_id)->get();
        $data['kecamatan_result'] = $oKecamatan->getKecamatanByKabupaten($mowRow->kota_kabupaten_id)->get();
        $data['kelurahan_result'] = $oKelurahan->getkelurahanByKecamatan($mowRow->kecamata_id)->get();


        $respon['status'] = true;
        $respon['token'] = csrf_token();
        $respon['view_modal_form'] = view('mou.form', $data)->render();
        return response()->json($respon);
    }

    public function updateAction(Request $request)
    {
        $oMou = new Mou();
        // if country id 102 is indonesia
        if ($request->negara_id == '102') {
            $validator = Validator::make($request->all(), [
                'tanggal_kerja_sama'     => 'required',
                'nama_lembaga_mitra'   => 'required',
                'negara_id'   => 'required',
                'provinsi_id'   => 'required',
                'kota_kabupaten_id' => 'required',
                'kecamata_id'   => 'required',
                'kelurahan_id'   => 'required',
                'alamat'   => 'required',
                'durasi_kerja_sama'   => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'tanggal_kerja_sama'     => 'required',
                'nama_lembaga_mitra'   => 'required',
                'negara_id'   => 'required',
                'alamat'   => 'required',
                'durasi_kerja_sama'   => 'required',
            ]);
        }


        // check validation
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'token' => csrf_token(),
                    'message' => $validator->errors()->all(),
                ]
            );
        }

        // check uploaded files
        if ($request->file('dokumen')) {

            $file = $request->file('dokumen');
            $extension = $file->getClientOriginalExtension();
            $filename = "Doc_MOU_" . time().".".$extension;            
            $location = 'uploads/mou/';
            // Upload file
            $file->move($location, $filename);
            $dataUpdate['dokumen'] = $filename;
        }

        // if validation success
        if ($request->negara_id == '102') {
            $dataUpdate['provinsi_id'] = $request->provinsi_id;
            $dataUpdate['kota_kabupaten_id'] = $request->kota_kabupaten_id;
            $dataUpdate['kecamata_id'] = $request->kecamata_id;
            $dataUpdate['kelurahan_id'] = $request->kelurahan_id;
        }
        $dataUpdate['tanggal_kerja_sama'] = $request->tanggal_kerja_sama;
        $dataUpdate['nama_lembaga_mitra'] = $request->nama_lembaga_mitra;
        $dataUpdate['negara_id'] = $request->negara_id;
        $dataUpdate['alamat'] = $request->alamat;
        $dataUpdate['durasi_kerja_sama'] = $request->durasi_kerja_sama;
        $dataUpdate['tanggal_akhir_kerja_sama'] = date('Y-m-d', strtotime($request->tanggal_kerja_sama . ' + ' . $request->durasi_kerja_sama . ' years'));
        $dataUpdate['status'] = $request->status;

        Mou::where(['id' => $request->id])->update($dataUpdate);

        $respon['status'] = true;
        $respon['token'] = csrf_token();
        $respon['message'] = "Berhasil update data MOU";

        return response()->json($respon);
    }

    public function perpanjang(Request $request)
    {
        $oKotaKabupaten = new KotaKabupaten();
        $oKecamatan = new Kecamatan();
        $oKelurahan = new Kelurahan();

        $id = $request->mou_id;
        $mowRow = Mou::where('id', $id)->first();

        $data['title'] = "Perpanjang MOU";
        $data['action'] = 'mou/perpanjang/action';
        $data['is_perpanjang'] = true; // untuk menandakan ini form perpanjang
        $data['id'] = $id;
        $data['periode'] = $mowRow->periode;
        $data['tanggal_kerja_sama'] = "";
        $data['nama_lembaga_mitra'] = $mowRow->nama_lembaga_mitra;
        $data['negara_id'] = $mowRow->negara_id;
        $data['provinsi_id'] = $mowRow->provinsi_id;
        $data['kota_kabupaten_id'] = $mowRow->kota_kabupaten_id;
        $data['kecamata_id'] = $mowRow->kecamata_id;
        $data['kelurahan_id'] = $mowRow->kelurahan_id;
        $data['alamat'] = $mowRow->alamat;
        $data['durasi_kerja_sama'] = $mowRow->durasi_kerja_sama;
        $data['status'] = $mowRow->status;
        $data['negara_result'] = Negara::all();
        $data['provinsi_result'] = Provinsi::orderBy('province_name')->get();
        $data['kota_kabupaten_result'] = $oKotaKabupaten->getKotaKabupatenByProvinsi($mowRow->provinsi_id)->get();
        $data['kecamatan_result'] = $oKecamatan->getKecamatanByKabupaten($mowRow->kota_kabupaten_id)->get();
        $data['kelurahan_result'] = $oKelurahan->getkelurahanByKecamatan($mowRow->kecamata_id)->get();


        $respon['status'] = true;
        $respon['token'] = csrf_token();
        $respon['view_modal_form'] = view('mou.form', $data)->render();
        return response()->json($respon);
    }

    public function perpanjangAction(Request $request)
    {
        $oMou = new Mou();
        // if country id 102 is indonesia
        if ($request->negara_id == '102') {
            $validator = Validator::make($request->all(), [
                'tanggal_kerja_sama'     => 'required',
                'nama_lembaga_mitra'   => 'required',
                'negara_id'   => 'required',
                'provinsi_id'   => 'required',
                'kota_kabupaten_id' => 'required',
                'kecamata_id'   => 'required',
                'kelurahan_id'   => 'required',
                'alamat'   => 'required',
                'durasi_kerja_sama'   => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'tanggal_kerja_sama'     => 'required',
                'nama_lembaga_mitra'   => 'required',
                'negara_id'   => 'required',
                'alamat'   => 'required',
                'durasi_kerja_sama'   => 'required',
            ]);
        }


        // check validation
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'token' => csrf_token(),
                    'message' => $validator->errors()->all()
                ]
            );
        }

        // check uploaded files
        if ($request->file('dokumen')) {

            $file = $request->file('dokumen');
            $filename = "Doc_MOU_" . time();
            $extension = $file->getClientOriginalExtension();
            $location = 'uploads/mou/';
            // Upload file
            $file->move($location, $filename);
            $dataInsert['dokumen'] = $filename . "." . $extension;
        }

        // if validation success
        if ($request->negara_id == '102') {
            $dataInsert['provinsi_id'] = $request->provinsi_id;
            $dataInsert['kota_kabupaten_id'] = $request->kota_kabupaten_id;
            $dataInsert['kecamata_id'] = $request->kecamata_id;
            $dataInsert['kelurahan_id'] = $request->kelurahan_id;
        }
        $dataInsert['tanggal_kerja_sama'] = $request->tanggal_kerja_sama;
        $dataInsert['nama_lembaga_mitra'] = $request->nama_lembaga_mitra;
        $dataInsert['negara_id'] = $request->negara_id;
        $dataInsert['alamat'] = $request->alamat;
        $dataInsert['durasi_kerja_sama'] = $request->durasi_kerja_sama;
        $dataInsert['tanggal_akhir_kerja_sama'] = date('Y-m-d', strtotime($request->tanggal_kerja_sama . ' + ' . $request->durasi_kerja_sama . ' years'));
        $dataInsert['status'] = 1;

        $dataInsert =  Mou::create($dataInsert);

        // untuk update id_parent
        $dataUpdate1['periode'] = $request->periode + 1;
        Mou::where(['id' => $dataInsert->id])->update($dataUpdate1);

        // untuk update status MOU lama
        $dataUpdate['status'] = '0';
        Mou::where(['id' => $request->id])->update($dataUpdate);

        $respon['status'] = true;
        $respon['token'] = csrf_token();
        $respon['message'] = "Berhasil perpanjang data MOU";

        return response()->json($respon);
    }

    public function detail(Request $request)
    {
        $oKotaKabupaten = new KotaKabupaten();
        $oKecamatan = new Kecamatan();
        $oKelurahan = new Kelurahan();
        $oMOU = new MOU();

        $id = $request->mou_id;
        $mouRow = $oMOU->getMouById($id)->first();
        // print_r($mouRow);

        $datetime = new \DateTime();
        $datetime->add(new DateInterval('P6M'));

        $data['title'] = "Detail MOU - " . $mouRow->nama_lembaga_mitra;
        $data['mouRow'] = $mouRow;
        $data['tanggal_6_bulan'] = $datetime->format('Y-m-d');

        $respon['status'] = true;
        $respon['token'] = csrf_token();
        $respon['view_modal_form'] = view('mou.detail', $data)->render();
        return response()->json($respon);
    }
}