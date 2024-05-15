<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\TransaksiPesanan;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PesananController extends Controller
{
    public function index(): View
    {
        $pesanans = Pesanan::with('transaksi_pesanans')->orderBy('updated_at', 'desc')->get();
        $pesanan_proses = Pesanan::where('status_pesanan', 'Proses')->count();
        $pesanan_pending = Pesanan::where('status_pesanan', 'Pending')->count();
        $pesanan_today = Pesanan::whereDate('estimasi', Carbon::today()->toDateString())->count();

        return view('pesanan', [
            'pesanans' => $pesanans,
            'pesanan_proses' => $pesanan_proses,
            'pesanan_pending' => $pesanan_pending,
            'pesanan_today' => $pesanan_today
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $pesanan = Pesanan::create($request->all());

        return redirect('/pesanan');
    }

    public function update(Request $request): RedirectResponse
    {

        $pesanan = Pesanan::where('id', $request->id)
                    ->update([
                        'nama_pelanggan' => $request->nama_pelanggan,
                        'hp_pelanggan' => $request->hp_pelanggan,
                        'estimasi' => $request->estimasi,
                        'isi_pesanan' => $request->isi_pesanan,
                        'ket_pesanan' => $request->ket_pesanan,
                        'harga' => $request->harga,
                        'status_pesanan' => $request->status_pesanan
                ]);
        
        if($request->jenis_pembayaran && $request->status_pembayaran) {
            $pesanan = TransaksiPesanan::updateOrCreate([
                'pesanan_id' => $request->id
            ], 
            [
                'jenis_pembayaran' => $request->jenis_pembayaran,
                'status_pembayaran' => $request->status_pembayaran,
                'ket_transaksi_pesanan' => $request->ket_transaksi_pesanan
            ]);
        };
        

        return redirect('/pesanan');
    }

    public function delete(Request $request, $id)
    {
        $pesanan = Pesanan::where('id', $id)->delete();

        $transaksi_pesanan = TransaksiPesanan::where('pesanan_id', $id)
                                ->delete();

        return redirect('/pesanan');
    }

}
