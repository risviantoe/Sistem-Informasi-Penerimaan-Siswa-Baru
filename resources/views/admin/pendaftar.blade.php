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
                    <a class="nav-link" href="/admin/dashboard/pengguna">Data Pengguna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/admin/dashboard/pendaftar">Data Pendaftar</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-section my-3 mb-5">
    <div class="section section-chart px-4 py-4">
        <h6>Grafik Pendaftar</h6>
        <div class="line mb-4"></div>
        <canvas class="col-12" id="chart"></canvas>
    </div>
    <div class="container-pengguna">
        <div class="section section-pengguna mb-3 px-4 py-4">
            <h6>Jumlah Pendaftar</h6>
            <div class="line mb-4"></div>
            <div class="d-flex justify-content-center">
                <div class="circle jml-pendaftar">
                    {{ $jmlPendaftar }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section col-12 mb-5 px-4 py-4">
    <div class="d-flex justify-content-between">
        <div class="table-title">
            <h6>Data Pendaftar</h6>
            <div class="line mb-4"></div>
        </div>
        <div class="search px-3">
            <form action="/admin/dashboard/pendaftar">
                <div class="input-group mb-3">
                    <input name="search" id="search" type="text" class="form-control" placeholder="Cari.." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit" id="button-search"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-striped table-borderless table-hover">
        <thead>
            <th>No</th>
            <th>No Pendaftaran</th>
            <th>Nama</th>
            <th>Jurusan Dipilih</th>
            <th style="text-align: center">B.Ind</th>
            <th style="text-align: center">MTK</th>
            <th style="text-align: center">IPA</th>
            <th style="text-align: center">B.Ing</th>
            <th style="text-align: center">Rata-rata</th>
            <th>Status</th>
            <th style="text-align: center">Action</th>
        </thead>
        <tbody>
            @foreach ($pendaftar as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td style="font-weight: 600">{{ $item->id }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jurusan_pilihan }}</td>
                    <td style="text-align: center">{{ $item->nilai_bind }}</td>
                    <td style="text-align: center">{{ $item->nilai_mtk }}</td>
                    <td style="text-align: center">{{ $item->nilai_ipa }}</td>
                    <td style="text-align: center">{{ $item->nilai_bing }}</td>
                    <td style="text-align: center">{{ $item->rata_rata }}</td>
                    <td>
                        <span class="badge rounded-pill
                        @if ($item->status === 'Proses Seleksi')
                            proses
                        @elseif ($item->status === 'Diterima')
                            lolos
                        @elseif ($item->status === 'Belum Diterima')
                            tdk-lolos
                        @else
                            cadangan
                        @endif
                        ">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td style="text-align: center">
                        <a href="/admin/dashboard/pendaftar/{{ $item->id }}/detail" class="btn link btn-action"><i class="bi bi-box-arrow-up-right"></i></a>
                        <a href="/admin/dashboard/pendaftar/{{ $item->id }}/edit" class="btn link btn-action"><i class="bi bi-pencil-square"></i></a>
                        <a href="/admin/dashboard/pendaftar/{{ $item->id }}/delete" onclick="return sweetDel(event)" class="btn link btn-action"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        {{ $pendaftar->links() }}
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.4.1/dist/chart.min.js"></script>
<script type="text/javascript">
    var ctx = document.getElementById('chart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['sen', 'sel', 'rab', 'kam', 'jum', 'sab', 'min'],
            datasets: [
                {
                    backgroundColor: ['rgba(255, 206, 86, 0.2)'],
                    borderColor: ['rgba(255, 206, 86, 1)'],
                    label: 'Pendaftar',
                    data: @php echo json_encode($chartPendaftar); @endphp
                }
            ],
            options: {
                animation: {
                    onProgress: function(animation) {
                        progress.value = animation.animationObject.currentStep / animation.animationObject.numSteps;
                    }
                }
            }
        },
    });
</script>

@endsection
