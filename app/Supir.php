<?php

namespace App;

use App\SuratJalan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supir extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sj()
    {
        return $this->belongsTo(SuratJalan::class, 'id');
    }
}
