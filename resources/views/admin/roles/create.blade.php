@extends('layouts.app')

@section('title', 'Nuevo Rol - ClinicLite')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Registrar nuevo rol</h1>

    <div class="card shadow p-4 border-left-warning">
        {{--
        FORMULARIO PARA CREAR UN NUEVO ROL
        ---------------------------------------------------------------------
        Este formulario envía los datos al controlador RolesController@store
        usando el método POST. Se protege con @csrf contra ataques CSRF.
    --}}
        <form method="POST" action="{{ route('roles.store') }}">
            @csrf

            {{-- Campo: Nombre del rol --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nombre del rol</label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                    placeholder="Ej: Administrador, Doctor, Paciente..." value="{{ old('name') }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Campo: Descripción del rol --}}
            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror"
                    rows="3" placeholder="Breve descripción del rol y sus responsabilidades">{{ old('description') }}</textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Campo: Categoría base (referencia visual, no obligatoria) --}}
            <div class="mb-3">
                <label for="category" class="form-label">Categoría base</label>
                <select id="category" name="category" class="form-control">
                    <option value="">Seleccione una categoría</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Doctor">Doctor</option>
                    <option value="Paciente">Paciente</option>
                    <option value="Recepcionista">Recepcionista</option>
                    <option value="Recepcionista">Empleado Común</option>
                    <option value="Invitado">Invitado</option>
                </select>
            </div>

            {{-- Botones de acción --}}
            <div class="d-flex justify-content-start">
                <button type="submit" class="btn btn-warning" style="margin-right: 1rem;">
                    <i class="fas fa-save"></i> Guardar
                </button>
                <a href="{{ route('roles.index') }}" class="btn btn-outline-warning">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection
