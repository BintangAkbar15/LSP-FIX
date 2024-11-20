<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LSP-ERAPORT</title>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>
<body>
    <div class="header">
        <img class="badge" src="{{ asset('assets/img/smkn1cibinong.png') }}" alt="">
        <img class="banner" src="{{ asset('assets/img/smkhebat.jpg') }}" alt="">
    </div>
    
    <div class="sidebar">
        @if (session('role') == 'Walas')
            <a href="/nilai-raport/create">INPUT  NILAI</a> 
            <a href="/nilai-raport/index">REKAP NILAI</a> 
        @else
            <a href="/nilai-raport/show">REKAP NILAI</a> 
        @endif 
            <a href="/logout">LOGOUT</a>
    </div> 

    <div class="container">
        @yield('name')
        <div class="greet">
            <h3 class="">Halo  {{ session('nama') }}</h3>
        </div>
    </div>
    <div style="text-align: center;">
        @yield('content')
    </div>   

    <footer>
        <div class="footer">
            <h5>MADE WITH LOVE #JOHNSON</h5>
        </div>
    </footer>
</body>
</html>