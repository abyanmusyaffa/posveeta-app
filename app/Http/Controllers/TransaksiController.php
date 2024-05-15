<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pesanan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\TransaksiPesanan;
use App\Models\TransaksiPenjualan;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;

class TransaksiController extends Controller
{
    public function index(): View
    {
        $transaksi_penjualans = TransaksiPenjualan::with('penjualans.barangs')->orderBy('updated_at', 'desc')->get();
        foreach ($transaksi_penjualans as $tp) {
            $tp->jumlah_barang = $tp->penjualans->count();
            $tp->total_harga = $tp->penjualans->sum(function ($p){
                return optional($p->barangs)->harga ?? 0;
            });
        };

        $transaksi_pesanans = TransaksiPesanan::with('pesanans')->orderBy('updated_at', 'desc')->get();

        $penjualans_today = TransaksiPenjualan::whereDate('created_at', Carbon::today()->toDateString())->count();
        $pesanans_today = TransaksiPesanan::whereDate('created_at', Carbon::today()->toDateString())->count();
        $transaksi_today = $penjualans_today + $pesanans_today;

        $penjualans_pending_today = TransaksiPenjualan::where('status_pembayaran', 'Pending')->whereDate('created_at', Carbon::today()->toDateString())->count();
        $pesanans_pending_today = TransaksiPesanan::where('status_pembayaran', 'Pending')->whereDate('created_at', Carbon::today()->toDateString())->count();
        $transaksi_pending_today = $penjualans_pending_today + $pesanans_pending_today;

        $penjualans_lunas_today = TransaksiPenjualan::where('status_pembayaran', 'Lunas')->whereDate('created_at', Carbon::today()->toDateString())->count();
        $pesanans_lunas_today = TransaksiPesanan::where('status_pembayaran', 'Lunas')->whereDate('created_at', Carbon::today()->toDateString())->count();
        $transaksi_lunas_today = $penjualans_lunas_today + $pesanans_lunas_today;

        $penjualans_pending = TransaksiPenjualan::where('status_pembayaran', 'Pending')->count();
        $pesanans_pending = TransaksiPesanan::where('status_pembayaran', 'Pending')->count();
        $transaksi_pending = $penjualans_pending + $pesanans_pending;

        $penjualans_lunas = TransaksiPenjualan::where('status_pembayaran', 'Lunas')->count();
        $pesanans_lunas = TransaksiPesanan::where('status_pembayaran', 'Lunas')->count();
        $transaksi_lunas = $penjualans_lunas + $pesanans_lunas;

        return view('transaksi', [
            'transaksi_penjualans' => $transaksi_penjualans,
            'transaksi_pesanans' => $transaksi_pesanans,
            'transaksi_today' => $transaksi_today,
            'transaksi_pending_today' => $transaksi_pending_today,
            'transaksi_lunas_today' => $transaksi_lunas_today,
            'transaksi_pending' => $transaksi_pending,
            'transaksi_lunas' => $transaksi_lunas
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->except('_token');

        $transaksi_penjualans = TransaksiPenjualan::where('id', $request->id)
                                    ->update($data);

        return redirect('/transaksi');
    }

    public function delete(Request $request, $id)
    {
        $transaksi_penjualans = TransaksiPenjualan::where('id', $id)->delete();

        $penjualans = Penjualan::where('transaksi_penjualan_id', $id)->delete();

        return redirect('/transaksi');
    }

    public function update_(Request $request): RedirectResponse
    {
        $data = $request->except('_token');

        $transaksi_pesanans= TransaksiPesanan::where('id', $request->id)
                                    ->update($data);

        return redirect('/transaksi');
    }

    public function delete_(Request $request, $id, $idp)
    {
        $transaksi_pesanans = TransaksiPesanan::where('id', $id)->delete();
        
        $pesanans = Pesanan::where('id', $idp)->delete();

        return redirect('/transaksi');
    }
}
