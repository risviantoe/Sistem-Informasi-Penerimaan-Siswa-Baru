@extends('auth.layout.app')
@section('title' , 'Daftar | PSB Kominfo')
@section('content')

<h1>Daftar</h1>
<p>Silahkan isi formulir dibawah ini untuk<br>melakukan pendaftaran akun</p>
<div class="form mt-5">
    <form action="/register" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama lengkap</label>
            <input name="nama" type="text" class="form-control form-daftar" id="nama">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input name="email" type="email" class="form-control form-daftar" id="email">
        </div>
        <div class="mb-5">
            <label for="password" class="form-label">Password</label>
            <input name="password" type="password" class="form-control form-daftar" id="password">
        </div>
        <div>
            <center>
                <button class="btn btn-primary" type="submit">
                    <span class="btn-text">Daftar</span>
                </button>
            </center>
        </div>
        <p class="switch">Sudah punya akun? <a class="link" href="/masuk">Masuk disini</a> </p>
    </form>
</div>

@endsection
