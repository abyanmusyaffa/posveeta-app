<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\TransaksiPenjualan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PenjualanController extends Controller
{
    public function index(): View
    {
        $barangs = Barang::all();

        return view('penjualan', [
            'barangs' => $barangs
        ]);
    }

    public function confirmation(Request $request): View
    {
        $inputs = $request->input('inputs');


        $list= Barang::whereIn('id', $inputs)->get();

        $confirm = [];
        $total_harga = 0;

        foreach ($inputs as $i) {
            $barang = $list->firstWhere('id', $i);
            if ($barang) {
                $confirm[] = $barang;
                $total_harga += $barang->harga;
            }
        }

        $barangs = Barang::all();

        return view('penjualan', [
            'confirm' => $confirm,
            'total_harga' => $total_harga,
            'barangs' => $barangs
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        // dd($request->inputs);
        $transaksi_penjualan = TransaksiPenjualan::create([
                                    'nama_pelanggan' => $request->nama_pelanggan,
                                    'hp_pelanggan' => $request->hp_pelanggan,
                                    'jenis_pembayaran' => $request->jenis_pembayaran,
                                    'status_pembayaran' => $request->status_pembayaran,
                                    'ket_transaksi_penjualan' => $request->ket_transaksi_penjualan
                                ]);
        
        foreach($request->inputs as $b) {
            Penjualan::create([
                'transaksi_penjualan_id' => $transaksi_penjualan->id,
                'barangs_id' => $b
            ]);

            $barang = Barang::find($b);
            if ($barang) {
                $barang->decrement('stok', 1);
            }
        }

        return redirect('/penjualan');
    }


}
