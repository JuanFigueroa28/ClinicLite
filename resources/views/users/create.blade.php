@extends('layouts.app')

@section('title', 'Nuevo Usuario - ClinicLite')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Registrar nuevo usuario</h1>

<div class="card shadow p-4 border-left-primary">
    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        {{-- Nombres --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="first_name" class="form-label">Nombre</label>
                <input type="text" id="first_name" name="first_name"
                       value="{{ old('first_name') }}"
                       class="form-control @error('first_name') is-invalid @enderror"
                       placeholder="Ej: Juan">
                @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="last_name" class="form-label">Apellido</label>
                <input type="text" id="last_name" name="last_name"
                       value="{{ old('last_name') }}"
                       class="form-control @error('last_name') is-invalid @enderror"
                       placeholder="Ej: Pérez">
                @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Documento --}}
        <div class="mb-3">
            <label for="document" class="form-label">Documento</label>
            <input type="text" id="document" name="document"
                   value="{{ old('document') }}"
                   class="form-control @error('document') is-invalid @enderror"
                   placeholder="Ej: 1234567890">
            @error('document')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Correo --}}
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" id="email" name="email"
                   value="{{ old('email') }}"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="Ej: usuario@cliniclite.com">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Contraseña --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" id="password" name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       placeholder="Mínimo 6 caracteres">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                       class="form-control" placeholder="Repite la contraseña">
            </div>
        </div>

        {{-- Rol --}}
        <div class="mb-3">
            <label for="role_id" class="form-label">Rol o categoría</label>
            <select id="role_id" name="role_id"
                    class="form-select @error('role_id') is-invalid @enderror">
                <option value="">Seleccione un rol</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
            @error('role_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Estado --}}
        <div class="mb-3">
            <label for="status" class="form-label">Estado</label>
            <select id="status" name="status" class="form-select">
                <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        {{-- Teléfono y Dirección --}}
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="phone" class="form-label">Teléfono</label>
                <input type="text" id="phone" name="phone"
                       value="{{ old('phone') }}"
                       class="form-control @error('phone') is-invalid @enderror"
                       placeholder="Ej: 3001234567">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="address" class="form-label">Dirección</label>
                <input type="text" id="address" name="address"
                       value="{{ old('address') }}"
                       class="form-control @error('address') is-invalid @enderror"
                       placeholder="Ej: Calle 10 #12-34">
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Botones --}}
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Guardar usuario
            </button>
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
