<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kesalahan</title>
    <link rel="stylesheet" href="{{asset(env('CSS_PATH').'style.min.css')}}">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FBFCFC;
            height: 100%;
            width: 100%;
        }
        #container {
            margin: 0 auto;
            width: 30vw;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        h1 {
            font-size: 40pt;
        }
        .void-area {
            flex: 1;
        }
        .fill-area {
            flex: 0;
        }
    </style>
</head>
<body>
<div id="container" class="">
    <div class="void-area"></div>
    <div class="fill-area">
        <h1 class="text-danger"><strong>Kesalahan!</strong></h1>
        <h2 class="text-danger opacity-7"><strong>404 Halaman Tidak Ditemukan</strong></h2>
        <p class="text-justify">
            Maaf sepertinya halaman yang ingin anda tuju tidak ada. Mohon untuk memeriksa kembali URL halaman tersebut.
        </p>
    </div>
    <div class="void-area"></div>
</div>
</body>
</html>
