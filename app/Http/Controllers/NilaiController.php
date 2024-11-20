<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Walas;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function gradeMapel($nilai)
    {
        if ($nilai >= 90) {
            return 'A';
        } elseif ($nilai >= 80) {
            return 'B';
        } elseif ($nilai >= 70) {
            return 'C';
        } elseif ($nilai >= 60) {
            return 'D';
        } else {
            return 'E';
        }
    }
   
    public function index()
    {
        // Dapatkan walas yang sedang login
        $walas = Walas::find(session('id'));

        if (!$walas) {
            return back()->with('error', 'Data wali kelas tidak ditemukan');
        }

        // Ambil semua data nilai dari siswa yang kelasnya sama dengan walas
        $data_nilai = Nilai::whereHas('siswa', function ($query) use ($walas) {
            $query->where('kelas_id', $walas->kelas_id);
        })->with('siswa')->get();
        $kelas = Kelas::where('id',session('id'))->first();

        // Kirim data ke view
        return view('nilai.index', compact(['data_nilai','kelas']));
    }

    public function create()
    {
        // Mendapatkan wali kelas yang sedang login
        $walas = Walas::find(session('id'));
        $nilai = Nilai::pluck('siswa_id');
        
        // Mengambil siswa yang memiliki kelas_id yang sama dengan walas yang sedang login
        $siswa = Siswa::where('kelas_id', $walas->kelas_id)->whereNotIn('id', $nilai)->get();

        return view('nilai.create', [
            'siswa' => $siswa
        ]);
    }

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
    
    public function showNilai($id)
    {
        $siswa = Siswa::with(['kelas', 'nilai'])->find($id);

        $nilai = optional($siswa->nilai)->first();

        $walas = Nilai::with('walas')->first();

        $data_nilai = [
            'matematika' => [
                'nilai' => $nilai->matematika ?? 'Data tidak tersedia',
                'grade' => $nilai ? $this->gradeMapel($nilai->matematika) : 'N/A'
            ],
            'indonesia' => [
                'nilai' => $nilai->indonesia ?? 'Data tidak tersedia',
                'grade' => $nilai ? $this->gradeMapel($nilai->indonesia) : 'N/A'
            ],
            'inggris' => [
                'nilai' => $nilai->inggris ?? 'Data tidak tersedia',
                'grade' => $nilai ? $this->gradeMapel($nilai->inggris) : 'N/A'
            ],
            'kejuruan' => [
                'nilai' => $nilai->kejuruan ?? 'Data tidak tersedia',
                'grade' => $nilai ? $this->gradeMapel($nilai->kejuruan) : 'N/A'
            ],
            'pilihan' => [
                'nilai' => $nilai->pilihan ?? 'Data tidak tersedia',
                'grade' => $nilai ? $this->gradeMapel($nilai->pilihan) : 'N/A'
            ],
            'rata_rata' => [
                'nilai' => $nilai->rata_rata ?? 'Data tidak tersedia',
                'grade' => $nilai ? $this->gradeMapel($nilai->rata_rata) : 'N/A'
            ]
        ];

        return view('nilai.show', [
            'siswa' => $siswa,
            'data_nilai' => $data_nilai,
            'walas' => $walas,
        ]);
    }

    public function show()
    {
        $siswa = Siswa::with(['kelas', 'nilai'])->find(session('id'));

        $nilai = optional($siswa->nilai)->first();

        $walas = Nilai::with('walas')->first();

        $data_nilai = [
            'matematika' => [
                'nilai' => $nilai->matematika ?? 'Data tidak tersedia',
                'grade' => $nilai ? $this->gradeMapel($nilai->matematika) : 'N/A'
            ],
            'indonesia' => [
                'nilai' => $nilai->indonesia ?? 'Data tidak tersedia',
                'grade' => $nilai ? $this->gradeMapel($nilai->indonesia) : 'N/A'
            ],
            'inggris' => [
                'nilai' => $nilai->inggris ?? 'Data tidak tersedia',
                'grade' => $nilai ? $this->gradeMapel($nilai->inggris) : 'N/A'
            ],
            'kejuruan' => [
                'nilai' => $nilai->kejuruan ?? 'Data tidak tersedia',
                'grade' => $nilai ? $this->gradeMapel($nilai->kejuruan) : 'N/A'
            ],
            'pilihan' => [
                'nilai' => $nilai->pilihan ?? 'Data tidak tersedia',
                'grade' => $nilai ? $this->gradeMapel($nilai->pilihan) : 'N/A'
            ],
            'rata_rata' => [
                'nilai' => $nilai->rata_rata ?? 'Data tidak tersedia',
                'grade' => $nilai ? $this->gradeMapel($nilai->rata_rata) : 'N/A'
            ]
        ];

        return view('nilai.show', [
            'siswa' => $siswa,
            'data_nilai' => $data_nilai,
            'walas' => $walas,
        ]);
    }

    public function edit(Nilai $nilai)
    {
        // Mendapatkan wali kelas yang sedang login
        $walas = Walas::find(session('id'));

        // Mengambil siswa yang memiliki kelas_id yang sama dengan walas yang sedang login
        $siswa = Siswa::where('id', $nilai->siswa_id)->first();

        return view('nilai.edit', [
            'nilai' => $nilai,
            'siswa' => $siswa
        ]);
    }

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
            // Lakukan update data
            $nilai->update($data_nilai);
            return redirect("/nilai-raport/index")->with('success', 'Data nilai berhasil diubah');
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
