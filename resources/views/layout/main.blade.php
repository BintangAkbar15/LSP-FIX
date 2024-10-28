<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LSP-ERAPORT</title>
</head>
<body>
    <br>
    <div style="text-align: center;">
            <a href="/dashboard">DASHBOARD</a> |
       @if (session('role') == 'Walas')
            <a href="/nilai-raport/index">NILAI RAPORT</a> |
       @else
            <a href="/nilai-raport/show">NILAI RAPORT SISWA</a> |
       @endif 
            <a href="/logout">LOGOUT</a>
    </div> 
    <div style="text-align: center;">
        @yield('content')
    </div>   
</body>
</html>