@extends('admin.layout.app')
@section('title' , 'Admin | PSB Kominfo')
@section('content')

<nav class="navbar navbar-expand-lg navbar-light py-3">
    <div class="container-fluid" style="padding: 0">
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link" href="/admin/dashboard">Home</a>
                </li>
                <li class="nav-item px-5">
                    <a class="nav-link active" aria-current="page" href="/admin/dashboard/pengguna">Data Pengguna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/dashboard/pendaftar">Data Pendaftar</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="col-12 section my-3 px-5 py-5">
    <h6>Detail data pengguna - {{ $user->nama }}</h6>
    <div class="line mb-5"></div>
    <form action="/dashboard/formulir" method="POST">
        @csrf
        <div class="col-12 d-flex form-container mb-5">
            <div class="col-6 left-form">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input name="nama" class="form-control" type="text" id="nama" disabled value="{{ $user->nama }}">
                </div>
                <div class="mb-3">
                    <label for="jenis-kelamin" class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select" aria-label="Default select example" id="jenis-kelamin" disabled>
                        @if ($user->jenis_kelamin == 'L')
                            <option selected value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        @elseif ($user->jenis_kelamin == 'P')
                            <option value="L">Laki-laki</option>
                            <option selected value="P">Perempuan</option>
                        @else
                            <option selected></option>
                        @endif
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tempat-lahir" class="form-label">Tempat Lahir</label>
                    <input name="tempat_lahir" class="form-control" type="text" id="tempat-lahir" disabled value="{{ $user->tempat_lahir }}">
                </div>
                <div class="mb-3">
                    <label for="tanggal-lahir" class="form-label">Tanggal Lahir</label>
                    <input name="tanggal_lahir" class="form-control" type="date" id="tanggal-lahir" disabled value="{{ $user->tanggal_lahir }}">
                </div>
            </div>
            <div class="col-6 right-form">
                <div class="mb-3">
                    <label for="agama" class="form-label">Agama</label>
                    <select name="agama" class="form-select" aria-label="Default select example" id="agama" disabled>
                        <option selected value="{{ $user->agama }}">{{ $user->agama }}</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="no-hp" class="form-label">No Hp</label>
                    <input name="no_hp" class="form-control" type="number" id="no-hp" disabled value="{{ $user->no_hp }}">
                </div>
                <div class="mb-5">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" id="alamat" rows="4" disabled>{{ $user->alamat }}</textarea>
                </div>
                <div class="dflex">
                    <a href="/admin/dashboard/pengguna/{{ $user->id }}/edit" class="btn btn-secondary"><i class="bi bi-pencil-square"></i> Edit</a>
                    <a href="/admin/dashboard/pengguna/{{ $user->id }}/delete" onclick="return sweetDel(event)" class="btn btn-secondary"><i class="bi bi-trash"></i> Hapus</a>
                    <a href="/admin/dashboard/pengguna" class="btn btn-primary"><i class="bi bi-box-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </form>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
</div>

@endsection
