<?php

namespace App;

use App\Product;
use App\Customer;
use App\Transaction;
use App\Supir;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratJalan extends Model
{
    use HasFactory;
    

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'kode_barang', 'kode_barang');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }
    public function transaksi()
    {
        return $this->belongsTo(Transaction::class, 'kode_barang', 'kode_barang');
    }
    public function supir()
    {
        return $this->belongsTo(Supir::class, 'id_supir');
    }
    
}
