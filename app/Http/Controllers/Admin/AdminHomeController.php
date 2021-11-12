<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminHomeController extends Controller
{
    public function index()
    {
        for ($tanggal = 25; $tanggal < 32; $tanggal++) {
            $chart1 = collect(DB::SELECT("SELECT count(id) AS jumlah from users where day(created_at)='$tanggal'"))->first();
            $chartPengguna[] = $chart1->jumlah;

            $chart2 = collect(DB::SELECT("SELECT count(id) AS jumlah from pendaftar where day(created_at)='$tanggal'"))->first();
            $chartPendaftar[] = $chart2->jumlah;
        }
        $pengguna = User::latest()->take(5)->get();
        $pendaftar = Pendaftar::latest()->take(5)->get();

        $jmlPengguna = $pengguna->count();
        $jmlPendaftar = $pendaftar->count();

        $no = 1;
        return view('admin.home', [
            'no' => $no,
            'pengguna' => $pengguna,
            'pendaftar' => $pendaftar,
            'jmlPengguna' => $jmlPengguna,
            'jmlPendaftar' => $jmlPendaftar
        ],compact('chartPengguna', 'chartPendaftar'))->with('i');
    }
}
