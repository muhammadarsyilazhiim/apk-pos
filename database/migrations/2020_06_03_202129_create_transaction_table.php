<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi');
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->string('merek');
            $table->string('foto')->default('default.jpg');
            $table->bigInteger('harga');
            $table->bigInteger('harga_beli');
            $table->bigInteger('total_harga_beli');
            $table->integer('jumlah');
            $table->bigInteger('total_barang');
            $table->bigInteger('subtotal');
            $table->integer('diskon');
            $table->bigInteger('total');
            $table->bigInteger('bayar');
            $table->bigInteger('kembali');
            $table->integer('id_kasir');
            $table->integer('id_customer');
            $table->string('metodePem');
            $table->string('kasir');
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
        Schema::dropIfExists('transactions');
    }
}
