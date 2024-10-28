<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Walas;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Dapatkan walas yang sedang login
        $walas = Walas::find(session('id'));

        // if (!$walas) {
        //     return back()->with('error', 'Data wali kelas tidak ditemukan');
        // }

        // Ambil semua data nilai dari siswa yang kelasnya sama dengan walas
        $data_nilai = Nilai::whereHas('siswa', function ($query) use ($walas) {
            $query->where('kelas_id', $walas->kelas_id);
        })->with('siswa')->get();

        // Kirim data ke view
        return view('nilai.index', compact('data_nilai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Mendapatkan wali kelas yang sedang login
        $walas = Walas::find(session('id'));

        // Mengambil siswa yang memiliki kelas_id yang sama dengan walas yang sedang login
        $siswa = Siswa::where('kelas_id', $walas->kelas_id)->get();

        return view('nilai.create', [
            'siswa' => $siswa
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data_nilai = $request->validate([
            'siswa_id' => ['required'],
            'matematika' => ['required'],
            'indonesia' => ['required'],
            'inggris' => ['required'],
            'kejuruan' => ['required'],
            'pilihan' => ['required']
        ]);
        $data_nilai['walas_id'] = session('id');
        $data_nilai['siswa_id'] = $request->siswa_id;
        $data_nilai['rata_rata'] = round((
            $data_nilai['matematika'] +
            $data_nilai['indonesia'] +
            $data_nilai['inggris'] +
            $data_nilai['kejuruan'] +
            $data_nilai['pilihan']
        ) / 5);

        $cek_nilai = Nilai::where('siswa_id', $request->siswa_id)->first();

        if ($cek_nilai) {
            return back()->with('error', 'Data nilai untuk siswa tersebut sudah ada');
        } else {
            Nilai::create($data_nilai);
            return redirect("/nilai-raport/index")->with('success', 'Data nilai berhasil ditambahkan');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Nilai $nilai)
    {
        // Mendapatkan wali kelas yang sedang login
        $walas = Walas::find(session('id'));

        // Mengambil siswa yang memiliki kelas_id yang sama dengan walas yang sedang login
        $siswa = Siswa::where('kelas_id', $walas->kelas_id)->get();

        return view('nilai.edit', [
            'nilai' => $nilai,
            'siswa' => $siswa
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nilai $nilai)
    {
        // Validasi data
        $data_nilai = $request->validate([
            'siswa_id' => ['required'],
            'matematika' => ['required', 'numeric'],
            'indonesia' => ['required', 'numeric'],
            'inggris' => ['required', 'numeric'],
            'kejuruan' => ['required', 'numeric'],
            'pilihan' => ['required', 'numeric']
        ]);

        $data_nilai['walas_id'] = session('id');
        $data_nilai['rata_rata'] = round((
            $data_nilai['matematika'] +
            $data_nilai['indonesia'] +
            $data_nilai['inggris'] +
            $data_nilai['kejuruan'] +
            $data_nilai['pilihan']
        ) / 5);

        // Cek apakah ada data nilai lain untuk siswa yang sama, kecuali data yang sedang diupdate
        $cek_nilai = Nilai::where('siswa_id', $request->siswa_id)->where('id', '!=', $nilai->id)->first();

        if ($cek_nilai) {
            return back()->with('error', 'Data nilai untuk siswa tersebut sudah ada');
        } else {
            // Lakukan update data
            $nilai->update($data_nilai);
            return redirect("/nilai-raport/index")->with('success', 'Data nilai berhasil diubah');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nilai $nilai)
    {
        $nilai->delete();
        return redirect("/nilai-raport/index")->with('success', 'Data nilai berhasil diubah');
    }
}
