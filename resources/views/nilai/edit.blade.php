@extends('layout.main')

@section('content')
<center>
    <h3>
        Edit Nilai
    </h3>
    @if (session('error'))
    <p class="text-danger">{{ session('error') }}</p>
    @endif

    <form action="/nilai-raport/update/{{ $nilai->id }}" method="post">
        @csrf
        {{-- Dropdown untuk memilih Siswa --}}
        <label for="siswa_id">Nama Siswa:</label>
        <select name="siswa_id" id="siswa_id" required>
            <option value="">Pilih Siswa</option>
            @foreach($siswa as $each)
                {{-- <option value="{{ $each->id }}" @if ($each->id == $data_nilai->siswa_id) selected @endif>{{ $each->nama_siswa }}</option> --}}
                @if ($nilai->siswa_id == $each->id)
                    <option value="{{ $each->id }}" selected>{{ $each->nama_siswa }}</option>                    
                @else
                    <option value="{{ $each->id }}">{{ $each->nama_siswa }}</option>
                @endif
            @endforeach
        </select>
        <br>

        {{-- Input nilai untuk setiap mata pelajaran, hanya angka --}}
        <label for="matematika">Matematika:</label>
        <input type="number" name="matematika" id="matematika" step="0.01" value="{{ $nilai->matematika }}" required>
        <br>
        <label for="indonesia">Indonesia:</label>
        <input type="number" name="indonesia" id="indonesia" step="0.01" value="{{ $nilai->indonesia }}" required>
        <br>
        <label for="inggris">Inggris:</label>
        <input type="number" name="inggris" id="inggris" step="0.01" value="{{ $nilai->inggris }}" required>
        <br>
        <label for="kejuruan">Kejuruan:</label>
        <input type="number" name="kejuruan" id="kejuruan" step="0.01" value="{{ $nilai->kejuruan }}" required>
        <br>
        <label for="pilihan">Pilihan:</label>
        <input type="number" name="pilihan" id="pilihan" step="0.01" value="{{ $nilai->pilihan }}" required>
        <br>
        <button class="button-submit" type="submit">Ubah</button>
    </form>
</center>
@endsection