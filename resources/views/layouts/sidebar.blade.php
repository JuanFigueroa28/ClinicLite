{{-- SIDEBAR GENERAL - CLINICLITE --}}
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-stethoscope"></i>
        </div>
        <div class="sidebar-brand-text mx-3">ClinicLite</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Gestión Clínica</div>

    {{-- ===================== USUARIOS ===================== --}}
    @if (\App\Helpers\RoleHelper::isAuthorized('view-users'))
        <li class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsuarios"
                aria-expanded="{{ request()->is('users*') ? 'true' : 'false' }}" aria-controls="collapseUsuarios">
                <i class="fas fa-users"></i>
                <span>Usuarios</span>
            </a>

            <div id="collapseUsuarios" class="collapse {{ request()->is('users*') ? 'show' : '' }}"
                aria-labelledby="headingUsuarios" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Gestión de usuarios:</h6>
                    <a class="collapse-item {{ request()->routeIs('users.index') ? 'active' : '' }}"
                       href="{{ route('users.index') }}">
                        Lista de usuarios
                    </a>
                    @if (\App\Helpers\RoleHelper::isAuthorized('create-user'))
                        <a class="collapse-item {{ request()->routeIs('users.create') ? 'active' : '' }}"
                           href="{{ route('users.create') }}">
                            Nuevo usuario
                        </a>
                    @endif
                </div>
            </div>
        </li>
    @endif

    {{-- ===================== ROLES Y PERMISOS ===================== --}}
    @if (\App\Helpers\RoleHelper::isAuthorized('view-roles'))
        <li class="nav-item {{ request()->is('roles*') ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRoles"
                aria-expanded="{{ request()->is('roles*') ? 'true' : 'false' }}" aria-controls="collapseRoles">
                <i class="fas fa-user-shield"></i>
                <span>Roles y Permisos</span>
            </a>

            <div id="collapseRoles" class="collapse {{ request()->is('roles*') ? 'show' : '' }}"
                aria-labelledby="headingRoles" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Gestión de roles:</h6>
                    <a class="collapse-item {{ request()->routeIs('roles.index') ? 'active' : '' }}"
                       href="{{ route('roles.index') }}">
                        Lista de roles
                    </a>
                    @if (\App\Helpers\RoleHelper::isAuthorized('create-role'))
                        <a class="collapse-item {{ request()->routeIs('roles.create') ? 'active' : '' }}"
                           href="{{ route('roles.create') }}">
                            Nuevo rol
                        </a>
                    @endif
                </div>
            </div>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="sidebar-heading">Cuenta</div>

    <!-- Perfil -->
    <li class="nav-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('profile.edit') }}">
            <i class="fas fa-user-circle"></i>
            <span>Perfil</span>
        </a>
    </li>

    <!-- Logout -->
    <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link btn btn-link text-start text-white w-100">
                <i class="fas fa-sign-out-alt"></i> Cerrar sesión
            </button>
        </form>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
