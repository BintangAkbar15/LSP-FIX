@extends('layout.main')

@section('content')
<center>
    <b>
        <h2>DATA NILAI</h2>

        {{-- @if (session('role') == 'guru') --}}
            {{-- <a href="/nilai/create/{{ $idKelas }}" class="button-primary">TAMBAH DATA</a> --}}
            <a href="/nilai-raport/create" class="button-primary">TAMBAH DATA</a>
        {{-- @endif --}}

        @if (session('success'))
            <div class="alert alert-success"><span class="closebtn" id="closeBtn">&times;</span>{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger"><span class="closebtn" id="closeBtn">&times;</span>{{ session('error') }}</div>
        @endif
        <table border="1px">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA SISWA</th>
                    <th>MATEMATIKA</th>
                    <th>BAHASA INDONESIA</th>
                    <th>BAHASA INGGRIS</th>
                    <th>KEJURUAN</th>
                    <th>MAPEL PILIHAN - GAME</th>
                    <th>RATA - RATA</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_nilai as $each)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $each->siswa->nama_siswa }}</td>
                        <td>{{ $each->matematika }}</td>
                        <td>{{ $each->indonesia }}</td>
                        <td>{{ $each->inggris }}</td>
                        <td>{{ $each->kejuruan }}</td>
                        <td>{{ $each->pilihan }}</td>
                        <td>{{ $each->rata_rata }}</td>
                        <td style="text-align: center">
                            {{-- <a href="/nilai/edit/{{ $idKelas }}/{{ $each->id }}" class="button-warning">EDIT</a>
                            <a href="/nilai/destroy/{{ $each->id }}" onclick="return confirm('Yakin Hapus?')" class="button-danger">HAPUS</a> --}}
                            <a href="/nilai-raport/edit/{{ $each->id }}" class="button-warning">EDIT</a>
                            <a href="/nilai-raport/destroy/{{ $each->id }}" onclick="return confirm('Yakin Hapus?')" class="button-danger">HAPUS</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </b>
</center>
@endsection