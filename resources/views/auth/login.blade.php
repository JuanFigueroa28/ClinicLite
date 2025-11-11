<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - ClinicLite</title>

    <!-- SB Admin 2 - CSS -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-6 col-md-8">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-5">
                        <!-- Nested Row -->
                        <div class="text-center mb-4">
                            <h1 class="h4 text-gray-900 mt-3">Bienvenido a ClinicLite</h1>
                        </div>

                        <form method="POST" action="{{ route('login') }}" class="user">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="email" name="email" class="form-control form-control-user"
                                       placeholder="Correo electrónico" required autofocus>
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" name="password" class="form-control form-control-user"
                                       placeholder="Contraseña" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Iniciar sesión
                            </button>
                        </form>

                        @if ($errors->any())
                            <div class="alert alert-danger mt-3">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- SB Admin 2 - JS -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>
</html>
