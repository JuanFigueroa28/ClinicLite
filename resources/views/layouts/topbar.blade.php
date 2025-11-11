<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow px-3 justify-content-between">

    <!-- Sección izquierda: Botón + Logo -->
    <div class="d-flex align-items-center">
        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle me-3">
            <i class="fa fa-bars"></i>
        </button>

        <!-- Logo / Título -->
        <h5 class="m-0 fw-bold text-primary text-nowrap d-flex align-items-center">
            <i class="fas fa-clinic-medical text-primary me-2"></i>
            <span>CL Dashboard</span>
        </h5>
    </div>

    <!-- Sección central: Buscador -->
    <form class="d-none d-md-flex align-items-center w-50 mx-auto">
        <div class="input-group w-100">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Buscar paciente..."
                aria-label="Buscar paciente">
            <button class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </form>

    <!-- Sección derecha: Usuario -->
    <ul class="navbar-nav align-items-center ms-auto">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="img-profile rounded-circle border border-primary"
                    src="{{ asset('assets/img/user.png') }}" width="35" height="35" alt="Foto del usuario">
            </a>

            <!-- Dropdown - User Information -->
            <ul class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="#"><i class="fas fa-user-md fa-sm fa-fw me-2 text-gray-400"></i>Mi perfil</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-calendar-check fa-sm fa-fw me-2 text-gray-400"></i>Mis citas</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>Configuración</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>Cerrar sesión
                    </a>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- End of Topbar -->
