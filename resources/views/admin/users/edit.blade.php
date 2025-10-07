{{--
    VISTA: Editar Usuario
    ---------------------------------------------------------------------
    Esta vista permite modificar los datos de un usuario existente.
    También se utiliza para cambiar su rol o estado.

    RESPONSABILIDADES:
    - FRONTEND: mantener diseño y estructura visual.
    - BACKEND: cargar datos actuales del usuario y actualizar la información
      mediante el método update() del controlador.

    ASIGNACIONES PARA EL BACKEND:
    1. En UsuarioController@edit:
         - Obtener el usuario a editar y pasarlo a esta vista.
    2. En UsuarioController@update:
         - Validar los cambios.
         - Guardar en la base de datos.
         - Redirigir con mensaje de confirmación.
--}}

@extends('layouts.app')

@section('title', 'Editar Usuario - ClinicLite')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Editar usuario</h1>

<div class="card shadow p-4 border-left-secondary">
    <form>
        {{--
            El encargado del BACKEND debe completar los atributos "value"
            con los datos del usuario a editar, por ejemplo:
            value="{{ $usuario->nombre }}"
        --}}
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre completo</label>
            <input type="text" id="nombre" class="form-control" value="Laura Gómez">
        </div>

        <div class="mb-3">
            <label for="correo" class="form-label">Correo electrónico</label>
            <input type="email" id="correo" class="form-control" value="laura@cliniclite.com">
        </div>

        <div class="mb-3">
            <label for="rol" class="form-label">Rol o categoría</label>
            {{--
                El encargado debe mantener las opciones fijas (no checkboxes).
                Al seleccionar el rol, el backend ajustará los permisos asociados.
            --}}
            <select id="rol" class="form-control">
                <option>Administrador</option>
                <option selected>Doctor</option>
                <option>Paciente</option>
                <option>Recepcionista</option>
                <option>Invitado</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select id="estado" class="form-control">
                <option value="activo" selected>Activo</option>
                <option value="inactivo">Inactivo</option>
            </select>
        </div>

        {{--
            BOTONES DE ACCIÓN
            ---------------------------------------------------------------------
            - "Guardar cambios" envía el formulario al método update().
            - "Cancelar" regresa al listado de usuarios.
        --}}
        <button type="submit" class="btn btn-secondary">Guardar cambios</button>
        <a href="{{ url('/admin/usuarios') }}" class="btn btn-outline-secondary">Cancelar</a>
    </form>
</div>
@endsection
