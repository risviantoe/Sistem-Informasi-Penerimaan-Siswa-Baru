<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\User;


class FormulirController extends Controller
{
    public function index(User $user)
    {
        $jurusan = [
            'Web Development',
            'Android Development',
            'Multimedia',
        ];

        $pendaftar = Pendaftar::where('user_id', $user->id)->first();
        $id = date('Ymd') . sprintf("%04s", $user->id);

        if ($pendaftar) {
            return view('dashboard.editform', [
                'user' => $user,
                'pendaftar' => $pendaftar,
                'jurusan' => $jurusan,
                'id' => $id
            ]);
        } else {
            return view('dashboard.formulir', [
                'user' => $user,
                'jurusan' => $jurusan,
                'id' => $id
            ]);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'nama' => 'required',
            'asal_sekolah' => 'required',
            'jurusan_pilihan' => 'required',
            'nilai_bind' => 'required',
            'nilai_mtk' => 'required',
            'nilai_ipa' => 'required',
            'nilai_bing' => 'required',
            'rata_rata' => 'required'
        ]);

        Pendaftar::create($request->all());
        return back()->with('success', 'Berhasil mendaftar! Silahkan pantau status pendaftaran mu.');
    }

    public function print(User $user)
    {
        $pendaftar = Pendaftar::where('user_id', $user->id)->first();

        return view('dashboard.printForm',[
            'user' => $user,
            'pendaftar' => $pendaftar
        ]);
    }
}
