@extends('dashboard.layout.app')
@section('title' , 'Dashboard | PSB Kominfo')
@section('content')

<nav class="navbar navbar-expand-lg navbar-light py-3">
    <div class="container-fluid" style="padding: 0">
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/data">Data Diri</a>
                </li>
                <li class="nav-item px-5">
                    <a class="nav-link" href="/dashboard/formulir/{{ auth()->user()->id }}">Formulir Pendaftaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/dashboard/status/{{ auth()->user()->id }}">Status Pendaftaran</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="col-12 section status my-3 px-5 py-5">
    <h6>Status Pendaftaran</h6>
    <div class="line mb-5"></div>
    <div class="form-container">
        <form class=" col-12 d-flex" action="">
            @csrf
            <div class="col-6 left-form">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input name="nama" class="form-control" type="text" id="nama" disabled value="{{ $pendaftar->nama }}">
                </div>
                <div class="mb-3">
                    <label for="jurusan" class="form-label">Jurusan yang dipilih</label>
                    <input name="jurusan_pilihan" class="form-control" type="text" id="jurusan" disabled value="{{ $pendaftar->jurusan_pilihan }}">
                </div>
                <div class="mb-3">
                    <label class="title">Nilai</label>
                </div>
                <div class="col-12 d-flex mb-3">
                    <div class="form-nilai">
                        <label for="bind" class="form-label">B. Ind</label>
                        <input name="nilai_bind" class="form-control" type="number" id="bind" disabled value="{{ $pendaftar->nilai_bind }}">
                    </div>
                    <div class="form-nilai nilai">
                        <label for="mtk" class="form-label">MTK</label>
                        <input name="nilai_mtk" class="form-control" type="number" id="mtk" disabled value="{{ $pendaftar->nilai_mtk }}">
                    </div>
                    <div class="form-nilai nilai">
                        <label for="ipa" class="form-label">IPA</label>
                        <input name="nilai_ipa" class="form-control" type="number" id="ipa" disabled value="{{ $pendaftar->nilai_ipa }}">
                    </div>
                    <div class="form-nilai nilai">
                        <label for="bing" class="form-label">B. Ing</label>
                        <input name="nilai_bing" class="form-control" type="number" id="bing" disabled value="{{ $pendaftar->nilai_bing }}">
                    </div>
                </div>
                <div class="mb-5">
                    <label for="rata" class="form-label">Rata-rata</label>
                    <input name="rata_rata" class="form-control" type="text" id="rata" disabled value="{{ $pendaftar->rata_rata }}">
                </div>
            </div>
            <div class="col-6 right-form">
                <div class="mb-3">
                    <label class="title">Status</label>
                </div>
                <div class="status-container
                @if ($pendaftar->status === 'Proses Seleksi')
                    proses
                @elseif ($pendaftar->status === 'Diterima')
                    lolos
                @elseif ($pendaftar->status === 'Belum Diterima')
                    tdk-lolos
                @else
                    cadangan
                @endif
                mb-3">
                    {{ $pendaftar->status }}
                </div>
                @if ($pendaftar->status === 'Proses Seleksi')
                    <p>Status pendaftaran kamu masih dalam Proses Seleksi, status akan berubah jika kamu sudah dinyatakan Diterima/Cadangan/Tidak diterima. Silahkan cek secara berkala ya!</p>
                @elseif ($pendaftar->status === 'Diterima')
                    <p>Selamat kamu dinyatakan <b>Diterima</b>.</p>
                @elseif ($pendaftar->status === 'Belum Diterima')
                    <p>Mohon maaf kamu <b>Belum Diterima</b>. Tetap Semangat!</p>
                @else
                    <p>Status pendaftaran kamu saat ini masuk dalam status <b>Cadangan</b>.</p>
                @endif
            </div>
        </form>
    </div>
</div>

@endsection
