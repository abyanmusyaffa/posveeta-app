
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
    
    <title>Posveeta | Transaksi</title>
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

          <a href="/pesanan" class="flex items-center w-full py-4 px-6 mb-4 rounded-xl text-slate-300 hover:bg-slate-900 hover:font-semibold transition-all">
            <i class="fa-solid fa-clipboard-list fa-lg fa-fw me-6"></i>
            <p>Pesanan</p>
          </a>

          <a href="/transaksi" class="flex items-center w-full py-4 px-6 mb-4 rounded-xl text-slate-400 bg-slate-900 hover:bg-slate-900 hover:font-semibold transition-all">
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
        <div class="w-full h-full p-2 flex">
          <div class="w-10/12 h-full p-2">
            <div class="flex flex-col size-full bg-slate-900 rounded-2xl p-4">
              <p class="font-semibold text-lg text-slate-300">Riwayat Transaksi</p>
              <div class="mt-4 mb-2">
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
                  <div class="h-full flex flex-col">
                    <div class="flex py-2 text-slate-300 font-semibold text-sm border-b border-slate-800">
                      <p class="w-2/12 text-center">INV</p>
                      <p class="w-3/12 text-center">Waktu</p>
                      <p class="w-2/12 text-center">Total Harga</p>
                      <p class="w-3/12 text-center">Pembayaran</p>
                      <p class="w-2/12 text-center">Status</p>
                    </div>
                    @foreach($transaksi_penjualans as $tpe)
                      <button type="button" data-modal-target="detail-transaksi-penjualan{{ $tpe->id }}" data-modal-toggle="detail-transaksi-penjualan{{ $tpe->id }}">
                        <div class="flex py-2 text-slate-300 text-sm border-b border-slate-800 hover:bg-slate-800">
                          <p class="w-2/12 text-center">#{{ $tpe->id }}</p>
                          <p class="w-3/12 text-center">{{ (new DateTime($tpe->created_at))->format('d-M-Y H:i') }}</p>
                          <p class="w-2/12 text-center">IDR {{ number_format($tpe->total_harga, 0, ',', '.') }}</p>
                          <p class="w-3/12 text-center">{{ $tpe->jenis_pembayaran }}</p>
                          <p class="w-2/12 text-center 
                            @if($tpe->status_pembayaran == 'Pending')
                            text-red-700
                            @else
                             text-blue-700
                            @endif">
                            @if($tpe->status_pembayaran == 'Pending')
                              <i class="fa-solid fa-clock fa-fw me-2"></i>{{ $tpe->status_pembayaran }}</p>
                            @else
                              <i class="fa-solid fa-circle-check fa-fw me-2"></i>{{ $tpe->status_pembayaran }}</p>
                            @endif
                        </div>
                      </button>
                      <div id="detail-transaksi-penjualan{{ $tpe->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-[calc(100%-1rem)]">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                          <!-- Modal content -->
                          <div class="relative bg-slate-800 rounded-lg shadow">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 border-b border-slate-900 rounded-t">
                              <h3 class="text-xl font-semibold text-slate-300">Detail transaksi</h3>
                              <button type="button" class="text-gray-400 hover:bg-slate-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="detail-transaksi-penjualan{{ $tpe->id }}">
                                <i class="fa-solid fa-xmark fa-xl"></i>
                              </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4">
                              <form action="/tpe-edit" method="post">
                                @csrf
                                <input type="text" name="id" value="{{ $tpe->id }}" hidden>
                                <div class="flex flex-wrap mt-4">
                                  <table class="w-full text-slate-300 text-sm text-center mb-2">
                                    <tr class="bg-slate-900">
                                      <th class="w-2/3 py-2 rounded-ss-lg">Nama Barang</th>
                                      <th class="w-1/3 rounded-se-lg">Harga</th>
                                    </tr>
                                    @foreach($tpe->penjualans as $tpep)
                                      <tr>
                                          @if($tpep->barangs)
                                              <td class="py-1">{{ $tpep->barangs->nama_barang }}</td>
                                              <td>{{ number_format($tpep->barangs->harga, 0, ',', '.') }}</td>
                                          @else
                                              <td class="py-1 text-xs">barang tidak ditemukan</td>
                                              <td>-</td>
                                          @endif
                                      </tr>
                                    @endforeach
                                    <tr class="border-t border-slate-700">
                                      <th>Total Harga</th>
                                      <th>{{ number_format($tpe->total_harga, 0, ',', '.') }}</th>
                                    </tr>
                                  </table>
                                  <div class="w-2/3 mb-2">
                                    <label for="nama_pelanggan" class="ms-1 text-slate-300 font-medium">Nama Pelanggan</label>
                                    <input type="text" value="{{ $tpe->nama_pelanggan }}" name="nama_pelanggan" id="nama_pelanggan" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" />
                                  </div>
                                  <div class="w-1/3 ps-2">
                                    <label for="hp_pelanggan" class="ms-1 text-slate-300 font-medium">Nomor HP</label>
                                    <input type="text" value="{{ $tpe->hp_pelanggan }}" name="hp_pelanggan" id="hp_pelanggan" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" />
                                  </div>
                                  <div class="w-1/2 mb-2">
                                    <label for="jenis_pembayaran" class="ms-1 text-slate-300 font-medium">Jenis Pembayaran</label>
                                    <div class="flex p-2 bg-slate-900 rounded-lg">
                                      <div class="flex items-center w-1/2">
                                        <input id="nonPembayaran" type="radio" @if($tpe->jenis_pembayaran == 'Non Tunai') checked @endif value="Non Tunai" name="jenis_pembayaran" class="w-4 h-4 text-yellow-700 bg-gray-100 focus:ring-yellow-700 focus:ring-2" />
                                        <label for="nonPembayaran" class="ms-2 text-sm font-medium text-yellow-700">Non Tunai</label>
                                      </div>
                                      <div class="flex items-center ps-3 w-1/2">
                                        <input id="tunaiPembayaran" type="radio" @if($tpe->jenis_pembayaran == 'Tunai') checked @endif value="Tunai" name="jenis_pembayaran" class="w-4 h-4 text-red-700 bg-gray-100 focus:ring-red-700 focus:ring-2" />
                                        <label for="tunaiPembayaran" class="ms-2 text-sm font-medium text-red-700">Tunai</label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="w-1/2 mb-2 ps-2">
                                    <label for="status_pembayaran" class="ms-1 text-slate-300 font-medium">Status Pembayaran</label>
                                    <div class="flex p-2 items-center bg-slate-900 rounded-lg">
                                      <div class="flex w-1/2">
                                        <input id="lunasPembayaran" type="radio" @if($tpe->status_pembayaran == 'Lunas') checked @endif value="Lunas" name="status_pembayaran" class="w-4 h-4 text-yellow-700 bg-gray-100 focus:ring-yellow-700 focus:ring-2" />
                                        <label for="lunasPembayaran" class="ms-2 text-sm font-medium text-yellow-700">Lunas</label>
                                      </div>
                                      <div class="flex items-center w-1/2">
                                        <input id="pendingPembayaran" type="radio" @if($tpe->status_pembayaran == 'Pending') checked @endif value="Pending" name="status_pembayaran" class="w-4 h-4 text-red-700 bg-gray-100 focus:ring-red-700 focus:ring-2" />
                                        <label for="pendingPembayaran" class="ms-2 text-sm font-medium text-red-700">Pending</label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="w-full mb-2">
                                    <label for="ket_transaksi_penjualan" class="ms-1 text-slate-300 font-medium">Keterangan Pembayaran</label>
                                    <input type="text" value="{{ $tpe->ket_transaksi_penjualan }}" name="ket_transaksi_penjualan" id="ket_transaksi_penjualan" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2"  />
                                  </div>
                                </div>
                                <div class="w-full p-1 mt-3 flex gap-4 justify-end">
                                  <button type="button" data-modal-target="hapus-tpe{{ $tpe->id }}" data-modal-toggle="hapus-tpe{{ $tpe->id }}" class="text-white items-center bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                                    <i class="fa-solid fa-trash fa-lg me-2"></i>
                                    Hapus
                                  </button>
                                  <button type="submit" class="text-white items-center bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    <i class="fa-solid fa-save fa-lg me-2"></i>
                                    Simpan
                                  </button>
                                </div>
                              </form>
                              <div id="hapus-tpe{{ $tpe->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-[calc(100%-1rem)]">
                                <div class="relative w-full max-w-md max-h-full">
                                    <div class="relative bg-slate-800 p-8 rounded-lg shadow-xl ">
                                        <div class="text-center">
                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-300">Data transaki penjualan akan dihapus, anda yakin?</h3>
                                            <form action="/tpe-hapus/{{ $tpe->id }}" method="post" class="inline">
                                              @csrf
                                              @method('delete')
                                              <button data-modal-hide="hapus-tpe{{ $tpe->id }}" type="submit" class="text-slate-300 bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5">
                                                Iya
                                              </button>
                                            </form>
                                            <button data-modal-hide="hapus-tpe{{ $tpe->id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-300 bg-slate-700 rounded-lg hover:bg-slate-900 ">Batal</button>
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
                </div>
                <div class="hidden" id="pesanan" role="tabpanel" aria-labelledby="pesanan-tab">
                  <div class="h-full flex flex-col">
                    <div class="flex py-2 text-slate-300 font-semibold text-sm border-b border-slate-800">
                      <p class="w-2/12 text-center">INV</p>
                      <p class="w-2/12 text-center">Nama Pelanggan</p>
                      <p class="w-2/12 text-center">Pesanan</p>
                      <p class="w-2/12 text-center">Waktu</p>
                      <p class="w-1/12 text-center">Harga</p>
                      <p class="w-2/12 text-center">Pembayaran</p>
                      <p class="w-1/12 text-center">Status</p>
                    </div>
                    @foreach($transaksi_pesanans as $tp)
                      <button type="button" data-modal-target="detail-transaksi{{ $tp->id }}" data-modal-toggle="detail-transaksi{{ $tp->id }}">
                        <div class="flex py-2 text-slate-300 text-sm border-b border-slate-800 hover:bg-slate-800">
                          <p class="w-2/12 text-center">#{{ $tp->id }}</p>
                          <p class="w-2/12 text-center">{{ $tp->pesanans->nama_pelanggan }}</p>
                          <p class="w-2/12 text-center">{{ $tp->pesanans->isi_pesanan }}</p>
                          <p class="w-2/12 text-center">{{ (new DateTime($tp->created_at))->format('d-M-Y H:i') }}</p>
                          <p class="w-1/12 text-center">IDR {{ number_format($tp->pesanans->harga, 0, ',', '.') }}</p>
                          <p class="w-2/12 text-center">{{ $tp->jenis_pembayaran }}</p>
                          <p class="w-1/12 text-center 
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
                        </div>
                      </button>
                      <div id="detail-transaksi{{ $tp->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-[calc(100%-1rem)]">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                          <!-- Modal content -->
                          <div class="relative bg-slate-800 rounded-lg shadow">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 border-b border-slate-900 rounded-t">
                              <h3 class="text-xl font-semibold text-slate-300">Detail transaksi</h3>
                              <button type="button" class="text-gray-400 hover:bg-slate-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="detail-transaksi{{ $tp->id }}">
                                <i class="fa-solid fa-xmark fa-xl"></i>
                              </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4">
                              <form action="/tp-edit" method="post">
                                @csrf
                                <div class="flex flex-wrap">
                                  <div class="w-1/2 mb-2">
                                    <label for="id" class="ms-1 text-slate-300 font-medium">INV</label>
                                    <input type="text" value="{{ $tp->id }}" readonly name="id" id="id" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" />
                                  </div>
                                  <div class="w-1/2 mb-2 ps-2">
                                    <label for="pesanans_id" class="ms-1 text-slate-300 font-medium">ID Pesanan</label>
                                    <input type="text" value="{{ $tp->pesanans->id }}" disabled name="pesanans_id" id="pesanans_id" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" />
                                  </div>
                                  <div class="w-2/3 mb-2">
                                    <label for="nama_pelanggan" class="ms-1 text-slate-300 font-medium">Nama Pelanggan</label>
                                    <input type="text" value="{{ $tp->pesanans->nama_pelanggan }}" disabled name="nama_pelanggan" id="nama_pelanggan" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" />
                                  </div>
                                  <div class="w-1/3 ps-2">
                                    <label for="hp_pelanggan" class="ms-1 text-slate-300 font-medium">Nomor HP</label>
                                    <input type="text" value="{{ $tp->pesanans->hp_pelanggan }}" disabled name="hp_pelanggan" id="hp_pelanggan" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" />
                                  </div>
                                  <div class="w-full mb-2">
                                    <label for="isi_pesanan" class="ms-1 text-slate-300 font-medium">Pesanan</label>
                                    <input type="text" value="{{ $tp->pesanans->isi_pesanan }}" disabled name="isi_pesanan" id="isi_pesanan" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" />
                                  </div>
                                  <div class="w-1/3 mb-2">
                                    <label for="created_at" class="ms-1 text-slate-300 font-medium">Waktu transaksi</label>
                                    <input
                                      type="datetime-local" value="{{ $tp->created_at }}"
                                      disabled
                                      name="created_at"
                                      id="created_at"
                                      class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2"
                                    
                                    />
                                  </div>
                                  <div class="w-1/3 ps-2">
                                    <label for="updated_at" class="ms-1 text-slate-300 font-medium">Waktu update</label>
                                    <input
                                      type="datetime-local" value="{{ $tp->updated_at }}"
                                      disabled
                                      name="updated_at"
                                      id="updated_at"
                                      class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2"
                                    />
                                  </div>
                                  <div class="w-1/3 ps-2">
                                    <label for="harga" class="ms-1 text-slate-300 font-medium">Harga</label>
                                    <input type="text" value="{{ $tp->pesanans->harga }}" disabled name="harga" id="harga" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" />
                                  </div>
                                  <div class="w-1/2 mb-2">
                                    <label for="jenis_pembayaran" class="ms-1 text-slate-300 font-medium">Jenis Pembayaran</label>
                                    <div class="flex p-2 bg-slate-900 rounded-lg">
                                      <div class="flex items-center w-1/2">
                                        <input id="nonPembayaran" type="radio" @if($tp->jenis_pembayaran == 'Non Tunai') checked @endif value="Non Tunai" name="jenis_pembayaran" class="w-4 h-4 text-yellow-700 bg-gray-100 focus:ring-yellow-700 focus:ring-2" />
                                        <label for="nonPembayaran" class="ms-2 text-sm font-medium text-yellow-700">Non-Tunai</label>
                                      </div>
                                      <div class="flex items-center ps-1 w-1/2">
                                        <input id="tunaiPembayaran" type="radio" @if($tp->jenis_pembayaran == 'Tunai') checked @endif value="Tunai" name="jenis_pembayaran" class="w-4 h-4 text-red-700 bg-gray-100 focus:ring-red-700 focus:ring-2" />
                                        <label for="tunaiPembayaran" class="ms-2 text-sm font-medium text-red-700">Tunai</label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="w-1/2 mb-2 ps-2">
                                    <label for="status_pembayaran" class="ms-1 text-slate-300 font-medium">Status Pembayaran</label>
                                    <div class="flex p-2 bg-slate-900 rounded-lg">
                                      <div class="flex items-center w-1/2">
                                        <input id="lunasPembayaran" type="radio" @if($tp->status_pembayaran == 'Lunas') checked @endif value="Lunas" name="status_pembayaran" class="w-4 h-4 text-yellow-700 bg-gray-100 focus:ring-yellow-700 focus:ring-2" />
                                        <label for="lunasPembayaran" class="ms-2 text-sm font-medium text-yellow-700">Lunas</label>
                                      </div>
                                      <div class="flex items-center w-1/2">
                                        <input id="pendingPembayaran" type="radio" @if($tp->status_pembayaran == 'Pending') checked @endif value="Pending" name="status_pembayaran" class="w-4 h-4 text-red-700 bg-gray-100 focus:ring-red-700 focus:ring-2" />
                                        <label for="pendingPembayaran" class="ms-2 text-sm font-medium text-red-700">Pending</label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="w-full mb-2">
                                    <label for="ket_transaksi_pesanan" class="ms-1 text-slate-300 font-medium">Keterangan Pembayaran</label>
                                    <input type="text" value="{{ $tp->ket_transaksi_pesanan }}" name="ket_transaksi_pesanan" id="ket_transaksi_pesanan" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" />
                                  </div>
                                </div>
                                <div class="w-full p-1 mt-3 flex gap-4 justify-end">
                                  <button type="button" data-modal-target="hapus-tp{{ $tp->id }}" data-modal-toggle="hapus-tp{{ $tp->id }}" class="text-white items-center bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                                    <i class="fa-solid fa-trash fa-lg me-2"></i>
                                    Hapus
                                  </button>
                                  <button type="submit" class="text-white items-center bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    <i class="fa-solid fa-save fa-lg me-2"></i>
                                    Simpan
                                  </button>
                                </div>
                              </form>
                              <div id="hapus-tp{{ $tp->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-[calc(100%-1rem)]">
                                <div class="relative w-full max-w-md max-h-full">
                                    <div class="relative bg-slate-800 p-8 rounded-lg shadow-xl ">
                                        <div class="text-center">
                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                            </svg>
                                            <h3 class="mb-5 text-lg font-normal text-gray-300">Data transaki pesanan dan pesanan akan dihapus, anda yakin?</h3>
                                            <form action="/tp-hapus/{{ $tp->id }}/{{ $tp->pesanans->id }}" method="post" class="inline">
                                              @csrf
                                              @method('delete')
                                              <button data-modal-hide="hapus-tp{{ $tp->id }}" type="submit" class="text-slate-300 bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5">
                                                  Iya
                                              </button>
                                            </form>
                                            <button data-modal-hide="hapus-tp{{ $tp->id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-300 bg-slate-700 rounded-lg hover:bg-slate-900 ">Batal</button>
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
                </div>
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
          <div class="w-2/12 h-full gap-4 p-2 flex flex-col">
            <div class="flex flex-col justify-center items-center w-full gap-2 h-1/3 bg-slate-900 rounded-2xl p-4">
              <p class="text-5xl font-semibold text-blue-700">{{ $transaksi_today }}</p>
              <p class="text-lg text-center text-blue-700">Transaksi hari ini</p>
              <div class="flex justify-around w-full">
                <div class="text-center">
                  <p class="text-xl font-semibold text-orange-700">{{ $transaksi_pending_today }}</p>
                  <p class="text-center text-orange-700">Pending</p>
                </div>
                <div class="text-center">
                  <p class="text-xl font-semibold text-yellow-500">{{ $transaksi_lunas_today }}</p>
                  <p class="text-center text-yellow-500">Lunas</p>
                </div>
              </div>
            </div>
            <div class="flex flex-col justify-center items-center w-full gap-2 h-1/3 bg-slate-900 rounded-2xl p-4">
              <p class="text-6xl font-semibold text-orange-700">{{ $transaksi_pending }}</p>
              <p class="text-xl text-center text-orange-700">Transaksi pending</p>
            </div>
            <div class="flex flex-col justify-center items-center w-full gap-2 h-1/3 bg-slate-900 rounded-2xl p-4">
              <p class="text-6xl font-semibold text-yellow-500">{{ $transaksi_lunas }}</p>
              <p class="text-xl text-center text-yellow-500">Transaksi lunas</p>
            </div>
          </div>
        </div>
        <!-- Content -->
      </div>
      <!-- Container -->
    </div>

  </body>
</html>
