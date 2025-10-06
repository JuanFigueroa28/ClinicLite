{{--
    VISTA: Lista de Roles y Permisos
    ---------------------------------------------------------------------
    Esta vista muestra los roles disponibles dentro del sistema,
    representados visualmente como categorías (Administrador, Doctor, etc.).

    RESPONSABILIDADES:
    - FRONTEND: mostrar los roles de forma visual e intuitiva.
    - BACKEND: obtener los roles reales desde la base de datos
      y manejar las acciones de crear, editar o eliminar.

    ASIGNACIONES PARA EL BACKEND:
    1. Crear el modelo y migración:
         php artisan make:model Rol -m
       -> Campos: nombre, descripcion, nivel_acceso (opcional).

    2. Crear el controlador:
         php artisan make:controller RolController --resource

    3. En RolController@index:
         - Obtener todos los roles y enviarlos a esta vista.
         - Ejemplo:
             return view('admin.roles.index', ['roles' => $roles]);

    4. Configurar rutas:
         Route::resource('roles', RolController::class);
--}}

@extends('layouts.app')

@section('title', 'Roles y Permisos - ClinicLite')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Gestión de Roles y Permisos</h1>

<div class="card shadow mb-4 border-left-warning">
    <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold">Categorías de Usuario</h6>
        <a href="{{ url('/admin/roles/nuevo') }}" class="btn btn-light btn-sm">
            <i class="fas fa-plus"></i> Nuevo Rol
        </a>
    </div>

    <div class="card-body">
        {{--
            SECCIÓN VISUAL DE ROLES
            ---------------------------------------------------------------------
            Cada card representa un tipo de rol.
            El encargado del BACKEND debe reemplazar los datos estáticos
            con registros reales desde la base de datos.
        --}}
        <div class="row">
            {{-- Rol: Administrador --}}
            <div class="col-md-4 mb-4">
                <div class="card border-left-danger shadow h-100">
                    <div class="card-body">
                        <h5 class="text-danger"><i class="fas fa-user-shield"></i> Administrador</h5>
                        <p class="mb-3 text-muted">Tiene acceso total al sistema, incluyendo configuración,
                        usuarios, roles, citas y agenda.</p>
                        {{-- Simulación visual: este botón abre la vista de edición --}}
                        <a href="{{ url('/admin/roles/editar') }}" class="btn btn-warning btn-sm">Editar</a>
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </div>
                </div>
            </div>

            {{-- Rol: Doctor --}}
            <div class="col-md-4 mb-4">
                <div class="card border-left-success shadow h-100">
                    <div class="card-body">
                        <h5 class="text-success"><i class="fas fa-user-md"></i> Doctor</h5>
                        <p class="mb-3 text-muted">Puede gestionar sus pacientes, ver citas asignadas y
                        actualizar diagnósticos.</p>
                        <a href="{{ url('/admin/roles/editar') }}" class="btn btn-warning btn-sm">Editar</a>
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </div>
                </div>
            </div>

            {{-- Rol: Paciente --}}
            <div class="col-md-4 mb-4">
                <div class="card border-left-info shadow h-100">
                    <div class="card-body">
                        <h5 class="text-info"><i class="fas fa-user"></i> Paciente</h5>
                        <p class="mb-3 text-muted">Accede a su historial médico, citas y puede registrar solicitudes.</p>
                        <a href="{{ url('/admin/roles/editar') }}" class="btn btn-warning btn-sm">Editar</a>
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </div>
                </div>
            </div>

            {{-- Rol: Recepcionista --}}
            <div class="col-md-4 mb-4">
                <div class="card border-left-primary shadow h-100">
                    <div class="card-body">
                        <h5 class="text-primary"><i class="fas fa-user-tie"></i> Recepcionista</h5>
                        <p class="mb-3 text-muted">Administra las citas, agenda diaria y controla la comunicación
                        entre pacientes y doctores.</p>
                        <a href="{{ url('/admin/roles/editar') }}" class="btn btn-warning btn-sm">Editar</a>
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </div>
                </div>
            </div>

            {{-- Rol: Invitado --}}
            <div class="col-md-4 mb-4">
                <div class="card border-left-secondary shadow h-100">
                    <div class="card-body">
                        <h5 class="text-secondary"><i class="fas fa-user"></i> Invitado</h5>
                        <p class="mb-3 text-muted">Puede visualizar información básica del sistema, pero sin permisos
                        de modificación.</p>
                        <a href="{{ url('/admin/roles/editar') }}" class="btn btn-warning btn-sm">Editar</a>
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
