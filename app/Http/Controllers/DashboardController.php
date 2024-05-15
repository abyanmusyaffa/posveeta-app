<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Pesanan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\TransaksiPesanan;
use App\Models\TransaksiPenjualan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): View
    {
        $barangs = Barang::limit(6)->get();
        $pesanans = Pesanan::whereDate('estimasi', Carbon::today()->toDateString())->limit(5)->get();
        $transaksi_penjualans = TransaksiPenjualan::with('penjualans.barangs')->limit(4)->orderBy('created_at', 'desc')->get();
        foreach ($transaksi_penjualans as $tp) {
            $tp->jumlah_barang = $tp->penjualans->count();
            $tp->total_harga = $tp->penjualans->sum(function ($p){
                return optional($p->barangs)->harga ?? 0;
            });
        };

        $transaksi_pesanans = TransaksiPesanan::with('pesanans')->limit(4)->orderBy('updated_at', 'desc')->get();
 
        return view('dashboard', [
            'barangs' => $barangs,
            'pesanans' => $pesanans,
            'transaksi_penjualans' => $transaksi_penjualans,
            'transaksi_pesanans' => $transaksi_pesanans 
        ]);
    }
}
