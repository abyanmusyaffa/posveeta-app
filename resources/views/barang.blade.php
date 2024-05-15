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
    <title>Posveeta | Barang</title>
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

          <a href="/barang" class="flex items-center w-full py-4 px-6 mb-4 rounded-xl bg-slate-900 text-slate-400 hover:text-slate-300 hover:bg-slate-900 hover:font-semibold transition-all">
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
          <div class="w-3/12 h-1/6 p-2">
            <div class="flex items-center justify-center gap-4 size-full bg-slate-900 rounded-2xl p-4 px-8">
                <p class="w-2/3 text-center text-blue-600 text-6xl font-semibold">{{ $barang_today }}</p>
                <p class=" text-slate-300 text-xl">Barang terjual hari ini</p>
            </div>
          </div>
          <div class="w-3/12 h-1/6 p-2">
            <div class="flex items-center justify-center gap-4 size-full bg-slate-900 rounded-2xl p-4 px-8">
                <p class="w-2/3 text-center text-orange-500 text-6xl font-semibold">{{ $total_barang }}</p>
                <p class="text-slate-300 text-xl">Total barang</p>
            </div>
          </div>
          <div class="w-3/12 h-1/6 p-2">
            <div class="flex items-center justify-center gap-4 size-full bg-slate-900 rounded-2xl p-4 px-8">
                <p class="w-2/3 text-center text-yellow-400 text-6xl font-semibold">{{ $barang_tersedia }}</p>
                <p class="text-slate-300 text-xl">Barang Tersedia</p>
            </div>
          </div>
          <div class="w-3/12 h-1/6 p-2">
            <div class="flex items-center justify-center gap-4 size-full bg-slate-900 rounded-2xl p-4 px-8">
                <p class="w-2/3 text-center text-red-900 text-6xl font-semibold">{{ $barang_tidak_tersedia }}</p>
                <p class="text-slate-300 text-xl">Barang tidak tersedia</p>
            </div>
          </div>
          <div class="w-full h-5/6 p-2">
            <div class="flex flex-col size-full bg-slate-900 rounded-2xl p-4">
                <div class="flex items-start justify-between">
                    <p class="font-semibold text-lg text-slate-300">Daftar Barang</p>
                    <button type="button" data-modal-target="tambah-barang" data-modal-toggle="tambah-barang" class="text-sm text-slate-300 px-4 py-1 rounded-lg bg-slate-800 hover:bg-slate-950"><i class="fa-solid fa-plus me-2"></i>Tambah barang</button>  
                </div>
                <div class="h-full">
                  <table class="text-sm w-full text-slate-400 mt-4 ">
                      <tr class="bg-slate-800">
                        <th class="w-1/12 py-2 rounded-s-xl">ID</th>
                        <th class="w-3/12 ">Nama Barang</th>
                        <th class="w-2/12 ">Kategori</th>
                        <th class="w-2/12 ">Satuan</th>
                        <th class="w-2/12 ">Harga</th>
                        <th class="w-1/12 ">Stok</th>
                        <th class="w-1/12  rounded-e-xl"></th>
                      </tr>
                      @foreach($barangs as $b)
                      <tr class="text-center border-b border-slate-800">
                        <td class="p-2">{{ $b->id }}</td>
                        <td >{{ $b->nama_barang }}</td>
                        <td >{{ $b->kategori }}</td>
                        <td >{{ $b->satuan }}</td>
                        <td >IDR {{ number_format($b->harga, 0, ',', '.') }}</td>
                        <td >{{ $b->stok }}</td>
                        <td >
                          <button class="bg-slate-800 py-0.5 px-3 rounded-lg" id="dropdownMenuIconButton" data-dropdown-toggle="dropdown-barang{{ $b->id }}" data-dropdown-placement="bottom-end" type="button"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                          <div id="dropdown-barang{{ $b->id }}" class="z-10 p-1.5 hidden bg-slate-800 rounded-lg w-32">
                              <ul class="text-sm text-slate-300" aria-labelledby="dropdownMenuIconButton">
                                <li class="mb-1">
                                  <button type="button" data-modal-target="edit-barang{{ $b->id }}" data-modal-toggle="edit-barang{{ $b->id }}" class="block w-full ps-6 text-start py-1 rounded-md bg-slate-900 hover:bg-slate-700"><i class="fa-solid fa-pen me-4"></i>Edit</button>
                                </li>
                                <li>
                                  <button type="button" data-modal-target="hapus-barang{{ $b->id }}" data-modal-toggle="hapus-barang{{ $b->id }}" class="block w-full ps-6 text-start py-1 rounded-md bg-slate-900 hover:bg-slate-700"><i class="fa-solid fa-xmark me-4"></i>Hapus</button>
                                </li>
                              </ul>
                          </div>
                        </td>
                      </tr>
                      <div id="edit-barang{{ $b->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-[calc(100%-1rem)]">
                        <div class="relative w-full max-w-md max-h-full">
                          <!-- Modal content -->
                          <div class="relative p-4 bg-slate-800 rounded-lg shadow">
                              <!-- Modal header -->
                              <div class="flex items-center p-2 justify-between border-b border-slate-900 rounded-t">
                                  <h3 class="text-lg font-semibold text-slate-300 ">
                                      Edit Data Barang
                                  </h3>
                                  <button type="button" class="text-gray-400 hover:bg-slate-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-toggle="edit-barang{{ $b->id }}">
                                      <i class="fa-solid fa-xmark fa-xl"></i>
                                  </button>
                              </div>
                              <!-- Modal body -->
                              <form action="/barang-edit" method="post" class="p-2">
                                @csrf
                                <input type="text" name="id" value="{{ $b->id }}" hidden>
                                <div class="flex flex-wrap">
                                  <div class="w-full p-1">
                                    <label for="nama_barang" class="mb-1 ms-1 text-slate-300 font-medium">Nama Barang</label>
                                    <input type="text" name="nama_barang" id="nama_barang" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" value="{{ $b->nama_barang }}">
                                  </div>
                                  <div class="w-2/3 p-1">
                                    <label for="kategori" class="mb-1 ms-1 text-slate-300 font-medium">Kategori</label>
                                    <select name="kategori" id="kategori" class="bg-slate-800 border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" required="">
                                        <option value="{{ $b->kategori }}" selected hidden>{{ $b->kategori }}</option>
                                        <option value="Alat Tulis">Alat Tulis</option>
                                        <option value="Buku">Buku</option>
                                    </select>
                                  </div>
                                  <div class="w-1/3 p-1">
                                    <label for="satuan" class="mb-1 ms-1 text-slate-300 font-medium">Satuan</label>
                                    <select name="satuan" id="satuan" class="bg-slate-800 border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" required="">
                                        <option value="{{ $b->satuan }}" selected hidden>{{ $b->satuan }}</option>
                                        <option value="pcs">pcs</option>
                                        <option value="box">box</option>
                                        <option value="lusin">lusin</option>
                                    </select>
                                  </div>
                                  <div class="w-2/3 p-1">
                                    <label for="harga" class="mb-1 ms-1 text-slate-300 font-medium">Harga Barang</label>
                                    <input type="text" name="harga" id="harga" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" value="{{ $b->harga }}"">
                                  </div>
                                  <div class="w-1/3 p-1">
                                    <label for="stok" class="mb-1 ms-1 text-slate-300 font-medium">Stok</label>
                                    <input type="number" name="stok" id="stok" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" value="{{ $b->stok }}"">
                                  </div>
                                  <div class="w-1/2 p-1">
                                    <label for="created_at" class="mb-1 ms-1 text-slate-300 font-medium">Waktu input</label>
                                    <input type="datetime-local" disabled name="created_at" id="created_at" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" value="{{ $b->created_at }}"">
                                  </div>
                                  <div class="w-1/2 p-1">
                                    <label for="updated_at" class="mb-1 ms-1 text-slate-300 font-medium">Update terakhir</label>
                                    <input type="datetime-local" disabled name="updated_at" id="updated_at" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" value="{{ $b->updated_at}}"">
                                  </div>
                                  <div class="w-full p-1 mt-3 flex justify-end">
                                    <button type="submit" class="text-white items-center bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                                      <i class="fa-solid fa-save fa-lg me-2"></i>
                                      Simpan
                                    </button>
                                  </div>
                                </div>
                              </form>
                          </div>
                        </div>
                      </div>
                      <div id="hapus-barang{{ $b->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-[calc(100%-1rem)]">
                        <div class="relative w-full max-w-md max-h-full">
                            <div class="relative bg-slate-800 p-8 rounded-lg shadow-xl ">
                                <div class="text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-gray-300">Data barang akan dihapus, anda yakin?</h3>
                                    {{-- <a href="/barang-hapus/{{ $b->id }}" data-modal-hide="hapus-barang{{ $b->id }}" type="button" class="text-slate-300 bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5">
                                        Iya
                                    </a> --}}
                                    <form action="/barang-hapus/{{ $b->id }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button name="hapus" data-modal-hide="hapus-barang{{ $b->id }}" type="submit" class="text-slate-300 bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5">
                                        Iya
                                    </button>
                                    </form>
                                    <button data-modal-hide="hapus-barang{{ $b->id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-300 bg-slate-700 rounded-lg hover:bg-slate-900 ">Batal</button>
                                </div>
                            </div>
                        </div>
                      </div>
                      @endforeach
                  </table>
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
        </div>
        <!-- Content -->
      </div>
      <!-- Container -->
    </div>

    <!-- Main modal -->
    <div id="tambah-barang" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full  h-[calc(100%-1rem)]">
      <div class="relative p-4 w-full max-w-md max-h-full">
          <!-- Modal content -->
          <div class="relative bg-slate-800 rounded-lg shadow">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 border-b border-slate-900 rounded-t">
                  <h3 class="text-lg font-semibold text-slate-300 ">
                      Tambah Data Barang
                  </h3>
                  <button type="button" class="text-gray-400 hover:bg-slate-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-toggle="tambah-barang">
                      <i class="fa-solid fa-xmark fa-xl"></i>
                  </button>
              </div>
              <!-- Modal body -->
              <form action="/barang" method="post" class="p-4">
                @csrf
                <div class="flex flex-wrap">
                  <div class="w-full p-1">
                    <label for="nama_barang" class="mb-1 ms-1 text-slate-300 font-medium">Nama Barang</label>
                    <input type="text" name="nama_barang" id="nama_barang" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" required>
                  </div>
                  <div class="w-2/3 p-1">
                    <label for="kategori" class="mb-1 ms-1 text-slate-300 font-medium">Kategori</label>
                    <select name="kategori" id="kategori" class="bg-slate-800 border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2">
                      <option value="Alat Tulis">Alat Tulis</option>
                      <option value="Buku">Buku</option>
                    </select>
                  </div>
                  <div class="w-1/3 p-1">
                    <label for="satuan" class="mb-1 ms-1 text-slate-300 font-medium">Satuan</label>
                    <select name="satuan" id="satuan" class="bg-slate-800 border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2">
                      <option value="pcs">pcs</option>
                      <option value="box">box</option>
                      <option value="lusin">lusin</option>
                    </select>
                  </div>
                  <div class="w-2/3 p-1">
                    <label for="harga" class="mb-1 ms-1 text-slate-300 font-medium">Harga Barang</label>
                    <input type="text" name="harga" id="harga" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" required>
                  </div>
                  <div class="w-1/3 p-1">
                    <label for="stok" class="mb-1 ms-1 text-slate-300 font-medium">Stok</label>
                    <input type="number" name="stok" id="stok" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" required>
                  </div>
                  <div class="w-full p-1 mt-3 flex justify-end">
                    <button type="submit" class="text-white items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                      <i class="fa-solid fa-plus fa-lg me-2"></i>
                      Tambah
                    </button>
                  </div>
                </div>
              </form>
          </div>
      </div>
    </div>
    
    <!-- Main modal -->
    {{-- <div id="edit-barang" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-[calc(100%-1rem)]">
      <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-slate-800 rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b border-slate-900 rounded-t">
                <h3 class="text-lg font-semibold text-slate-300 ">
                    Edit Data Barang
                </h3>
                <button type="button" class="text-gray-400 hover:bg-slate-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center " data-modal-toggle="edit-barang">
                    <i class="fa-solid fa-xmark fa-xl"></i>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4">
              <div class="flex flex-wrap">
                <div class="w-full p-1">
                  <label for="namaBarang" class="mb-1 ms-1 text-slate-300 font-medium">Nama Barang</label>
                  <input type="text" name="namaBarang" id="namaBarang" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" required="">
                </div>
                <div class="w-2/3 p-1">
                  <label for="kategoriBarang" class="mb-1 ms-1 text-slate-300 font-medium">Kategori</label>
                  <select name="kategoriBarang" id="kategoriBarang" class="bg-slate-800 border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" required="">
                    <option value="Alat Tulis">Alat Tulis</option>
                    <option value="Buku">Buku</option>
                  </select>
                </div>
                <div class="w-1/3 p-1">
                  <label for="satuanBarang" class="mb-1 ms-1 text-slate-300 font-medium">Satuan</label>
                  <select name="satuanBarang" id="satuanBarang" class="bg-slate-800 border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" required="">
                    <option value="pcs">pcs</option>
                    <option value="box">box</option>
                    <option value="lusin">lusin</option>
                  </select>
                </div>
                <div class="w-2/3 p-1">
                  <label for="hargaBarang" class="mb-1 ms-1 text-slate-300 font-medium">Harga Barang</label>
                  <input type="text" name="hargaBarang" id="hargaBarang" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" required="">
                </div>
                <div class="w-1/3 p-1">
                  <label for="stokBarang" class="mb-1 ms-1 text-slate-300 font-medium">Stok</label>
                  <input type="number" name="stokBarang" id="stokBarang" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" required="">
                </div>
                <div class="w-1/2 p-1">
                  <label for="waktuBarang" class="mb-1 ms-1 text-slate-300 font-medium">Waktu input</label>
                  <input type="datetime-local" disabled name="waktuBarang" id="waktuBarang" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" required="">
                </div>
                <div class="w-1/2 p-1">
                  <label for="updateBarang" class="mb-1 ms-1 text-slate-300 font-medium">Update terakhir</label>
                  <input type="datetime-local" disabled name="updateBarang" id="updateBarang" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" required="">
                </div>
                <div class="w-full p-1 mt-3 flex justify-end">
                  <button type="submit" class="text-white items-center bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                    <i class="fa-solid fa-save fa-lg me-2"></i>
                    Simpan
                  </button>
                </div>
              </div>
            </form>
        </div>
      </div>
    </div> --}}
  </body>
</html>
