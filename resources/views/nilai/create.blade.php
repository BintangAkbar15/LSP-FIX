@extends('layout.main')

@section('content')
<center>
    <h3>
        Create Nilai
    </h3>
    @if (session('error'))
    <p class="text-danger">{{ session('error') }}</p>
    @endif

    <form action="/nilai-raport/store" method="post">
        @csrf
        
        {{-- Dropdown untuk memilih Siswa --}}
        <label for="siswa_id">Nama Siswa:</label>
        <select name="siswa_id" id="siswa_id" required>
            <option value="">Pilih Siswa</option>
            @foreach($siswa as $each)
                <option value="{{ $each->id }}">{{ $each->nama_siswa }}</option>
            @endforeach
        </select>
        <br>

        {{-- Input nilai untuk setiap mata pelajaran, hanya angka --}}
        <label for="matematika">Matematika:</label>
        <input type="number" name="matematika" id="matematika" step="0.01" required>
        <br>
        <label for="indonesia">Indonesia:</label>
        <input type="number" name="indonesia" id="indonesia" step="0.01" required>
        <br>
        <label for="inggris">Inggris:</label>
        <input type="number" name="inggris" id="inggris" step="0.01" required>
        <br>
        <label for="kejuruan">Kejuruan:</label>
        <input type="number" name="kejuruan" id="kejuruan" step="0.01" required>
        <br>
        <label for="pilihan">Pilihan:</label>
        <input type="number" name="pilihan" id="pilihan" step="0.01" required>
        <br>
        <button class="button-submit" type="submit">Simpan</button>
    </form>
</center>
@endsection