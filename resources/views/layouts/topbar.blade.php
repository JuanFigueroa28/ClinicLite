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
            <i class="fas fa-clinic-medical text-primary" style="margin-right: 0.5rem; font-size: 1.2rem;"></i>
            <span>CL Dashboard</span>
        </h5>

    </div>

    <!-- Sección central: Buscador (solo visible desde md) -->
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
        <li class="nav-item dropdown no-arrow position-relative">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="img-profile rounded-circle border border-primary" src="{{ asset('https://tse3.mm.bing.net/th/id/OIP.o5O-0C1UW1Fjx7mvthFDLwHaHa?rs=1&pid=ImgDetMain&o=7&rm=3') }}"
                    width="35" height="35" alt="Foto del usuario">
            </a>

            <!-- Dropdown - User Information -->
            <ul class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="userDropdown"
                style="right: 0; left: auto; transform: translateX(-10px); min-width: 12rem;">
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user-md fa-sm fa-fw me-2 text-gray-400"></i>Mi perfil
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-calendar-check fa-sm fa-fw me-2 text-gray-400"></i>Mis citas
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>Configuración
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>Cerrar sesión
                    </a>
                </li>
            </ul>
        </li>
    </ul>

</nav>
<!-- End of Topbar -->
