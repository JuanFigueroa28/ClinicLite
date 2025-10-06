{{--
    VISTA: Editar Rol
    ---------------------------------------------------------------------
    Esta vista permite modificar el nombre, descripción o categoría base
    de un rol existente.

    RESPONSABILIDADES:
    - FRONTEND: mantener la estructura visual.
    - BACKEND: precargar datos del rol seleccionado y guardar los cambios.
--}}

@extends('layouts.app')

@section('title', 'Editar Rol - ClinicLite')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Editar rol</h1>

<div class="card shadow p-4 border-left-warning">
    <form>
        {{--
            El encargado debe agregar:
            - method="POST"
            - action="{{ route('roles.update', $rol->id ?? '') }}"
            - @method('PUT')
            - @csrf
        --}}
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del rol</label>
            <input type="text" id="nombre" class="form-control" value="Doctor">
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea id="descripcion" class="form-control" rows="3">Accede a su listado de pacientes, agenda y diagnósticos.</textarea>
        </div>

        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría base</label>
            <select id="categoria" class="form-control">
                <option value="administrador">Administrador</option>
                <option value="doctor" selected>Doctor</option>
                <option value="paciente">Paciente</option>
                <option value="recepcionista">Recepcionista</option>
                <option value="invitado">Invitado</option>
            </select>
        </div>

        <button type="submit" class="btn btn-warning">Guardar cambios</button>
        <a href="{{ url('/admin/roles') }}" class="btn btn-outline-warning">Cancelar</a>
    </form>
</div>
@endsection
