<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Mou extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_mou', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_kerja_sama');
            $table->string('nama_lembaga_mitra');
            $table->integer('negara_id');
            $table->string('provinsi_id', 25);
            $table->string('kota_kabupaten_id', 25);
            $table->string('kecamata_id', 25);
            $table->string('kelurahan_id', 25);
            $table->text('alamat');
            $table->integer('durasi_kerja_sama');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tbl_mou');
    }
}
