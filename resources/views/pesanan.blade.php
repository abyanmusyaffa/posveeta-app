{{-- @dd($pesanans) --}}
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
    <title>Posveeta | Pesanan</title>
  </head>
  <body style="font-family: 'Poppins'">
    <div class="w-screen h-svh flex bg-slate-950">
      <!-- Sidebar -->
      <div class="w-2/12 p-4">
        <img src="img/pos2.svg" class="w-2/3 mx-auto" alt="" />
        <div class="w-full mt-6">
          <div class="flex mx-2 mb-4 w-auto bg-slate-900 h-0.5"></div>
          <a href="/" class="flex items-center w-full py-4 px-6 mb-4 rounded-xl text-slate-300 hover:font-semibold transition-all">
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

          <a href="/pesanan" class="flex items-center w-full py-4 px-6 mb-4 rounded-xl bg-slate-900 text-slate-400 hover:text-slate-300 hover:bg-slate-900 hover:font-semibold transition-all">
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
        <div class="w-full flex h-16 py-2 px-4 items-center justify-end gap-4 bg-slate-950">
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
        <div class="w-full h-full p-2 flex flex-wrap ">
          <div class="w-4/12 h-1/6 p-2">
            <div class="flex items-center justify-center gap-4 size-full bg-slate-900 rounded-2xl p-4 px-8">
                <p class="w-2/3 text-center text-blue-600 text-6xl font-semibold">{{ $pesanan_today }}</p>
                <p class=" text-slate-300 text-xl">Pesanan diambil hari ini</p>
            </div>
          </div>
          <div class="w-4/12 h-1/6 p-2">
            <div class="flex items-center justify-center gap-4 size-full bg-slate-900 rounded-2xl p-4 px-8">
                <p class="w-1/2 text-center text-orange-500 text-6xl font-semibold">{{ $pesanan_proses }}</p>
                <p class="text-slate-300 text-xl">Pesanan dalam proses</p>
            </div>
          </div>
          <div class="w-4/12 h-1/6 p-2">
            <div class="flex items-center justify-center gap-4 size-full bg-slate-900 rounded-2xl p-4 px-8">
                <p class="w-1/2 text-center text-yellow-400 text-6xl font-semibold">{{ $pesanan_pending }}</p>
                <p class="text-slate-300 text-xl">Pesanan pending</p>
            </div>
          </div>
          <div class="w-2/3 h-5/6 p-2">
            <div class="flex flex-col size-full bg-slate-900 rounded-2xl p-4">
                <p class="font-semibold text-lg text-slate-300">Daftar pesanan</p>
                <div class="h-full flex flex-col">
                    <div class="flex bg-slate-800 mt-4 py-2 rounded-t-xl text-slate-300 font-semibold text-sm">
                        <p class="w-2/12 text-center">ID</p>
                        <p class="w-2/12 text-center">Nama Pelanggan</p>
                        <p class="w-3/12 text-center">Pesanan</p>
                        <p class="w-3/12 text-center">Estimasi selesai</p>
                        <p class="w-2/12 text-center">Status</p>
                    </div>
                    @foreach($pesanans as $p)
                    <button type="button" data-modal-target="detail-pesanan{{ $p->id }}" data-modal-toggle="detail-pesanan{{ $p->id }}">
                        <div class="flex py-2 border-b border-slate-800 text-slate-300 text-sm hover:bg-slate-950">
                            <p class="w-2/12 text-center">{{ $p->id }}</p>
                            <p class="w-2/12 text-center">{{ $p->nama_pelanggan }}</p>
                            <p class="w-3/12 text-center">{{ $p->isi_pesanan }}</p>
                            <p class="w-3/12 text-center">{{ (new DateTime($p->estimasi))->format('l, d M Y') }}</p>
                            <p class="w-2/12 text-center 
                            @if ($p->status_pesanan == 'Proses')
                                text-blue-700
                            @elseif ($p->status_pesanan == 'Selesai')
                                text-yellow-700
                            @elseif ($p->status_pesanan == 'Pending')
                                text-red-700
                            @else
                                text-green-500
                            @endif
                            ">
                            @if ($p->status_pesanan == 'Proses')
                                <i class="fa-solid fa-circle-up fa-fw me-2"></i>{{ $p->status_pesanan }}
                            @elseif ($p->status_pesanan == 'Selesai')
                                <i class="fa-solid fa-circle-check fa-fw me-2"></i>{{ $p->status_pesanan }}
                            @elseif ($p->status_pesanan == 'Pending')
                                <i class="fa-solid fa-clock fa-fw me-2"></i>{{ $p->status_pesanan }}
                            @else
                                <i class="fa-solid fa-circle-dollar-to-slot me-2"></i>{{ $p->status_pesanan }}</p>
                            @endif
                        </div>
                    </button>
                    <div id="detail-pesanan{{ $p->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full  h-[calc(100%-1rem)] ">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-slate-800 rounded-lg shadow ">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 border-b border-slate-900 rounded-t ">
                                    <h3 class="text-xl font-semibold text-slate-300">
                                        Detail pesanan
                                    </h3>
                                    <button type="button" class="text-gray-400 hover:bg-slate-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-toggle="detail-pesanan{{ $p->id }}">
                                        <i class="fa-solid fa-xmark fa-xl"></i>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-4 ">
                                    <form action="/pesanan-edit" method="post">
                                        @csrf
                                        <div class="flex flex-wrap">
                                            <div class="w-2/3 mb-2">
                                                <label for="nama_pelanggan" class="ms-1 text-slate-300 font-medium">Nama Pelanggan</label>
                                                <input type="text" required name="nama_pelanggan" id="nama_pelanggan" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" value="{{ $p->nama_pelanggan }}">
                                            </div>
                                            <div class="w-1/3 ps-2">
                                                <label for="hp_pelanggan" class="ms-1 text-slate-300 font-medium">Nomor HP</label>
                                                <input type="text" name="hp_pelanggan" id="hp_pelanggan" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" value="{{ $p->hp_pelanggan }}">
                                            </div>
                                            <div class="w-1/3 mb-2">
                                                <label for="id" class="ms-1 text-slate-300 font-medium">ID Pesanan</label>
                                                <input type="text" readonly name="id" id="id" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" value="{{ $p->id }}">
                                            </div>
                                            <div class="w-2/3 ps-2">
                                                <label for="isi_pesanan" class="ms-1 text-slate-300 font-medium">Pesanan</label>
                                                <input type="text" required name="isi_pesanan" id="isi_pesanan" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" value="{{ $p->isi_pesanan }}">
                                            </div>
                                            <div class="w-full mb-2">
                                                <label for="ket_pesanan" class="ms-1 text-slate-300 font-medium">Keterangan</label>
                                                <textarea style="scrollbar-width: none;" name="ket_pesanan"  id="ket_pesanan" class="min-h-20 max-h-28 bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2">{{ $p->ket_pesanan }}</textarea>
                                            </div>
                                            <div class="w-1/3 mb-2">
                                                <label for="waktuPesanan" class="ms-1 text-slate-300 font-medium">Waktu input</label>
                                                <input type="datetime-local" disabled name="waktuPesanan" id="waktuPesanan" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" value="{{ $p->created_at }}">
                                            </div>
                                            <div class="w-1/3 mb-2 ps-2">
                                                <label for="estimasi" class="ms-1 text-slate-300 font-medium">Estimasi selesai</label>
                                                <input type="datetime-local"required name="estimasi" id="estimasi" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" value="{{ $p->estimasi }}">
                                            </div>
                                            <div class="w-1/3 ps-2">
                                                <label for="harga" class="ms-1 text-slate-300 font-medium">Harga</label>
                                                <input type="text" name="harga" id="harga" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" value="{{ $p->harga }}">
                                            </div>
                                            <div class="w-full mb-2">
                                                <label for="status_pesanan" class="ms-1 text-slate-300 font-medium">Status Pesanan</label>
                                                <div class="flex p-2 bg-slate-900 rounded-lg">
                                                    <div class="flex items-center  w-1/4">
                                                        <input id="selesaiPesanan" type="radio" @if($p->status_pesanan == 'Selesai') checked @endif value="Selesai" name="status_pesanan" class="w-4 h-4 text-yellow-700 bg-gray-100 focus:ring-yellow-700 focus:ring-2">
                                                        <label for="selesaiPesanan" class="ms-2 text-sm font-medium text-yellow-700">Selesai</label>
                                                    </div>
                                                    <div class="flex items-center  w-1/4">
                                                        <input id="pendingPesanan" type="radio" @if($p->status_pesanan == 'Pending') checked @endif value="Pending" name="status_pesanan" class="w-4 h-4 text-red-700 bg-gray-100 focus:ring-red-700 focus:ring-2">
                                                        <label for="pendingPesanan" class="ms-2 text-sm font-medium text-red-700 ">Pending</label>
                                                    </div>
                                                    <div class="flex items-center ps-4 w-1/4">
                                                        <input id="prosesPesanan" type="radio" @if($p->status_pesanan == 'Proses') checked @endif value="Proses" name="status_pesanan" class="w-4 h-4 text-blue-700 bg-gray-100 focus:ring-blue-700 focus:ring-2">
                                                        <label for="prosesPesanan" class="ms-2 text-sm font-medium text-blue-700 ">Proses</label>
                                                    </div>
                                                    <div class="flex items-center ps-2  w-1/4">
                                                        <input id="diambilPesanan" type="radio" @if($p->status_pesanan == 'Diambil') checked @endif value="Diambil" name="status_pesanan" class="w-4 h-4 text-green-700 bg-gray-100 focus:ring-green-700 focus:ring-2">
                                                        <label for="diambilPesanan" class="ms-2 text-sm font-medium text-green-700 ">Diambil</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-1/2 mb-2">
                                                <label for="jenis_pembayaran" class="ms-1 text-slate-300 font-medium">Jenis Pembayaran</label>
                                                <div class="flex p-2 bg-slate-900 rounded-lg">
                                                    <div class="flex items-center w-1/2">
                                                        <input id="nonPembayaran" type="radio" @if($p->transaksi_pesanans && $p->transaksi_pesanans->jenis_pembayaran == 'Non Tunai') checked @endif  value="Non Tunai" name="jenis_pembayaran" class="w-4 h-4 text-yellow-700 bg-gray-100 focus:ring-yellow-700 focus:ring-2">
                                                        <label for="nonPembayaran" class="ms-2 text-sm font-medium text-yellow-700 ">Non Tunai</label>
                                                    </div>
                                                    <div class="flex items-center ps-1 w-1/2">
                                                        <input id="tunaiPembayaran" type="radio" @if($p->transaksi_pesanans && $p->transaksi_pesanans->jenis_pembayaran == 'Tunai') checked @endif value="Tunai" name="jenis_pembayaran" class="w-4 h-4 text-red-700 bg-gray-100 focus:ring-red-700 focus:ring-2">
                                                        <label for="tunaiPembayaran" class="ms-2 text-sm font-medium text-red-700 ">Tunai</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-1/2 mb-2 ps-2">
                                                <label for="status_pembayaran" class="ms-1 text-slate-300 font-medium">Status Pembayaran</label>
                                                <div class="flex p-2 bg-slate-900 rounded-lg">
                                                    <div class="flex items-center w-1/2">
                                                        <input id="lunasPembayaran" type="radio" @if($p->transaksi_pesanans && $p->transaksi_pesanans->status_pembayaran == 'Lunas') checked @endif value="Lunas" name="status_pembayaran" class="w-4 h-4 text-yellow-700 bg-gray-100 focus:ring-yellow-700 focus:ring-2">
                                                        <label for="lunasPembayaran" class="ms-2 text-sm font-medium text-yellow-700 ">Lunas</label>
                                                    </div>
                                                    <div class="flex items-center w-1/2">
                                                        <input id="pendingPembayaran" type="radio" @if($p->transaksi_pesanans && $p->transaksi_pesanans->status_pembayaran == 'Pending') checked @endif value="Pending" name="status_pembayaran" class="w-4 h-4 text-red-700 bg-gray-100 focus:ring-red-700 focus:ring-2">
                                                        <label for="pendingPembayaran" class="ms-2 text-sm font-medium text-red-700 ">Pending</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="w-full mb-2">
                                                <label for="ket_transaksi_pesanan" class="ms-1 text-slate-300 font-medium">Keterangan Pembayaran</label>
                                                <input type="text" name="ket_transaksi_pesanan" id="ket_transaksi_pesanan" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2">
                                            </div>
                                        </div>
                                        <div class="w-full p-1 mt-3 flex gap-4 justify-end">
                                            <button type="button" data-modal-target="hapus-pesanan{{ $p->id }}" data-modal-toggle="hapus-pesanan{{ $p->id }}" class="text-white items-center bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                                              <i class="fa-solid fa-trash fa-lg me-2"></i>
                                              Hapus
                                            </button>
                                            <button type="submit" class="text-white items-center bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                                              <i class="fa-solid fa-save fa-lg me-2"></i>
                                              Simpan
                                            </button>
                                        </div>
                                    </form>
                                    <div id="hapus-pesanan{{ $p->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-[calc(100%-1rem)]">
                                        <div class="relative w-full max-w-md max-h-full">
                                            <div class="relative bg-slate-800 p-8 rounded-lg shadow-xl ">
                                                <div class="text-center">
                                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                    </svg>
                                                    <h3 class="mb-5 text-lg font-normal text-gray-300">Data pesanan akan dihapus, anda yakin?</h3>
                                                    <form action="/pesanan-hapus/{{ $p->id }}" method="post" class="inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button data-modal-hide="hapus-pesanan{{ $p->id }}" type="submit" class="text-slate-300 bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5">
                                                            Iya
                                                        </button>
                                                    </form>
                                                    <button data-modal-hide="hapus-pesanan{{ $p->id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-300 bg-slate-700 rounded-lg hover:bg-slate-900 ">Batal</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="flex flex-col items-center">
                  <!-- Help text -->
                  <span class="text-sm text-slate-300 ">
                      Showing <span class="font-semibold text-slate-300 ">1</span> to <span class="font-semibold text-slate-300 ">10</span> of <span class="font-semibold text-slate-300 ">100</span> Entries
                  </span>
                  <div class="inline-flex mt-2 xs:mt-0">
                    <!-- Buttons -->
                    <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white border-2 border-slate-800 rounded-s-md hover:bg-slate-800 ">
                      <p><i class="fa-solid fa-arrow-left me-4"></i>Prev</p>
                    </button>
                    <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white border-2 border-slate-800 rounded-e-md hover:bg-slate-800 ">
                      <p>Next<i class="fa-solid fa-arrow-right ms-4"></i></p>
                    </button>
                  </div>
                </div>
            </div>
          </div>
          <div class="w-1/3 h-5/6 p-2">
            <div class="flex flex-col size-full bg-slate-900 rounded-2xl p-4">
                <p class="font-semibold text-lg text-slate-300">Tambah pesanan</p>
                <div class="h-full">
                    <form action="/pesanan" method="post" class="flex flex-col justify-between">
                        @csrf
                        <div class="flex flex-wrap mt-2 h-full">
                            <div class="w-2/3 mb-2">
                                <label for="nama_pelanggan" class="ms-1 text-slate-300 font-medium">Nama Pelanggan</label>
                                <input type="text" required name="nama_pelanggan" id="nama_pelanggan" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" >
                            </div>
                            <div class="w-1/3 ps-2">
                                <label for="hp_pelanggan" class="ms-1 text-slate-300 font-medium">Nomor HP</label>
                                <input type="text" name="hp_pelanggan" id="hp_pelanggan" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" >
                            </div>
                            <div class="w-full mb-2">
                                <label for="isi_pesanan" class="ms-1 text-slate-300 font-medium">Pesanan</label>
                                <input type="text" required name="isi_pesanan" id="isi_pesanan" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" >
                            </div>
                            <div class="w-full mb-2">
                                <label for="ket_pesanan" class="ms-1 text-slate-300 font-medium">Keterangan</label>
                                <textarea style="scrollbar-width: none;" name="ket_pesanan"  id="ket_pesanan" class="min-h-20 max-h-28 bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2"></textarea>
                            </div>
                            <div class="w-2/3 mb-2">
                                <label for="estimasi" class="ms-1 text-slate-300 font-medium">Estimasi selesai</label>
                                <input type="datetime-local" required name="estimasi" id="estimasi" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" >
                            </div>
                            <div class="w-1/3 ps-2">
                                <label for="harga" class="ms-1 text-slate-300 font-medium">Harga</label>
                                <input type="text" name="harga" id="harga" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" >
                            </div>
                                <label for="status_pesanan" class="ms-1 text-slate-300 font-medium">Status Pesanan</label>
                                <div class="flex justify-between w-full p-2 bg-slate-900 rounded-lg">
                                    <div class="flex items-center">
                                        <input id="selesaiPesanan" type="radio" value="Selesai" name="status_pesanan" class="w-4 h-4 text-yellow-700 bg-gray-100 focus:ring-yellow-700 focus:ring-2">
                                        <label for="selesaiPesanan" class="ms-2 text-sm font-medium text-yellow-700 ">Selesai</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="pendingPesanan" type="radio" value="Pending" name="status_pesanan" class="w-4 h-4 text-red-700 bg-gray-100 focus:ring-red-700 focus:ring-2">
                                        <label for="pendingPesanan" class="ms-2 text-sm font-medium text-red-700 ">Pending</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="prosesPesanan" type="radio" checked value="Proses" name="status_pesanan" class="w-4 h-4 text-blue-700 bg-gray-100 focus:ring-blue-700 focus:ring-2">
                                        <label for="prosesPesanan" class="ms-2 text-sm font-medium text-blue-700 ">Proses</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="diambilPesanan" type="radio" value="Diambil" name="status_pesanan" class="w-4 h-4 text-green-700 bg-gray-100 focus:ring-green-700 focus:ring-2">
                                        <label for="diambilPesanan" class="ms-2 text-sm font-medium text-green-700 ">Diambil</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full p-1 mt-3 flex justify-center">
                            <button type="submit" class="text-white items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                              <i class="fa-solid fa-plus fa-lg me-2"></i>
                              Tambah
                            </button>
                        </div>
                    </form>
                </div>
            </div>
          </div>
        </div>
        <!-- Content -->
      </div>
      <!-- Container -->
    </div>
  </body>
</html>
