@extends('layout.main')

@section('content')
<center>
    <h3>
        Selamat Datang {{ session('role') }} {{ session('nama_kelas') }} - {{ session('nama') }}
    </h3>
</center>
@endsection