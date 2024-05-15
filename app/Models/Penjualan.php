<?php

namespace App\Models;

use App\Models\Barang;
use App\Models\TransaksiPenjualan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;

    public function transaksi_penjualans(): BelongsTo
    {
        return $this->belongsTo(TransaksiPenjualan::class);
    }

    public function barangs(): BelongsTo
    {
        return $this->belongsTo(Barang::class);
    }

    protected $guarded = ['id'];
}
