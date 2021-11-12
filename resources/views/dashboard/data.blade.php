@extends('dashboard.layout.app')
@section('title' , 'Dashboard | PSB Kominfo')
@section('content')

<nav class="navbar navbar-expand-lg navbar-light py-3">
    <div class="container-fluid" style="padding: 0">
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/dashboard/data">Data Diri</a>
                </li>
                <li class="nav-item px-5">
                    <a class="nav-link" href="/dashboard/formulir/{{ auth()->user()->id }}">Formulir Pendaftaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/status/{{ auth()->user()->id }}">Status Pendaftaran</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="col-12 section my-3 px-5 py-5">
    <h6>Silahkan isi Data Diri kamu dengan benar</h6>
    <div class="line mb-5"></div>
    <div class="form-container mb-5">
        <form class="col-12 d-flex" action="/dashboard/data" method="POST">
            @csrf
            <div class="col-6 left-form">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input name="nama" class="form-control @error('nama') is-invalid @enderror" type="text" id="nama" value="{{ old('nama', auth()->user()->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jenis-kelamin" class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" aria-label="Default select example" id="jenis-kelamin" value="{{ old('jenis_kelamin', auth()->user()->jenis_kelamin) }}">
                        @if (auth()->user()->jenis_kelamin == 'L')
                            <option selected value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        @elseif (auth()->user()->jenis_kelamin == 'P')
                            <option value="L">Laki-laki</option>
                            <option selected value="P">Perempuan</option>
                        @else
                            <option selected></option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        @endif
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tempat-lahir" class="form-label">Tempat Lahir</label>
                    <input name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" type="text" id="tempat-lahir" required value="{{ old('tempat_lahir', auth()->user()->tempat_lahir) }}">
                    @error('tempat_lahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tanggal-lahir" class="form-label">Tanggal Lahir</label>
                    <input name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" type="date" id="tanggal-lahir" required value="{{ old('tanggal_lahir', auth()->user()->tanggal_lahir) }}">
                    @error('tanggal_lahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6 right-form">
                <div class="mb-3">
                    <label for="agama" class="form-label">Agama</label>
                    <select name="agama" class="form-select @error('agama') is-invalid @enderror" aria-label="Default select example" id="agama">
                        <option selected></option>
                        @foreach ($agama as $value)
                            @if (old('agama', auth()->user()->agama) == $value)
                                <option selected value="{{ $value }}">{{ $value }}</option>
                            @else
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('agama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="no-hp" class="form-label">No Hp</label>
                    <input name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" type="number" id="no-hp" required value="{{ old('no_hp', auth()->user()->no_hp) }}">
                    @error('no_hp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" rows="4" required>{{ old('alamat', auth()->user()->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
</div>

@endsection
