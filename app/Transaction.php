<?php

namespace App;

use App\Product;
use App\SuratJalan;
use App\Customer;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // Initialize
    protected $fillable = [
        'kode_transaksi', 'kode_barang', 'foto', 'nama_barang', 'merek', 'harga', 'harga_beli', 'total_harga_beli', 'jumlah', 'total_barang', 'subtotal', 'diskon', 'total', 'bayar', 'kembali', 'id_kasir', 'id_barang', 'kasir', 'id_customer', 'metodePem'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'kode_barang', 'kode_barang');
    }
    public function sj()
    {
        return $this->belongsTo(SuratJalan::class, 'kode_barang', 'kode_barang');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }
}
