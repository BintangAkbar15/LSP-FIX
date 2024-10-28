@extends('layout.main')

@section('content')
<center>
    <h3>
        Laporan Hasil Belajar
        <table align="center">
            <tr>
                <td>Nama Siswa</td>
                <td>:</td>
                <td>{{ $siswa->nama_siswa }}</td>
            </tr>
            <tr>
                <td>Nomor Induk Siswa</td>
                <td>:</td>
                <td>{{ $siswa->nis }}</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td>{{ $siswa->kelas->nama_kelas }}</td>
            </tr>
        </table>
        <table border="1px">
           <thead>
                <tr>
                    <th>No</th>
                    <th>Mata Pelajaran</th>
                    <th>Nilai</th>
                    <th>Grade</th>
                </tr>
           </thead>
           <tbody>
                <tr>
                    <td>1</td>
                    <td>Matematika</td>
                    <td>{{ $data_nilai['matematika']['nilai'] }}</td>
                    <td>{{ $data_nilai['matematika']['grade'] }}</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Bahasa Indonesia</td>
                    <td>{{ $data_nilai['indonesia']['nilai'] }}</td>
                    <td>{{ $data_nilai['indonesia']['grade'] }}</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Bahasa Inggris</td>
                    <td>{{ $data_nilai['inggris']['nilai'] }}</td>
                    <td>{{ $data_nilai['inggris']['grade'] }}</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Konsentrasi Keahlian</td>
                    <td>{{ $data_nilai['kejuruan']['nilai'] }}</td>
                    <td>{{ $data_nilai['kejuruan']['grade'] }}</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Mata Pelajaran Pilihan</td>
                    <td>{{ $data_nilai['pilihan']['nilai'] }}</td>
                    <td>{{ $data_nilai['pilihan']['grade'] }}</td>
                </tr>
                <tr>
                    <th></th>
                    <th>Rata - rata</th>
                    <td>{{ $data_nilai['rata_rata']['nilai'] }}</td>
                    <td>{{ $data_nilai['rata_rata']['grade'] }}</td>
                </tr>
           </tbody>
        </table>

    </h3>
</center>
@endsection