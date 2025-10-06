{{--
    VISTA: Crear nuevo Usuario
    ---------------------------------------------------------------------
    Esta vista permite registrar un nuevo usuario dentro del sistema.
    El campo “Rol” determinará qué tipo de permisos se le asignan.

    RESPONSABILIDADES:
    - FRONTEND: diseño visual del formulario.
    - BACKEND: conectar el formulario con el método store del controlador,
      validar los datos y asignar el rol seleccionado.

    ASIGNACIONES PARA EL BACKEND:
    1. En UsuarioController@create:
         - Retornar esta vista.
         - (Opcional) Enviar lista de roles si se gestiona dinámicamente.

    2. En UsuarioController@store:
         - Validar los campos.
         - Asignar el rol seleccionado.
         - Guardar en la base de datos.
         - Redirigir a index con mensaje de éxito.
--}}

@extends('layouts.app')

@section('title', 'Nuevo Usuario - ClinicLite')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Registrar nuevo usuario</h1>

<div class="card shadow p-4 border-left-secondary">
    <form>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre completo</label>
            {{-- El encargado debe agregar name="nombre" --}}
            <input type="text" id="nombre" class="form-control" placeholder="Ej: María Torres">
        </div>

        <div class="mb-3">
            <label for="correo" class="form-label">Correo electrónico</label>
            {{-- El encargado debe agregar name="email" --}}
            <input type="email" id="correo" class="form-control" placeholder="Ej: usuario@cliniclite.com">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            {{-- El encargado debe agregar name="password" --}}
            <input type="password" id="password" class="form-control">
        </div>

        <div class="mb-3">
            <label for="rol" class="form-label">Rol o categoría</label>
            {{--
                Este campo define el tipo de usuario dentro del sistema.
                El encargado debe reemplazarlo por un SELECT conectado a la BD.
                Los roles pueden ser:
                    - Administrador
                    - Doctor
                    - Paciente
                    - Recepcionista
                    - Invitado
            --}}
            <select id="rol" class="form-control">
                <option>Seleccione una categoría</option>
                <option>Administrador</option>
                <option>Doctor</option>
                <option>Paciente</option>
                <option>Recepcionista</option>
                <option>Invitado</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            {{-- El encargado debe agregar name="estado" --}}
            <select id="estado" class="form-control">
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-secondary">Guardar</button>
        <a href="{{ url('/admin/usuarios') }}" class="btn btn-outline-secondary">Cancelar</a>
    </form>
</div>
@endsection
