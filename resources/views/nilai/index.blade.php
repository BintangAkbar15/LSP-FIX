@extends('layout.main')
@section('name')
    <h3>Rekap Nilai</h3>
@endsection
@section('content')
<center>
{{-- {{ dd($kelas) }} --}}
    <h1>REKAP NILAI RAPORT <br> {{ $kelas->nama_kelas }}</h1>
    {{-- @if (session('role') == 'guru') --}}
        {{-- <a href="/nilai/create/{{ $idKelas }}" class="button-primary">TAMBAH DATA</a> --}}
       <p align="right">
           <a href="/nilai-raport/create" class="button-primary"><button  class="add-button">Tambah Data</button></a>
        </p> 
    {{-- @endif --}}
    @if (session('success'))
        <div class="alert alert-success"><span class="closebtn" id="closeBtn">&times;</span>{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger"><span class="closebtn" id="closeBtn">&times;</span>{{ session('error') }}</div>
    @endif
    <table class="table-show">
        <thead>
            <tr>
                <th class="border-head" rowspan="2">NO</th>
                <th class="border-head" rowspan="2">NIS</th>
                <th class="border-head" rowspan="2">NAMA SISWA</th>
                <th class="border-head" colspan="6">NILAI</th>
                <th class="border-head" rowspan="2" colspan="3">ACTION</th>
            </tr>
            <tr>
                <th class="border-head">MATEMATIKA</th>
                <th class="border-head">BAHASA INDONESIA</th>
                <th class="border-head">BAHASA INGGRIS</th>
                <th class="border-head">KEJURUAN</th>
                <th class="border-head">M.PILIHAN</th>
                <th class="border-head">RATA - RATA</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_nilai as $data)
                <tr>
                    <td class="border-data" >{{ $loop->iteration }}</td>
                    <td class="border-data" >{{ $data->siswa->nis }}</td>
                    <td class="border-data" >{{ $data->siswa->nama_siswa }}</td>
                    <td class="border-data" >{{ $data->matematika }}</td>
                    <td class="border-data" >{{ $data->indonesia }}</td>
                    <td class="border-data" >{{ $data->inggris }}</td>
                    <td class="border-data" >{{ $data->kejuruan }}</td>
                    <td class="border-data" >{{ $data->pilihan }}</td>
                    <td class="border-data" >{{ $data->rata_rata }}</td>
                    <td class="border-data"  style="text-align: center">
                        <div class="action">
                            <a href="/nilai-raport/show/{{ $data->id }}"><button class="index-button">VIEW</button></a>
                            <a href="/nilai-raport/edit/{{ $data->id }}"><button class="index-button">EDIT</button></a>
                            <a href="/nilai-raport/destroy/{{ $data->id }}" onclick="return confirm('Yakin Hapus?')" class="button-danger"><button class="index-button">DELETE</button></a>
                        </div>
                        {{-- <a href="/show/{{ $nilai->siswa_id }}">RAPORT</a> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</center>
@endsection