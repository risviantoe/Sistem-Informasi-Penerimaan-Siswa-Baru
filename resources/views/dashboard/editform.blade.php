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
                    <a class="nav-link active" aria-current="page" href="/dashboard/formulir/{{ auth()->user()->id }}">Formulir Pendaftaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/status/{{ auth()->user()->id }}">Status Pendaftaran</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="col-12 section my-3 px-5 py-5">
    <h6>Silahkan isi formulir pendaftaran</h6>
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
                <div class="mb-4">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" id="alamat" rows="4" disabled>{{ $user->alamat }}</textarea>
                </div>
            </div>
        </div>

        <div class="col-12 d-flex form-container mb-5">
            <div class="col-6 left-form">
                <div class="mb-3">
                    <label class="title">&nbsp;</label>
                </div>
                <div class="mb-3">
                    <label for="sekolah" class="form-label">Asal Sekolah</label>
                    <input name="asal_sekolah" class="form-control @error('asal_sekolah') is-invalid @enderror" type="text" id="sekolah" required value="{{ old('asal_sekolah', $pendaftar->asal_sekolah) }}">
                    @error('asal_sekolah')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jurusan" class="form-label">Jurusan yang dipilih</label>
                    <select name="jurusan_pilihan" class="form-select @error('jurusan_pilihan') is-invalid @enderror" aria-label="Default select example" id="jurusan">
                        <option selected></option>
                        @foreach ($jurusan as $value)
                            @if (old('jurusan_pilihan', $pendaftar->jurusan_pilihan) == $value)
                                <option selected value="{{ $value }}">{{ $value }}</option>
                            @else
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('jurusan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-6 right-form">
                <div class="mb-3">
                    <label class="title">Nilai</label>
                </div>
                <div class="col-12 d-flex mb-3">
                    <div class="form-nilai">
                        <label for="bind" class="form-label">B. Ind</label>
                        <input name="nilai_bind" class="form-control @error('nilai_bind') is-invalid @enderror" type="number" id="bind" required value="{{ old('nilai_bind', $pendaftar->nilai_bind) }}">
                        @error('nilai_bind')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-nilai nilai">
                        <label for="mtk" class="form-label">MTK</label>
                        <input name="nilai_mtk" class="form-control @error('nilai_mtk') is-invalid @enderror" type="number" id="mtk" required value="{{ old('nilai_mtk', $pendaftar->nilai_mtk) }}">
                        @error('nilai_mtk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-nilai nilai">
                        <label for="ipa" class="form-label">IPA</label>
                        <input name="nilai_ipa" class="form-control @error('nilai_ipa') is-invalid @enderror" type="number" id="ipa" required value="{{ old('nilai_ipa', $pendaftar->nilai_ipa) }}">
                        @error('nilai_ipa')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-nilai nilai">
                        <label for="bing" class="form-label">B. Ing</label>
                        <input name="nilai_bing" class="form-control @error('nilai_bing') is-invalid @enderror" type="number" id="bing" required value="{{ old('nilai_bing', $pendaftar->nilai_bing) }}">
                        @error('nilai_bing')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mb-5">
                    <label for="rata" class="form-label">Rata-rata</label>
                    <input name="rata_rata" class="form-control @error('rata_rata') is-invalid @enderror" type="text" id="rata" value="{{ old('rata_rata', $pendaftar->rata_rata) }}">
                    @error('rata_rata')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="nama" value="{{ $user->nama }}">
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary" disabled>Daftar</button>
                    <a target="_blank" href="/dashboard/formulir/{{ $user->id }}/print" class="btn btn-secondary mx-2"><i class="bi bi-printer"></i> Print</a>
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
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#bind, #mtk, #ipa, #bing").keyup(function() {
            var bind  = $("#bind").val();
            var mtk = $("#mtk").val();
            var ipa = $("#ipa").val();
            var bing = $("#bing").val();
            var jumlah = parseFloat(bind) + parseFloat(mtk) + parseFloat(ipa) + parseFloat(bing);
            var rata = jumlah / 4;
            $("#rata").val(rata);
        });
    });
</script>

@endsection
