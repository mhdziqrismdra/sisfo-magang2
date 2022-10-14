<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDokumenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_dokumen', function (Blueprint $table) {
            $table->bigIncrements('id_dokumen');
            $table->string('nip');
            $table->string('judul_dokumen');
            $table->string('file_dokumen');
            $table->timestamps();
        });

        Schema::table('tb_dokumen', function (Blueprint $table) {

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
        Schema::dropIfExists('tb_dokumen');
    }
}
