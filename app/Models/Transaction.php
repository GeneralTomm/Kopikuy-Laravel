<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "transactions";
    protected $fillable = [
        'date',
        'userId',
        'grandtotal',
        'metodePembayaran',
        'pengambilan',
        'bukti',
        'kodetransaksi',
        'token',
        'status',
        'penerima',
        'recap'
    ];
}
