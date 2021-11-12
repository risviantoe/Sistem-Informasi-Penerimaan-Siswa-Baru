<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPenggunaController extends Controller
{
    public function index(Request $request)
    {
        for ($tanggal = 25; $tanggal < 32; $tanggal++) {
            $chart1 = collect(DB::SELECT("SELECT count(id) AS jumlah from users where day(created_at)='$tanggal'"))->first();
            $chartPengguna[] = $chart1->jumlah;
        }
        $pengguna = User::latest();

        $jmlPengguna = $pengguna->count();

        $no = 1;

        if ($request['search']) {
            $pengguna->where('nama', 'LIKE', '%' . $request['search'] . '%')
            ->orWhere('email', 'LIKE', '%' . $request['search'] . '%')
            ->orWhere('tempat_lahir', 'LIKE', '%' . $request['search'] . '%')
            ->orWhere('agama', 'LIKE', '%' . $request['search'] . '%')
            ->orWhere('no_hp', 'LIKE', '%' . $request['search'] . '%');
        }

        return view('admin.pengguna',[
            'no' => $no,
            'pengguna' => $pengguna->paginate(5)->withQueryString(),
            'jmlPengguna' => $jmlPengguna,
        ], compact('chartPengguna'))->with('i');
    }

    public function show(User $user)
    {
        return view('admin.detailPengguna', [
            'user' => $user,
        ]);
    }

    public function destroy(User $user)
    {
        $user = User::where('id', $user->id)
            ->delete();

        return redirect('/admin/dashboard/pengguna');
    }

    public function edit(User $user)
    {
        $agama = [
            'Islam',
            'Kristen',
            'Katolik',
            'Hindhu',
            'Budha',
            'Konghucu',
        ];

        return view('admin.editPengguna', [
            'user' => $user,
            'agama' => $agama
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'no_hp' => 'required|numeric',
            'alamat' => 'required'
        ]);

        User::where('id', $user->id)
            ->update($validatedData);

        return redirect('/admin/dashboard/pengguna/'.$user->id.'/detail')->with('success', 'Data berhasil diupdate!');
    }
}
