{{--
    SIDEBAR GENERAL - CLINICLITE
    ---------------------------------------------------------------------
    Este menú lateral incluye todas las secciones principales del sistema,
    organizadas según los módulos de la matriz.

    RESPONSABILIDADES:
    - FRONTEND: mantener diseño, estructura y activación visual.
    - BACKEND: conectar los enlaces con las rutas y controladores reales.

    SECCIONES:
    1. Gestión Clínica: Pacientes, Doctores, Citas, Agenda.
    2. Administración: Usuarios, Roles y Permisos.
    3. Cuenta: Perfil y Cerrar Sesión.
--}}


<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/admin') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">ClinicLite</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('admin') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/admin') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Gestión Clínica</div>

    <!-- Pacientes -->
    <li class="nav-item {{ request()->is('admin/pacientes*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePacientes"
            aria-expanded="true" aria-controls="collapsePacientes">
            <i class="fas fa-user-injured"></i>
            <span>Pacientes</span>
        </a>
        <div id="collapsePacientes" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('/admin/pacientes') }}">Lista</a>
                <a class="collapse-item" href="{{ url('/admin/pacientes/nuevo') }}">Nuevo paciente</a>
            </div>
        </div>
    </li>

    <!-- Doctores -->
    <li class="nav-item {{ request()->is('admin/doctores*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDoctores"
            aria-expanded="true" aria-controls="collapseDoctores">
            <i class="fas fa-user-md"></i>
            <span>Doctores</span>
        </a>
        <div id="collapseDoctores" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('/admin/doctores') }}">Lista</a>
                <a class="collapse-item" href="{{ url('/admin/doctores/nuevo') }}">Nuevo doctor</a>
            </div>
        </div>
    </li>

    <!-- Citas -->
    <li class="nav-item {{ request()->is('admin/citas*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCitas"
            aria-expanded="true" aria-controls="collapseCitas">
            <i class="fas fa-calendar-check"></i>
            <span>Citas</span>
        </a>
        <div id="collapseCitas" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('/admin/citas') }}">Lista</a>
                <a class="collapse-item" href="{{ url('/admin/citas/nueva') }}">Nueva cita</a>
            </div>
        </div>
    </li>

    <!-- Agenda -->
    <li class="nav-item {{ request()->is('admin/agenda*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/admin/agenda') }}">
            <i class="fas fa-calendar-alt"></i>
            <span>Agenda / Horarios</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Administración</div>

    <!-- Usuarios -->
    <li class="nav-item {{ request()->is('admin/usuarios*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsuarios"
            aria-expanded="true" aria-controls="collapseUsuarios">
            <i class="fas fa-users"></i>
            <span>Usuarios</span>
        </a>
        <div id="collapseUsuarios" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('/admin/usuarios') }}">Lista</a>
                <a class="collapse-item" href="{{ url('/admin/usuarios/nuevo') }}">Nuevo usuario</a>
            </div>
        </div>
    </li>

    <!-- Roles y Permisos -->
    <li class="nav-item {{ request()->is('admin/roles*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRoles"
            aria-expanded="true" aria-controls="collapseRoles">
            <i class="fas fa-user-shield"></i>
            <span>Roles y Permisos</span>
        </a>
        <div id="collapseRoles" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('/admin/roles') }}">Lista</a>
                <a class="collapse-item" href="{{ url('/admin/roles/nuevo') }}">Nuevo rol</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">Cuenta</div>

    <!-- Perfil -->
    <li class="nav-item {{ request()->is('admin/perfil*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/admin/perfil') }}">
            <i class="fas fa-user-circle"></i>
            <span>Perfil</span>
        </a>
    </li>

    <!-- Logout -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/logout') }}">
            <i class="fas fa-sign-out-alt"></i>
            <span>Cerrar sesión</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
