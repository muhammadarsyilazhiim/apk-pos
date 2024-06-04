<?php

namespace App;

use App\SuratJalan;
use App\Transaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'email', 'notel', 'alamat'
    ];

    public function sj()
    {
        return $this->belongsTo(SuratJalan::class, 'id');
    }
    public function transaksi()
    {
        return $this->belongsTo(Transaction::class, 'id');
    }
}
