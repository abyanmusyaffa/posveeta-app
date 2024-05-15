<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Penjualan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class BarangController extends Controller
{
    public function index(): View
    {
        $barangs = Barang::orderBy('updated_at', 'desc')->get();
        $total_barang = Barang::sum('stok');
        $barang_today = Penjualan::whereDate('created_at', Carbon::today()->toDateString())->count();
        $barang_tidak_tersedia = Barang::where('stok', 0)->count();
        $barang_tersedia = Barang::where('stok', '>', 0)->count();

        return view('barang', [
            'barangs' => $barangs,
            'total_barang' => $total_barang,
            'barang_today' => $barang_today,
            'barang_tidak_tersedia' => $barang_tidak_tersedia,
            'barang_tersedia' => $barang_tersedia
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $barang = Barang::create($request->all());

        return redirect('/barang');
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->except('_token');
        $barang = Barang::where('id', $request->id)
                    ->update($data);

        return redirect('/barang');            
    }

    public function delete(Request $request, $id)
    {
        $barang = Barang::destroy($id);

        return redirect('/barang');
    }
}
