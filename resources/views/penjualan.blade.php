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
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <title>Posveeta| Penjualan</title>
  </head>
  <body style="font-family: 'Poppins'">
    <div class="w-screen h-svh flex bg-slate-950">
      <!-- Sidebar -->
      <div class="w-2/12 p-4">
        <img src="img/pos2.svg" class="w-2/3 mx-auto" alt="" />
        <div class="w-full mt-6">
          <div class="flex mx-2 mb-4 w-auto bg-slate-900 h-0.5"></div>
          <a href="/" class="flex items-center w-full py-4 px-6 mb-4 rounded-xl text-slate-300 hover:bg-slate-900 hover:font-semibold transition-all">
            <i class="fa-solid fa-home fa-lg fa-fw me-6"></i>
            <p>Dashboard</p>
          </a>

          <a href="/penjualan" class="flex items-center w-full py-4 px-6 mb-4 bg-slate-900 rounded-xl text-slate-400 hover:text-slate-300 hover:font-semibold transition-all">
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
          <div class="w-2/3 h-full p-2">
            <div class="flex flex-col size-full bg-slate-900 rounded-2xl p-4">
              <p class="font-semibold text-lg text-slate-300">Daftar barang</p>
              <form action="/penjualan-proses" method="post" class="flex flex-col h-full">
                @csrf
                <div class="h-full" id="wrapper">
                  <div class="flex mt-4 gap-4">
                    <select name="inputs[0]" class="bg-slate-800 border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" required="">
                        @foreach($barangs->where('stok', '>', 0) as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_barang }}</option>
                        @endforeach
                    </select>
                    <button type="button" name="add" id="add" class="w-60 px-2 border-2 rounded-lg text-slate-600 border-slate-800 hover:bg-slate-800 hover:text-slate-300 transition-all">Tambah Kolom</button>
                  </div>
                </div>
                <div class="w-full p-1 mt-3 flex justify-end">
                  <button type="submit" class="text-white items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Proses
                    <i class="fa-solid fa-circle-right fa-lg ms-2"></i>
                  </button>
                </div>
              </form>
            </div>
          </div>
          <div class="w-1/3 h-full p-2">
            <div class="flex flex-col size-full bg-slate-900 rounded-2xl p-4">
                <p class="font-semibold text-lg text-slate-300">Konfirmasi</p>
                <form action="/penjualan" method="post" class="flex flex-col h-full justify-between">
                    @csrf
                    <div class="flex flex-wrap mt-4 ">
                        <table class="w-full text-slate-300 text-sm text-center mb-2">
                            <tr class="bg-slate-800">
                                <th class="w-2/3 py-2 rounded-ss-lg">Nama Barang</th>
                                <th class="w-1/3 rounded-se-lg">Harga</th>
                            </tr>
                            @if(isset($confirm) && $confirm) 
                                @php 
                                    $i=0;
                                @endphp
                                @foreach($confirm as $c)
                                <input type="text" name="inputs[{{ $i }}]" hidden value="{{ $c->id }}">
                                <tr>
                                    <td class="py-1">{{ $c->nama_barang }}</td>
                                    <td>{{ number_format($c->harga, 0, ',', '.') }}</td>
                                </tr>
                                @php 
                                    $i++;
                                @endphp
                                @endforeach
                            @else
                                <tr>
                                    <td class="py-6" colspan="2">belum ada barang</td>
                                </tr>
                            @endif

                            <tr class="border-t border-slate-700">
                                <th>Total Harga</th>
                                <th>@if(isset($total_harga)){{ number_format($total_harga, 0, ',', '.') }}@else   @endif</th>
                            </tr>
                        </table>
                        <div class="w-2/3 mb-2">
                            <label for="nama_pelanggan" class="ms-1 text-slate-300 font-medium">Nama Pelanggan</label>
                            <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" >
                        </div>
                        <div class="w-1/3 ps-2">
                            <label for="hp_pelanggan" class="ms-1 text-slate-300 font-medium">Nomor HP</label>
                            <input type="text" name="hp_pelanggan" id="hp_pelanggan" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" >
                        </div>
                        <div class="w-1/2 mb-2">
                            <label for="jenis_pembayaran" class="ms-1 text-slate-300 font-medium">Jenis Pembayaran</label>
                            <div class="flex p-2 bg-slate-800 rounded-lg">
                              <div class="flex items-center w-1/2">
                                <input id="nonPembayaran" type="radio" value="Non Tunai" name="jenis_pembayaran" class="w-4 h-4 text-yellow-700 bg-gray-100 focus:ring-yellow-700 focus:ring-2" />
                                <label for="nonPembayaran" class="ms-2 text-sm font-medium text-yellow-700">Non-Tunai</label>
                              </div>
                              <div class="flex items-center ps-3 w-1/2">
                                <input id="tunaiPembayaran" type="radio" value="Tunai" name="jenis_pembayaran" class="w-4 h-4 text-red-700 bg-gray-100 focus:ring-red-700 focus:ring-2" />
                                <label for="tunaiPembayaran" class="ms-2 text-sm font-medium text-red-700">Tunai</label>
                              </div>
                            </div>
                        </div>
                        <div class="w-1/2 mb-2 ps-2">
                            <label for="status_pembayaran" class="ms-1 text-slate-300 font-medium">Status Pembayaran</label>
                            <div class="flex p-2 items-center bg-slate-800 rounded-lg">
                              <div class="flex w-1/2">
                                <input id="lunasPembayaran" type="radio" value="Lunas" name="status_pembayaran" class="w-4 h-4 text-yellow-700 bg-gray-100 focus:ring-yellow-700 focus:ring-2" />
                                <label for="lunasPembayaran" class="ms-2 text-sm font-medium text-yellow-700">Lunas</label>
                              </div>
                              <div class="flex items-center w-1/2">
                                <input id="pendingPembayaran" type="radio" value="Pending" name="status_pembayaran" class="w-4 h-4 text-red-700 bg-gray-100 focus:ring-red-700 focus:ring-2" />
                                <label for="pendingPembayaran" class="ms-2 text-sm font-medium text-red-700">Pending</label>
                              </div>
                            </div>
                        </div>
                        <div class="w-full mb-2">
                            <label for="ket_transaksi_pembayaran" class="ms-1 text-slate-300 font-medium">Keterangan Pembayaran</label>
                            <input type="text" name="ket_transaksi_pembayaran" id="ket_transaksi_pembayaran" class="bg-transparent border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2"  />
                        </div>
                    </div>
                    <div class="w-full p-1 mt-3 flex justify-center">
                        <button type="submit" class="text-white items-center bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                          <i class="fa-solid fa-save fa-lg me-2"></i>
                          Simpan
                        </button>
                    </div>
                </form>
            </div>
          </div>
        </div>
        <!-- Content -->
      </div>
      <!-- Container -->
    </div>

    <script>
      var i = 0;
      $('#add').click(function(){
          ++i;
          $('#wrapper').append(
              '<div class="flex mt-4 gap-4" id="content">' +
                  '<select name="inputs['+i+']" class="bg-slate-800 border-2 border-slate-700 text-slate-300 text-sm rounded-lg focus:ring-slate-600 focus:border-slate-600 w-full p-2" required="">' +
                    '@foreach($barangs->where('stok', '>', 0) as $b)' +
                        '<option value="{{ $b->id }}">{{ $b->nama_barang }}</option>' +
                    '@endforeach' +
                  '</select>' +
                  '<button type="button" id="remove" class="w-60 px-2 border-2 rounded-lg text-slate-600 border-slate-800 hover:bg-slate-800 hover:text-slate-300 transition-all">Hapus Kolom</button>' +
              '</div>'
          );
      });

      $(document).on('click', '#remove', function(){
        $(this).parents('#content').remove();
      });
    </script>
    <script src="node_modules/flowbite/dist/flowbite.min.js"></script>
  </body>
</html>
