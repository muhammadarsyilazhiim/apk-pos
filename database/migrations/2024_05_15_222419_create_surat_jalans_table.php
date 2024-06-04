<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratJalansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_jalans', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat')->nullable();
            $table->integer('id_supir')->nullable();
            $table->string('ekspedisi')->nullable();
            $table->integer('id_customer')->nullable();
            $table->string('kode_barang')->nullable();
            $table->string('kode_transaksi')->nullable();
            $table->date('tgl_jalan')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('surat_jalans');
    }
}
