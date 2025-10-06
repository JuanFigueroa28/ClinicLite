<!--ClinicLite/resources/views/layouts/app.blade.php-->
<!DOCTYPE html>
<html lang="en">
@include('layouts.head')

<body id="page-top">

    <div id="wrapper">

        {{-- Sidebar --}}
        @include('layouts.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                {{-- Topbar --}}
                @include('layouts.topbar')

                <div class="container-fluid">

                    {{-- ========================================================= --}}
                    {{-- MENSAJES DE ALERTA (ÉXITO / ERROR / VALIDACIÓN) --}}
                    {{-- ========================================================= --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show shadow-sm mt-3" role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show shadow-sm mt-3" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-warning alert-dismissible fade show shadow-sm mt-3" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            Por favor corrige los siguientes errores:
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- ========================================================= --}}
                    {{-- CONTENIDO PRINCIPAL DE CADA VISTA --}}
                    {{-- ========================================================= --}}
                    @yield('content')
                </div>

            </div>

            {{-- Footer --}}
            @include('layouts.footer')

        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Scripts del template -->
    <!-- jQuery (necesario para SB Admin 2) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap JS (bundle incluye Popper.js para modales) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Plugins del template SB Admin 2 -->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>


    {{-- Script para ocultar las alertas automáticamente --}}
    <script>
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000); // 5 segundos
    </script>

    @stack('scripts')
</body>

</html>
