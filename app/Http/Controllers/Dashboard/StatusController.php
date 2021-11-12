<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\User;

class StatusController extends Controller
{
    public function index(User $user)
    {
        $pendaftar = Pendaftar::where('user_id', $user->id)->first();

        if ($pendaftar) {
            return view('dashboard.status', [
                'pendaftar' => $pendaftar
            ]);
        } else {
            return view('dashboard.nulStatus');
        }
    }
}
