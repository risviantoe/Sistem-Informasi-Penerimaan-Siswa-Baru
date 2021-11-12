<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPendaftarController extends Controller
{
    public function index(Request $request)
    {
        for ($tanggal = 25; $tanggal < 32; $tanggal++) {
            $chart1 = collect(DB::SELECT("SELECT count(id) AS jumlah from pendaftar where day(created_at)='$tanggal'"))->first();
            $chartPendaftar[] = $chart1->jumlah;
        }

        $pendaftar = Pendaftar::latest();
        $jmlPendaftar = $pendaftar->count();
        $no = 1;

        if ($request['search']) {
            $pendaftar->where('id', 'LIKE', '%' . $request['search'] . '%')
                ->orWhere('nama', 'LIKE', '%' . $request['search'] . '%')
                ->orWhere('jurusan_pilihan', 'LIKE', '%' . $request['search'] . '%')
                ->orWhere('status', 'LIKE', '%' . $request['search'] . '%');
        }

        return view('admin.pendaftar', [
            'no' => $no,
            'pendaftar' => $pendaftar->paginate(5)->withQueryString(),
            'jmlPendaftar' => $jmlPendaftar,
        ], compact('chartPendaftar'))->with('i');
    }

    public function show(Pendaftar $pendaftar)
    {
        $jurusan = [
            'Web Development',
            'Android Development',
            'Multimedia',
        ];

        $status = [
            'Proses Seleksi',
            'Diterima',
            'Belum Diterima',
            'Cadangan'
        ];

        $user = User::where('id', $pendaftar->user_id)->first();

        return view('admin.detailPendaftar', [
            'pendaftar' => $pendaftar,
            'user' => $user,
            'jurusan' => $jurusan,
            'status' => $status
        ]);
    }

    public function destroy(Pendaftar $pendaftar)
    {
        $user = Pendaftar::where('id', $pendaftar->id)
            ->delete();

        return redirect('/admin/dashboard/pendaftar');
    }

    public function edit(Pendaftar $pendaftar)
    {
        $jurusan = [
            'Web Development',
            'Android Development',
            'Multimedia',
        ];

        $status = [
            'Proses Seleksi',
            'Diterima',
            'Belum Diterima',
            'Cadangan'
        ];

        $user = User::where('id', $pendaftar->user_id)->first();

        return view('admin.editPendaftar', [
            'pendaftar' => $pendaftar,
            'user' => $user,
            'jurusan' => $jurusan,
            'status' => $status
        ]);
    }

    public function update(Request $request, Pendaftar $pendaftar)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'asal_sekolah' => 'required',
            'jurusan_pilihan' => 'required',
            'nilai_bind' => 'required',
            'nilai_mtk' => 'required',
            'nilai_ipa' => 'required',
            'nilai_bing' => 'required',
            'rata_rata' => 'required',
            'status' => 'required'
        ]);

        Pendaftar::where('id', $pendaftar->id)
            ->update($validatedData);

        return redirect('/admin/dashboard/pendaftar/' . $pendaftar->id . '/detail')->with('success', 'Data berhasil diupdate!');
    }

    public function print(User $user)
    {
        $pendaftar = Pendaftar::where('user_id', $user->id)->first();

        return view('admin.printPendaftar', [
            'user' => $user,
            'pendaftar' => $pendaftar
        ]);
    }

}
