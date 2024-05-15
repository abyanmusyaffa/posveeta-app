<?php

namespace App\Models;

use App\Models\TransaksiPesanan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    public function transaksi_pesanans(): HasOne
    {
        return $this->hasOne(TransaksiPesanan::class, 'pesanan_id');
    }

    protected $guarded = ['id'];
}
