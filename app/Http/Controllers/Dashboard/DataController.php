<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\user;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agama = [
            'Islam',
            'Kristen',
            'Katolik',
            'Hindhu',
            'Budha',
            'Konghucu',
        ];
        return view('dashboard.data',[
            'agama' => $agama,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'no_hp' => 'required|numeric|unique:users',
            'alamat' => 'required'
        ]);

        $ipAddress = [
            'ip' => $request->ip()
        ];

        User::where('id', $request['id'])
            ->update($validatedData);

        User::where('id', $request['id'])
            ->update($ipAddress);

        return redirect('dashboard/data')->with('success', 'Data berhasil disimpan!');
    }
}
