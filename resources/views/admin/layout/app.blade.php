<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <title>@yield('title')</title>
</head>
<body>
    <div>
        <nav class="navbar fixed-top shadow-sm navbar-light">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">PSB Online Kominfo</span>
                <div class="nav-user d-flex align-items-center">
                    <div class="avatar">
                        <img src="{{asset('img/avatar-cowo.svg')}}">
                    </div>
                    <div class="nav-username dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="logoutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @auth {{ auth()->user()->nama }} @endauth
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="logoutDropdown">
                            <li>
                                <form action="/admin/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="d-flex">
            <div class="col-md-12 main">
                <div class="banner">
                    <p>Halo, <b>{{ auth()->user()->nama }}!</b></p>
                    <h4>Selamat Datang di Dashboard Admin PSB Online Kominfo</h4>
                </div>
                @yield('content')
            </div>
            {{-- <div class="col-md-3 sidebar"></div> --}}
        </div>
    </div>

    <!-- Javascript -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function sweetDel(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
            console.log(urlToRedirect); // verify if this is the right URL
            swal({
                title: "Kamu Yakin?",
                text: "Data yang dihapus tidak dapat dikembalikan lagi!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                // redirect with javascript here as per your logic after showing the alert using the urlToRedirect value
                if (willDelete) {
                    // window.location.href = urlToRedirect;
                    swal("Data berhasil dihapus!", {
                        icon: "success",
                    })
                    .then(() => {
                        window.location.href = urlToRedirect;
                    });
                }
            });
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
