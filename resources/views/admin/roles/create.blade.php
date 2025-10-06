{{--
    VISTA: Crear nuevo Rol
    ---------------------------------------------------------------------
    Esta vista permite registrar un nuevo rol/categoría dentro del sistema.
    El diseño evita checkboxes y se basa en categorías predefinidas.

    RESPONSABILIDADES:
    - FRONTEND: estructura visual.
    - BACKEND: guardar el nuevo rol en la base de datos.
--}}

@extends('layouts.app')

@section('title', 'Nuevo Rol - ClinicLite')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Registrar nuevo rol</h1>

<div class="card shadow p-4 border-left-warning">
    <form>
        {{--
            El encargado debe agregar:
            - method="POST"
            - action="{{ route('roles.store') }}"
            - @csrf
        --}}
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del rol</label>
            {{-- El encargado debe agregar name="nombre" --}}
            <input type="text" id="nombre" class="form-control" placeholder="Ej: Coordinador, Visitante, etc.">
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            {{-- El encargado debe agregar name="descripcion" --}}
            <textarea id="descripcion" class="form-control" rows="3" placeholder="Breve descripción del rol y sus responsabilidades"></textarea>
        </div>

        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría base</label>
            {{--
                El encargado debe agregar name="categoria".
                Las categorías sirven como referencia de permisos predeterminados.
            --}}
            <select id="categoria" class="form-control">
                <option value="">Seleccione una categoría</option>
                <option value="administrador">Administrador</option>
                <option value="doctor">Doctor</option>
                <option value="paciente">Paciente</option>
                <option value="recepcionista">Recepcionista</option>
                <option value="invitado">Invitado</option>
            </select>
        </div>

        <button type="submit" class="btn btn-warning">Guardar</button>
        <a href="{{ url('/admin/roles') }}" class="btn btn-outline-warning">Cancelar</a>
    </form>
</div>
@endsection
