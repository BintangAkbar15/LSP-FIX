<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Walas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    
    public function index()
    {
        return view('login');
    }

    public function loginWalas(Request $request)
    {
        $walas = Walas::where('nig', $request->txt_nig)->first();

        if (!$walas || !Hash::check($request->txt_pass, $walas->password)) {
            return redirect()->back()->with('error', 'NIG atau Password salah');
        }

        $kelas = Kelas::where('id', $walas->kelas_id)->first();
        
        session([
            'role' => 'Walas',
            'id' => $walas->id,
            'nig' => $walas->nig,
            'nama' => $walas->nama_walas,
            'kelas_id' => $walas->kelas_id,
            'nama_kelas' => $kelas ? $kelas->nama_kelas : 'Kelas Belum ditentukan',
        ]);
        return redirect('nilai-raport/index');
        
    }
    public function loginSiswa(Request $request)
    {
        $siswa = Siswa::where('nis', $request->txt_nis)->first();
        
        if (!$siswa || !Hash::check($request->txt_pass, $siswa->password)) {
            return redirect()->back()->with('error', 'NIS atau Password salah');
        }

        $kelas = Kelas::where('id', $siswa->kelas_id)->first();
        session([
            'role' => 'Murid',
            'id' => $siswa->id,
            'nis' => $siswa->nis,
            'nama' => $siswa->nama_siswa,
            'kelas_id' => $siswa->kelas_id,
            'nama_kelas' => $siswa ? $kelas->nama_kelas : 'Kelas Belum ditentukan',
        ]);
        return redirect('nilai-raport/show');
    }

    public function logout(){
        session()->flush();
        return redirect('/');
    }
}
