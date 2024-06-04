<?php

namespace App;

use App\Transaction;
use App\SuratJalan;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Initialize
    protected $fillable = [
        'kode_barang', 'jenis_barang', 'nama_barang', 'foto', 'berat_barang', 'merek', 'stok', 'harga', 'harga_beli', 'keterangan',
    ];

    public function transactions()
    {
        return $this->belongsTo(Transaction::class, 'kode_barang', 'kode_barang');
    }
    public function sj()
    {
        return $this->hasMany(SuratJalan::class, 'kode_barang', 'kode_barang');
    }
}