<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="https://kit.fontawesome.com/b91f07c834.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Inveelia | Login</title>
  </head>
  <body style="font-family: 'Poppins';">
    <div class="w-screen h-svh flex justify-center bg-slate-950">
      <div class="mt-44 p-6 size-96 h-min bg-slate-900 text-slate-300 outline outline-4 outline-slate-800 rounded-xl max-sm:mt-36 max-sm:size-80 max-sm:h-min">
        <img src="img/pos2.svg" class="mx-auto w-5/12" alt="">
        <p class="text-center my-4 text-xs">Selamat Datang, <br>Silahkan login dengan username dan password</p>
        <form action="/auth" method="post" class="flex-col flex">
            @csrf
          <label for="username" class="ms-2 mb-1"><i class="fa-solid fa-user fa-sm me-1"></i> Username</label>
          <input type="text" name="username" id="username" class="bg-transparent mb-4 px-2 border-2 border-slate-800 rounded-lg  focus:border-slate-700 focus:ring-slate-700">
          <label for="password" class="ms-2 mb-1"><i class="fa-solid fa-key fa-sm me-1"></i>Passsword</label>
          <input type="password" name="password" id="password" class="bg-transparent mb-8 px-2 border-2 border-slate-800 rounded-lg focus:border-slate-700 focus:ring-slate-700">
          <button type="submit" class="border-2 border-slate-950 rounded-lg w-min px-8 mx-auto bg-slate-950 hover:border-slate-700  hover:bg-transparent hover:text-white hover:px-9 transition-all">Login</button>
        </form>
        <!-- <p class="text-3xl text-center font-semibold text-blue-700 max-sm:text-2xl">Login</p> -->
      </div>
    </div>
  </body>
</html>