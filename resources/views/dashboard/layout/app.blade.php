<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('css/calender.css')}}">
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <title>@yield('title')</title>
</head>
<body>
    <div>
        <nav class="navbar fixed-top shadow-sm navbar-light">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">PSB Online Kominfo</span>
                <div class="nav-user d-flex align-items-center">
                    <div class="avatar">
                        @if ( auth()->user()->jenis_kelamin == 'P' )
                            <img src="{{asset('img/avatar-cewe.svg')}}">
                        @else
                            <img src="{{asset('img/avatar-cowo.svg')}}">
                        @endif
                    </div>
                    <div class="nav-username dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="logoutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @auth {{ auth()->user()->nama }} @endauth
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="logoutDropdown">
                            <li>
                                <form action="/logout" method="POST">
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
            <div class="col-md-9 main">
                <div class="banner">
                    <p>Halo, <b>{{ auth()->user()->nama }}!</b></p>
                    <h4>Selamat datang di PSB Online Kominfo 2021</h4>
                    Daftar dan pantau terus status pendaftaran mu ya!
                </div>
                @yield('content')
            </div>
            <div class="col-md-3 sidebar">
                <div class="calendar">
					<div class="header">
						<a data-action="prev-month" href="javascript:void(0)" title="Previous Month"><i></i></a>
						<div class="text" data-render="month-year"></div>
						<a data-action="next-month" href="javascript:void(0)" title="Next Month"><i></i></a>
					</div>
					<div class="months" data-flow="left">
						<div class="month month-a">
							<div class="render render-a"></div>
						</div>
						<div class="month month-b">
							<div class="render render-b"></div>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>


    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  	<script src="{{ asset('js/popper.js') }}"></script>
  	<script src="{{ asset('js/main.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#bind, #mtk", "#ipa", "#bing").keyup(function() {
                var bind  = $("#bind").val();
                var mtk = $("#mtk").val();
                var ipa = $("#ipa").val();
                var bing = $("#bing").val();

                var rata = (harga + mtk + ipa + bing) / 4;
                $("#rata").val(rata);
            });
        });
    </script>
</body>
</html>
