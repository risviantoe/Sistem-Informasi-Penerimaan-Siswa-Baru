<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Bukti Pendaftaran | {{ $pendaftar->nama }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/print.css') }}">
</head>
<body class="py-5">
    <div class="container py-3 px-5">
        <div class="d-flex col-12 pb-4 mb-5 header">
            <div class="d-flex justify-content-center col-3 logo-header">
                <img class="logo" src="{{ asset('img/logo.png') }}" alt="">
            </div>
            <div class="d-flex align-items-center col-6 title-header">
                <h2>Tanda Bukti Pengajuan Pendaftaran Siswa Baru Kominfo 2021</h2>
            </div>
            <div class="col-3">&nbsp;</div>
        </div>
        <div class="main mb-5">
            <div class="col-12 info mb-5">
                <h5>Info Pengajuan Pendaftaran</h5>
                <div class="line mb-4"></div>
                <table class="table table-bordered text-center">
                    <thead>
                        <th>Nomor Peserta</th>
                        <th>IP Address</th>
                        <th>Waktu</th>
                    </thead>
                    <tbody>
                        <td>{{ $pendaftar->id }}</td>
                        <td>{{ $user->ip }}</td>
                        <td>{{ $pendaftar->created_at }} WIB</td>
                    </tbody>
                </table>
            </div>
            <div class="d-flex">
                <div class="col-7 biodata">
                    <h5>Biodata Siswa</h5>
                    <div class="line mb-4"></div>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Nomor Peserta</th>
                                <td>{{ $pendaftar->id }}</td>
                            </tr>
                            <tr>
                                <th>Nama Lengkap</th>
                                <td>{{ $pendaftar->nama }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>
                                    @if ($user->jenis_kelamin == 'L')
                                        Laki - laki
                                    @else
                                        Perempuan
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Tempat, Tgl Lahir</th>
                                <td>{{ $user->tempat_lahir }}, {{ date('d-m-Y', strtotime($user->tanggal_lahir)) }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $user->alamat }}</td>
                            </tr>
                            <tr>
                                <th>Sekolah Asal</th>
                                <td>{{ $pendaftar->asal_sekolah }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>No. HP</th>
                                <td>{{ $user->no_hp }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-5 d-flex flex-column">
                    <div class="col-12 nilai mb-4">
                        <h5>Nilai</h5>
                        <div class="line mb-4"></div>
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>B. IND</th>
                                    <th>MTK</th>
                                    <th>IPA</th>
                                    <th>B. ING</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $pendaftar->nilai_bind }}</td>
                                    <td>{{ $pendaftar->nilai_mtk }}</td>
                                    <td>{{ $pendaftar->nilai_ipa }}</td>
                                    <td>{{ $pendaftar->nilai_bing }}</td>
                                </tr>
                                <tr>
                                    <th colspan="2">Rata-rata</th>
                                    <td colspan="2">{{ $pendaftar->rata_rata }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 jurusan">
                        <h5>Pilihan Jurusan</h5>
                        <div class="line mb-4"></div>
                        <div class="box-jurusan py-4">
                            <h3>{{ $pendaftar->jurusan_pilihan }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer py-3">
            &copy; Copyright 2021 - Edwin Risvianto
        </div>
    </div>

    {{-- Javascript --}}
    <script>window.print()</script>
</body>
</html>
