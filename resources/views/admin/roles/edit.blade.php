@extends('layouts.app')

@section('title', 'Editar Rol - ClinicLite')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Editar rol</h1>

<div class="card shadow p-4 border-left-warning">
    {{--
        FORMULARIO PARA EDITAR UN ROL EXISTENTE
        ---------------------------------------------------------------------
        Este formulario precarga los datos del rol recibido desde el controlador
        RolesController@edit y envía la actualización a RolesController@update.
    --}}
    <form method="POST" action="{{ route('roles.update', $rol->id) }}">
        @csrf
        @method('PUT')

        {{-- Campo: Nombre del rol --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nombre del rol</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name', $rol->name) }}"
                class="form-control @error('name') is-invalid @enderror"
                required
            >
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Campo: Descripción --}}
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea
                id="description"
                name="description"
                class="form-control @error('description') is-invalid @enderror"
                rows="3"
            >{{ old('description', $rol->description) }}</textarea>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Campo: Categoría base (opcional, visual) --}}
        <div class="mb-3">
            <label for="category" class="form-label">Categoría base</label>
            <select id="category" name="category" class="form-control">
                <option value="">Seleccione una categoría</option>
                <option value="Administrador" {{ $rol->name === 'Administrador' ? 'selected' : '' }}>Administrador</option>
                <option value="Doctor" {{ $rol->name === 'Doctor' ? 'selected' : '' }}>Doctor</option>
                <option value="Paciente" {{ $rol->name === 'Paciente' ? 'selected' : '' }}>Paciente</option>
                <option value="Recepcionista" {{ $rol->name === 'Recepcionista' ? 'selected' : '' }}>Recepcionista</option>
                <option value="Invitado" {{ $rol->name === 'Invitado' ? 'selected' : '' }}>Invitado</option>
            </select>
        </div>

        {{-- Botones de acción --}}
        <div class="d-flex justify-content-start">
            <button type="submit" class="btn btn-warning me-2">
                <i class="fas fa-save"></i> Guardar cambios
            </button>
            <a href="{{ route('roles.index') }}" class="btn btn-outline-warning">
                <i class="fas fa-times"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
