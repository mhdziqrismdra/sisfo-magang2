<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPenilaianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_penilaian', function (Blueprint $table) {
            $table->bigIncrements('id_penilaian');
            $table->string('nip');
            $table->string('atasan_langsung');
            $table->string('atasan_pejabat_penilai');
            $table->date('periode_awal');
            $table->date('periode_akhir');
            $table->integer('capaian_kerja');
            $table->integer('orientasi_pelayanan');
            $table->integer('integritas');
            $table->integer('komitmen');
            $table->integer('disiplin');
            $table->integer('kerjasama');
            $table->integer('kepemimpinan');
            $table->double('jumlah');
        });

        Schema::table('tb_penilaian', function (Blueprint $table) {

            $table->foreign('nip')->references('nip')->on('tb_pegawai')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_penilaian');
    }
}
