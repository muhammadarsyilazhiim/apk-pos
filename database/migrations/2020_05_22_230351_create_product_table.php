<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->string('foto')->default('barang.jpg');
            $table->string('jenis_barang');
            $table->string('nama_barang');
            $table->string('berat_barang')->nullable();
            $table->string('merek')->nullable();
            $table->integer('stok')->default(15);
            $table->bigInteger('harga');
            $table->bigInteger('harga_beli');
            $table->string('keterangan')->default('Tersedia');
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
        Schema::dropIfExists('products');
    }
}
