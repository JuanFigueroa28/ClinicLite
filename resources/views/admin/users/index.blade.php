{{--
    VISTA: Lista de Usuarios
    ---------------------------------------------------------------------
    Esta vista pertenece al módulo de administración de usuarios.
    Muestra una tabla con los usuarios registrados, sus roles, estado y acciones.

    RESPONSABILIDADES:
    - FRONTEND: estructura, estilo y presentación de los datos.
    - BACKEND: obtener los usuarios desde la base de datos y controlar
      el acceso a las acciones según los roles o permisos.

    ASIGNACIONES PARA EL BACKEND:
    1. Crear el modelo y migración de Usuarios:
         php artisan make:model User -m
       -> Campos: nombre, correo, contraseña, rol, estado, etc.

    2. Crear el controlador:
         php artisan make:controller UsuarioController --resource

    3. En UsuarioController@index:
         - Obtener todos los usuarios de la BD.
         - Retornar esta vista con los datos:
             return view('admin.usuarios.index', ['usuarios' => $usuarios]);

    4. En UsuarioController@destroy:
         - Eliminar usuarios solo si el rol del actual usuario lo permite.

    5. Configurar rutas en routes/web.php:
         Route::resource('usuarios', UsuarioController::class);
--}}

@extends('layouts.app')

@section('title', 'Usuarios - ClinicLite')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Gestión de Usuarios</h1>

<div class="card shadow mb-4 border-left-secondary">
    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold">Lista de usuarios</h6>
        {{--
            BOTÓN NUEVO USUARIO
            ---------------------------------------------------------------------
            - FRONTEND: mantiene diseño y posición.
            - BACKEND: debe enlazar con la vista de creación (usuarios.create)
        --}}
        <a href="{{ url('/admin/usuarios/nuevo') }}" class="btn btn-light btn-sm">
            <i class="fas fa-user-plus"></i> Nuevo Usuario
        </a>
    </div>

    <div class="card-body">
        {{--
            TABLA DE USUARIOS
            ---------------------------------------------------------------------
            RESPONSABLES:
            - FRONTEND: mantener estructura visual.
            - BACKEND: reemplazar los datos por registros reales de la base.
        --}}
        <table class="table table-hover">
            <thead class="table-secondary">
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                {{--
                    DATOS DE EJEMPLO
                    ---------------------------------------------------------------------
                    El encargado del BACKEND debe eliminar estos datos estáticos
                    y usar un @foreach($usuarios as $usuario)
                --}}
                <tr>
                    <td>Admin Principal</td>
                    <td>admin@cliniclite.com</td>
                    <td>Administrador</td>
                    <td><span class="badge bg-success text-white">Activo</span></td>
                    <td>
                        {{--
                            BOTONES DE ACCIÓN
                            ---------------------------------------------------------------------
                            El encargado debe conectar cada botón con su ruta real:
                            - Ver perfil -> route('usuarios.show', $usuario->id)
                            - Editar -> route('usuarios.edit', $usuario->id)
                            - Eliminar -> route('usuarios.destroy', $usuario->id)
                        --}}
                        <a href="#" class="btn btn-info btn-sm">Ver</a>
                        <a href="#" class="btn btn-warning btn-sm">Editar</a>
                        <form method="POST" style="display:inline;">
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>

                <tr>
                    <td>Laura Gómez</td>
                    <td>laura@cliniclite.com</td>
                    <td>Doctora</td>
                    <td><span class="badge bg-success text-white">Activo</span></td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm">Ver</a>
                        <a href="#" class="btn btn-warning btn-sm">Editar</a>
                        <form method="POST" style="display:inline;">
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
