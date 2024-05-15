<?php

namespace App\Models;

use App\Models\Penjualan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    public function penjualans(): HasMany
    {
        return $this->hasMany(Penjualan::class);
    }

    protected $guarded = ['id'];
}
