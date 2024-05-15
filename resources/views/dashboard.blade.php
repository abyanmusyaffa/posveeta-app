 {{-- @dd($transaksi_penjualans) --}}
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="https://kit.fontawesome.com/b91f07c834.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <title>Posveeta | Dashboard</title>
  </head>
  <body style="font-family: 'Poppins'">
    <div class="w-screen h-svh flex bg-slate-950">
      <!-- Sidebar -->
      <div class="w-2/12 p-4">
        <img src="img/pos2.svg" class="w-2/3 mx-auto" alt="" />
        <div class="w-full mt-6">
          <div class="flex mx-2 mb-4 w-auto bg-slate-900 h-0.5"></div>
          <a href="/" class="flex items-center w-full py-4 px-6 mb-4 bg-slate-900 rounded-xl text-slate-400 hover:text-slate-300 hover:font-semibold transition-all">
            <i class="fa-solid fa-home fa-lg fa-fw me-6"></i>
            <p>Dashboard</p>
          </a>

          <a href="/penjualan" class="flex items-center w-full py-4 px-6 mb-4 rounded-xl text-slate-300 hover:bg-slate-900 hover:font-semibold transition-all">
            <i class="fa-solid fa-cart-shopping fa-lg fa-fw me-6"></i>
            <p>Penjualan Barang</p>
          </a>

          <a href="/barang" class="flex items-center w-full py-4 px-6 mb-4 rounded-xl text-slate-300 hover:bg-slate-900 hover:font-semibold transition-all">
            <i class="fa-solid fa-layer-group fa-lg fa-fw me-6"></i>
            <p>Stok Barang</p>
          </a>

          <a href="/pesanan" class="flex items-center w-full py-4 px-6 mb-4 rounded-xl text-slate-300 hover:bg-slate-900 hover:font-semibold transition-all">
            <i class="fa-solid fa-clipboard-list fa-lg fa-fw me-6"></i>
            <p>Pesanan</p>
          </a>

          <a href="/transaksi" class="flex items-center w-full py-4 px-6 mb-4 rounded-xl text-slate-300 hover:bg-slate-900 hover:font-semibold transition-all">
            <i class="fa-solid fa-file-lines fa-lg fa-fw me-6"></i>
            <p>Riwayat Transaksi</p>
          </a>
        </div>
      </div>
      <!-- Sidebar -->

      <!-- Container -->
      <div class="w-10/12 bg-slate flex flex-col">
        <!-- Topbar -->
        <div class="w-full flex h-16 py-2 px-4 items-center justify-end gap-4">
          <div class="flex items-center text-slate-300">
            <i class="fa-solid fa-circle-user fa-lg me-2"></i>
            <p class="text-lg">{{ Auth::user()->name }}</p>
          </div>
          <form action="/logout" method="post">
            @csrf
            <button type="submit" class="flex p-4 py-5 size-min text-white rounded-lg hover:text-slate-300 hover:bg-slate-900">
              <i class="fa-solid fa-right-from-bracket fa-lg"></i>
            </button>
          </form>
        </div>
        <!-- Topbar -->

        <!-- Content -->
        <div class="w-full h-full p-2 flex flex-wrap">
          <div class="w-8/12 h-1/2 p-2">
            <div class="flex flex-col size-full bg-slate-900 rounded-2xl p-4">
              <p class="font-semibold text-lg text-slate-300">Pesanan diambil hari ini</p>
              <div class="h-full">
                <table class="text-sm text-slate-400 mt-4 w-full">
                  <tr class="bg-slate-800">
                    <th class="w-3/12 py-2 rounded-s-xl">Nama Pelanggan</th>
                    <th class="w-4/12 py-2">Pesanan</th>
                    <th class="w-3/12 py-2">Jam</th>
                    <th class="w-2/12 py-2 rounded-e-xl">Status</th>
                  </tr>
                  @foreach ($pesanans as  $p )
                  <tr class="text-center">
                    <td class="p-2">{{ $p->nama_pelanggan }}</td>
                    <td class= "p-2">{{ $p->isi_pesanan }}</td>
                    <td class="p-2">{{ (new DateTime($p->estimasi))->format('H:i') }}</td>
                    <td class="p-2 
                    @if ($p->status_pesanan == 'Proses')
                     text-blue-700
                    @elseif ($p->status_pesanan == 'Selesai')
                      text-yellow-700
                    @else
                      text-red-700
                    @endif">
                    @if ($p->status_pesanan == 'Proses')
                      <i class="fa-solid fa-circle-up fa-fw me-2"></i>{{ $p->status_pesanan }}
                    @elseif ($p->status_pesanan == 'Selesai')
                      <i class="fa-solid fa-circle-check fa-fw me-2"></i>{{ $p->status_pesanan }}
                    @else
                      <i class="fa-solid fa-clock fa-fw me-2"></i>{{ $p->status_pesanan }}
                    @endif</td>
                  </tr>
                  @endforeach
                </table>
              </div>
              <div class="flex mx-2 mb-4 w-full bg-slate-800 h-0.5"></div>
              <a href="/pesanan" class="border border-slate-300 text-slate-300 text-xs rounded-xl w-auto px-12 py-1 mx-auto hover:bg-slate-800 hover:border-slate-800 hover:tracking-widest transition-all">Pesanan Lainnya</a>
            </div>
          </div>
          <div class="w-4/12 h-1/2 p-2">
            <div class="flex flex-col size-full bg-slate-900 rounded-2xl p-4">
              <div class="flex items-start justify-between">
                <p class="font-semibold text-lg text-slate-300">Stok barang</p>
                <a href="/barang" class="text-sm text-slate-300 px-4 py-1 rounded-xl hover:bg-slate-800">Lainnya<i class="fa-solid fa-caret-right ms-2"></i></a>
              </div>
              <table class="text-sm text-slate-400 mt-4">
                <tr class="bg-slate-800">
                  <th class="w-6/12 py-2 rounded-s-xl">Nama Barang</th>
                  <th class="w-4/12 py-2">Harga</th>
                  <th class="w-2/12 py-2 rounded-e-xl">Stok</th>
                </tr>
                @foreach ($barangs as $b)
                <tr class="text-center border-b border-slate-800">
                  <td class="p-2">{{ $b->nama_barang }}</td>
                  <td class="p-2">IDR {{ number_format($b->harga, 0, ',', '.') }}</td>
                  <td class="p-2">{{ $b->stok }}</td>
                </tr>
                @endforeach
              </table>
            </div>
          </div>
          <div class="w-full h-1/2 p-2">
            <div class="flex flex-col size-full bg-slate-900 rounded-2xl p-4">
              <p class="font-semibold text-lg text-slate-300">Transaksi terbaru</p>
              <div class="mt-4 mb-2 ">
                <ul class="flex font-medium text-xs text-center items-center bg-slate-800 w-min rounded-2xl p-1.5" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                  <li class="" role="presentation">
                    <button class="w-28 px-4" id="penjualan-tab" data-tabs-target="#penjualan" type="button" role="tab" aria-controls="profile" aria-selected="false">Penjualan</button>
                  </li>
                  <li class="" role="presentation">
                    <button class="w-28 px-4" id="pesanan-tab" data-tabs-target="#pesanan" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Pesanan</button>
                  </li>
                </ul>
              </div>
              <div id="default-tab-content" class="h-full">
                <div class="hidden" id="penjualan" role="tabpanel" aria-labelledby="penjualan-tab">
                  <table class="text-sm text-center text-slate-400 w-full">
                    <tr class="border-b border-slate-800">
                      <th class="w-2/12 py-2">INV</th>
                      <th class="w-3/12">Waktu</th>
                      <th class="w-2/12">Total Harga</th>
                      <th class="w-3/12">Pembayaran</th>
                      <th class="w-2/12">Status pembayaran</th>
                    </tr>
                    @foreach($transaksi_penjualans as $tpe)
                      <tr class="border-b border-slate-800">
                        <td class="py-2">{{ $tpe->id }}</td>
                        <td >{{ $tpe->created_at }}</td>
                        <td >IDR {{ number_format($tpe->total_harga, 0, ',', '.') }}</td>
                        <td >{{ $tpe->jenis_pembayaran }}</td>
                        <td class="
                          @if($tpe->status_pembayaran == 'Pending')
                           text-red-700
                          @else
                            text-blue-700
                          @endif">
                          @if($tpe->status_pembayaran == 'Pending')
                            <i class="fa-solid fa-clock fa-fw me-2"></i>{{ $tpe->status_pembayaran }}
                          @else
                            <i class="fa-solid fa-circle-check fa-fw me-2"></i>{{ $tpe->status_pembayaran }}
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </table>
                </div>
                <div class="hidden" id="pesanan" role="tabpanel" aria-labelledby="pesanan-tab">
                  <table class="text-sm text-center text-slate-400 w-full">
                    <tr class="border-b border-slate-800">
                      <th class="w-1/12 py-2">INV</th>
                      <th class="w-2/12">Nama Pelanggan</th>
                      <th class="w-2/12">Pesanan</th>
                      <th class="w-2/12">Waktu pengambilan</th>
                      <th class="w-1/12">Harga</th>
                      <th class="w-2/12">Pembayaran</th>
                      <th class="w-2/12">Status pembayaran</th>
                    </tr>
                    @foreach($transaksi_pesanans as $tp)
                      <tr class="border-b border-slate-800">
                        <td class="py-2">{{ $tp->id }}</td>
                        <td >{{ $tp->pesanans->nama_pelanggan }}</td>
                        <td >{{ $tp->pesanans->isi_pesanan }}</td>
                        <td >{{ $tp->updated_at }}</td>
                        <td >IDR {{ number_format($tp->pesanans->harga, 0, ',', '.') }}</td>
                        <td >{{ $tp->jenis_pembayaran }}</td>
                        <td class="
                          @if($tp->status_pembayaran == 'Pending')
                           text-red-700
                          @else
                            text-blue-700
                          @endif">
                          @if($tp->status_pembayaran == 'Pending')
                            <i class="fa-solid fa-clock fa-fw me-2"></i>{{ $tp->status_pembayaran }}
                          @else
                            <i class="fa-solid fa-circle-check fa-fw me-2"></i>{{ $tp->status_pembayaran }}
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </table>
                </div>
              </div>
              <a href="/transaksi" class="border border-slate-300 text-slate-300 text-xs rounded-xl mx-auto w-auto px-12 py-1 hover:bg-slate-800 hover:border-slate-800 hover:tracking-widest transition-all">Transaksi Lainnya</a>
            </div>
          </div>
        </div>
        <!-- Content -->
      </div>
      <!-- Container -->
    </div>

  </body>
</html>