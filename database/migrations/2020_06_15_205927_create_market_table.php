<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('markets', function (Blueprint $table) {
            $table->id();
            $table->string('nama_toko');
            $table->string('no_telp');
            $table->text('alamat');   
            $table->timestamps();
        });

        DB::table('markets')->insert(
            array(
                'nama_toko' => 'TOKOTOREN',
                'no_telp' => '0812-8363-9357',
                'alamat' => 'Jl. Raya Ps. Kemis, Gelam Jaya, Kec. Ps. Kemis, Kota Tangerang, Banten 15560
                '
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('markets');
    }
}
