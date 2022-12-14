<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\KotaKabupaten;
use App\Models\Moa;
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
        $data['tahunKerjaSama'] = "";
        return view('moa.index', $data);
    }

    public function list()
    {
        $sqlBuilder = Moa::select(['tbl_moa.id as no', 'tbl_moa.id', 'tbl_mou.nama_lembaga_mitra', 'kategori_moa', 'tb_prodi.nama_prodi', 'tingkat_moa', 'tanggal', 'lembaga_mitra', 'master_negara.nama_negara', 'master_provinsi.province_name', 'master_kota_kabupaten.kota_kabupaten_nama', 'master_kecamatan.kecamatan_nama', 'master_kelurahan.kelurahan_nama', 'tbl_moa.alamat', 'durasi', 'tanggal_akhir', 'dokumen1', 'dokumen2', 'dokumen3', 'tbl_moa.status'])
            ->leftJoin('tbl_mou', 'tbl_mou.id', 'tbl_moa.mou_id')
            ->leftJoin('tb_prodi', 'tb_prodi.kode_prodi', 'tbl_moa.kode_prodi')
            ->leftJoin('master_negara', 'master_negara.id', 'tbl_moa.negara_id')
            ->leftJoin('master_provinsi', 'master_provinsi.master_provinsi_id', 'tbl_moa.provinsi_id')
            ->leftJoin('master_kota_kabupaten', 'master_kota_kabupaten.master_kota_kabupaten_id', 'tbl_moa.kota_kabupaten_id')
            ->leftJoin('master_kecamatan', 'master_kecamatan.master_kecamatan_id', 'tbl_moa.kecamata_id')
            ->leftJoin('master_kelurahan', 'master_kelurahan.master_kelurahan_id', 'tbl_moa.kelurahan_id');

        $oMou = new Moa();
        $dt = new Datatables(new LaravelAdapter);
        $dt->query($sqlBuilder);

        return $dt->generate();
    }

    public function create()
    {
        $oKotaKabupaten = new KotaKabupaten();
        $oKecamatan = new Kecamatan();
        $oKelurahan = new Kelurahan();

        $data['title'] = "Tambah MOA";
        $data['action'] = 'moa/create/action';
        $data['id'] = "";
        $data['mou_id'] = "";
        $data['kategori_moa'] = "";
        $data['tingkat_moa'] = "";
        $data['tanggal'] = "";
        $data['lembaga_mitra'] = "";
        $data['negara_id'] = "";
        $data['provinsi_id'] = "";
        $data['kota_kabupaten_id'] = "";
        $data['kecamata_id'] = "";
        $data['kelurahan_id'] = "";
        $data['alamat'] = "";
        $data['durasi'] = "";
        $data['tanggal_akhir'] = "";
        $data['dokumen1'] = "";
        $data['dokumen2'] = "";
        $data['dokumen3'] = "";
        $data['kode_prodi'] = "";
        $data['status'] = "";

        $data['mou_result'] = Mou::all();
        $data['negara_result'] = Negara::all();
        $data['provinsi_result'] = Provinsi::orderBy('province_name')->get();
        $data['kota_kabupaten_result'] = $oKotaKabupaten->getKotaKabupatenByProvinsi()->get();
        $data['kecamatan_result'] = $oKecamatan->getKecamatanByKabupaten()->get();
        $data['kelurahan_result'] = $oKelurahan->getkelurahanByKecamatan()->get();
        $data['prodi_result'] = DB::table('tb_prodi')->get();

        $respon['status'] = true;

        $respon['view_modal_form'] = view('moa.form', $data)->render();
        return response()->json($respon);
    }

    public function createAction(Request $request)
    {
        $oMou = new Moa();
        // if country id 102 is indonesia
        if ($request->negara_id == '102') {
            $validator = Validator::make($request->all(), [
                'mou_id'     => 'required',
                'kategori_moa'     => 'required',
                'tingkat_moa'     => 'required',
                'tanggal'     => 'required',
                'lembaga_mitra'   => 'required',
                'negara_id'   => 'required',
                'provinsi_id'   => 'required',
                'kota_kabupaten_id' => 'required',
                'kecamata_id'   => 'required',
                'kelurahan_id'   => 'required',
                'alamat'   => 'required',
                'durasi'   => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'mou_id'     => 'required',
                'kategori_moa'     => 'required',
                'tingkat_moa'     => 'required',
                'tanggal'     => 'required',
                'lembaga_mitra'   => 'required',
                'negara_id'   => 'required',
                'alamat'   => 'required',
                'durasi'   => 'required',
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

        // check uploaded files dokumen1
        if ($request->file('dokumen1')) {

            $file = $request->file('dokumen1');
            $extension = $file->getClientOriginalExtension();
            $filename = "Doc_MOA_" . time() . "." . $extension;
            $location = 'uploads/moa/';
            // Upload file
            $file->move($location, $filename);
            $dataInsert['dokumen1'] = $filename;
        }

        // check uploaded files dokumen2
        if ($request->file('dokumen2')) {

            $file = $request->file('dokumen2');
            $extension = $file->getClientOriginalExtension();
            $filename = "Doc_MOA_" . time() . "." . $extension;
            $location = 'uploads/moa/';
            // Upload file
            $file->move($location, $filename);
            $dataInsert['dokumen2'] = $filename;
        }

        // check uploaded files dokumen3
        if ($request->file('dokumen3')) {

            $file = $request->file('dokumen3');
            $extension = $file->getClientOriginalExtension();
            $filename = "Doc_MOA_" . time() . "." . $extension;
            $location = 'uploads/moa/';
            // Upload file
            $file->move($location, $filename);
            $dataInsert['dokumen3'] = $filename;
        }

        // if validation success
        if ($request->negara_id == '102') {
            $dataInsert['provinsi_id'] = $request->provinsi_id;
            $dataInsert['kota_kabupaten_id'] = $request->kota_kabupaten_id;
            $dataInsert['kecamata_id'] = $request->kecamata_id;
            $dataInsert['kelurahan_id'] = $request->kelurahan_id;
        }
        $dataInsert['mou_id'] = $request->mou_id;
        $dataInsert['kategori_moa'] = $request->kategori_moa;
        $dataInsert['tingkat_moa'] = $request->tingkat_moa;
        $dataInsert['tanggal'] = $request->tanggal;
        $dataInsert['lembaga_mitra'] = $request->lembaga_mitra;
        $dataInsert['negara_id'] = $request->negara_id;
        $dataInsert['alamat'] = $request->alamat;
        $dataInsert['durasi'] = $request->durasi;
        $dataInsert['tanggal_akhir'] = date('Y-m-d', strtotime($request->tanggal . ' + ' . $request->durasi . ' years'));
        $dataInsert['kode_prodi'] = $request->kode_prodi;
        $dataInsert['status'] = $request->status;

        $dataGet = Moa::create($dataInsert);

        $respon['status'] = true;
        $respon['token'] = csrf_token();
        $respon['message'] = "Berhasil menyimpan data MOA";

        return response()->json($respon);
    }

    public function update(Request $request)
    {
        $oKotaKabupaten = new KotaKabupaten();
        $oKecamatan = new Kecamatan();
        $oKelurahan = new Kelurahan();

        $id = $request->moa_id;
        $moaRow = Moa::where('id', $id)->first();


        $oKotaKabupaten = new KotaKabupaten();
        $oKecamatan = new Kecamatan();
        $oKelurahan = new Kelurahan();

        $data['title'] = "UpDATE MOA";
        $data['action'] = 'moa/update/action';
        $data['id'] = $moaRow->id;
        $data['mou_id'] = $moaRow->mou_id;
        $data['kategori_moa'] = $moaRow->kategori_moa;
        $data['tingkat_moa'] = $moaRow->tingkat_moa;
        $data['tanggal'] = $moaRow->tanggal;
        $data['lembaga_mitra'] = $moaRow->lembaga_mitra;
        $data['negara_id'] = $moaRow->negara_id;
        $data['provinsi_id'] = $moaRow->provinsi_id;
        $data['kota_kabupaten_id'] = $moaRow->kota_kabupaten_id;
        $data['kecamata_id'] = $moaRow->kecamata_id;
        $data['kelurahan_id'] = $moaRow->kelurahan_id;
        $data['alamat'] = $moaRow->alamat;
        $data['durasi'] = $moaRow->durasi;
        $data['tanggal_akhir'] = $moaRow->tanggal_akhir;
        $data['dokumen1'] = $moaRow->dokumen1;
        $data['dokumen2'] = $moaRow->dokumen2;
        $data['dokumen3'] = $moaRow->dokumen3;
        $data['kode_prodi'] = $moaRow->kode_prodi;
        $data['status'] = $moaRow->status;

        $data['mou_result'] = Mou::all();
        $data['negara_result'] = Negara::all();
        $data['provinsi_result'] = Provinsi::orderBy('province_name')->get();
        $data['kota_kabupaten_result'] = $oKotaKabupaten->getKotaKabupatenByProvinsi($moaRow->provinsi_id)->get();
        $data['kecamatan_result'] = $oKecamatan->getKecamatanByKabupaten($moaRow->kota_kabupaten_id)->get();
        $data['kelurahan_result'] = $oKelurahan->getkelurahanByKecamatan($moaRow->kecamata_id)->get();
        $data['prodi_result'] = DB::table('tb_prodi')->get();

        $respon['status'] = true;
        $respon['token'] = csrf_token();
        $respon['view_modal_form'] = view('moa.form', $data)->render();
        $respon['moa'] = $moaRow;
        return response()->json($respon);
    }

    public function updateAction(Request $request)
    {
        $oMou = new Moa();
        // if country id 102 is indonesia
        if ($request->negara_id == '102') {
            $validator = Validator::make($request->all(), [
                'mou_id' => 'required',
                'kategori_moa'     => 'required',
                'tingkat_moa'     => 'required',
                'tanggal'     => 'required',
                'lembaga_mitra'   => 'required',
                'negara_id'   => 'required',
                'provinsi_id'   => 'required',
                'kota_kabupaten_id' => 'required',
                'kecamata_id'   => 'required',
                'kelurahan_id'   => 'required',
                'alamat'   => 'required',
                'durasi'   => 'required',
                'kode_prodi' => 'required',
                'status'   => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'kategori_moa'     => 'required',
                'tingkat_moa'     => 'required',
                'tanggal'     => 'required',
                'lembaga_mitra'   => 'required',
                'negara_id'   => 'required',
                'alamat'   => 'required',
                'durasi'   => 'required',
                'kode_prodi' => 'required',
                'status'   => 'required',
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

        // check uploaded files dokumen1
        if ($request->file('dokumen1')) {

            $file = $request->file('dokumen1');
            $extension = $file->getClientOriginalExtension();
            $filename = "Doc_MOA_" . time() . "." . $extension;
            $location = 'uploads/moa/';
            // Upload file
            $file->move($location, $filename);
            $dataUpdate['dokumen1'] = $filename;
        }

        // check uploaded files dokumen2
        if ($request->file('dokumen2')) {

            $file = $request->file('dokumen2');
            $extension = $file->getClientOriginalExtension();
            $filename = "Doc_MOA_" . time() . "." . $extension;
            $location = 'uploads/moa/';
            // Upload file
            $file->move($location, $filename);
            $dataUpdate['dokumen2'] = $filename;
        }

        // check uploaded files dokumen3
        if ($request->file('dokumen3')) {

            $file = $request->file('dokumen3');
            $extension = $file->getClientOriginalExtension();
            $filename = "Doc_MOA_" . time() . "." . $extension;
            $location = 'uploads/moa/';
            // Upload file
            $file->move($location, $filename);
            $dataUpdate['dokumen3'] = $filename;
        }

        // if validation success
        if ($request->negara_id == '102') {
            $dataUpdate['provinsi_id'] = $request->provinsi_id;
            $dataUpdate['kota_kabupaten_id'] = $request->kota_kabupaten_id;
            $dataUpdate['kecamata_id'] = $request->kecamata_id;
            $dataUpdate['kelurahan_id'] = $request->kelurahan_id;
        }

        $dataUpdate['mou_id'] = $request->mou_id;
        $dataUpdate['kategori_moa'] = $request->kategori_moa;
        $dataUpdate['tingkat_moa'] = $request->tingkat_moa;
        $dataUpdate['tanggal'] = $request->tanggal;
        $dataUpdate['lembaga_mitra'] = $request->lembaga_mitra;
        $dataUpdate['negara_id'] = $request->negara_id;
        $dataUpdate['alamat'] = $request->alamat;
        $dataUpdate['durasi'] = $request->durasi;
        $dataUpdate['tanggal_akhir'] = date('Y-m-d', strtotime($request->tanggal . ' + ' . $request->durasi . ' years'));
        $dataUpdate['kode_prodi'] = $request->kode_prodi;
        $dataUpdate['status'] = $request->status;

        $dataGet = Moa::where(['id' => $request->id])->update($dataUpdate);

        $respon['status'] = true;
        $respon['token'] = csrf_token();
        $respon['message'] = "Berhasil update data MOA";

        return response()->json($respon);
    }

    public function perpanjang(Request $request)
    {
        $oKotaKabupaten = new KotaKabupaten();
        $oKecamatan = new Kecamatan();
        $oKelurahan = new Kelurahan();

        $id = $request->mou_id;
        $moaRow = Moa::where('id', $id)->first();

        $data['title'] = "Perpanjang MOU";
        $data['action'] = 'mou/perpanjang/action';
        $data['is_perpanjang'] = true; // untuk menandakan ini form perpanjang
        $data['id'] = $id;
        $data['periode'] = $moaRow->periode;
        $data['tanggal'] = "";
        $data['nama_lembaga_mitra'] = $moaRow->nama_lembaga_mitra;
        $data['negara_id'] = $moaRow->negara_id;
        $data['provinsi_id'] = $moaRow->provinsi_id;
        $data['kota_kabupaten_id'] = $moaRow->kota_kabupaten_id;
        $data['kecamata_id'] = $moaRow->kecamata_id;
        $data['kelurahan_id'] = $moaRow->kelurahan_id;
        $data['alamat'] = $moaRow->alamat;
        $data['durasi'] = $moaRow->durasi;
        $data['status'] = $moaRow->status;
        $data['negara_result'] = Negara::all();
        $data['provinsi_result'] = Provinsi::orderBy('province_name')->get();
        $data['kota_kabupaten_result'] = $oKotaKabupaten->getKotaKabupatenByProvinsi($moaRow->provinsi_id)->get();
        $data['kecamatan_result'] = $oKecamatan->getKecamatanByKabupaten($moaRow->kota_kabupaten_id)->get();
        $data['kelurahan_result'] = $oKelurahan->getkelurahanByKecamatan($moaRow->kecamata_id)->get();


        $respon['status'] = true;
        $respon['token'] = csrf_token();
        $respon['view_modal_form'] = view('moa.form', $data)->render();
        return response()->json($respon);
    }

    public function perpanjangAction(Request $request)
    {
        $oMou = new Moa();
        // if country id 102 is indonesia
        if ($request->negara_id == '102') {
            $validator = Validator::make($request->all(), [
                'tanggal'     => 'required',
                'nama_lembaga_mitra'   => 'required',
                'negara_id'   => 'required',
                'provinsi_id'   => 'required',
                'kota_kabupaten_id' => 'required',
                'kecamata_id'   => 'required',
                'kelurahan_id'   => 'required',
                'alamat'   => 'required',
                'durasi'   => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'tanggal'     => 'required',
                'nama_lembaga_mitra'   => 'required',
                'negara_id'   => 'required',
                'alamat'   => 'required',
                'durasi'   => 'required',
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
        $dataInsert['tanggal'] = $request->tanggal;
        $dataInsert['nama_lembaga_mitra'] = $request->nama_lembaga_mitra;
        $dataInsert['negara_id'] = $request->negara_id;
        $dataInsert['alamat'] = $request->alamat;
        $dataInsert['durasi'] = $request->durasi;
        $dataInsert['tanggal_akhir'] = date('Y-m-d', strtotime($request->tanggal . ' + ' . $request->durasi . ' years'));
        $dataInsert['status'] = 1;

        $dataInsert =  Moa::create($dataInsert);

        // untuk update id_parent
        $dataUpdate1['periode'] = $request->periode + 1;
        Moa::where(['id' => $dataInsert->id])->update($dataUpdate1);

        // untuk update status MOU lama
        $dataUpdate['status'] = '0';
        Moa::where(['id' => $request->id])->update($dataUpdate);

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
        $oMoa = new Moa();

        $id = $request->moa_id;
        $moaRow = $oMoa->getMoaById($id)->first();
        // print_r($mouRow);

        $datetime = new \DateTime();
        $datetime->add(new DateInterval('P6M'));

        $data['title'] = "Detail MOU - " . $moaRow->nama_lembaga_mitra;
        $data['moaRow'] = $moaRow;
        $data['tanggal_6_bulan'] = $datetime->format('Y-m-d');

        $respon['status'] = true;
        $respon['token'] = csrf_token();
        $respon['view_modal_form'] = view('moa.detail', $data)->render();
        return response()->json($respon);
    }
}
