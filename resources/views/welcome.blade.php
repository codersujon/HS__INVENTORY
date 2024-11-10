<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('logo/logo.png') }}" type="image/png" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('backend') }}/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('backend') }}/assets/css/app.css" rel="stylesheet">
    <link href="{{ asset('backend') }}/assets/css/icons.css" rel="stylesheet">
    <title>Hypershop.com.bd</title>
</head>

<body class="bg-login">

    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
                    <div class="col mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="form-body">
                                        <div class="mb-4 text-center">
                                            <img src="{{ asset('logo/logo.png') }}" width="130" alt="logo" />
                                        </div>
                                        <div class="text-center">
                                            @if (Route::has('login'))
                                                <nav class="p-3">
                                                    @auth
                                                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                                                    @else
                                                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Log in</a>
                                                        {{-- @if (Route::has('register'))
                                                            <a href="{{ route('register') }}" class="btn mx-2 btn-primary btn-sm">Register</a>
                                                        @endif --}}
                                                    @endauth
                                                </nav>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->

    <!-- Bootstrap JS -->
    <script src="{{ asset('backend') }}/assets/js/bootstrap.bundle.min.js"></script>
    <!--app JS-->
    <script src="{{ asset('backend') }}/assets/js/app.js"></script>
</body>

</html>
