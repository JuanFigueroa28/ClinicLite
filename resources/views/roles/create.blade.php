@extends('layouts.app')

@section('title', 'Crear Rol - ClinicLite')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 text-gray-800">Crear nuevo rol</h1>
    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary shadow-sm">
        <i class="fas fa-arrow-left me-1"></i> Volver a la lista
    </a>
</div>

<div class="card shadow border-left-warning">
    <div class="card-body">
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf

            {{-- Nombre y descripción del rol --}}
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Nombre del rol <span class="text-danger">*</span></label>
                <input type="text" id="name" name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       placeholder="Ej: Recepcionista" value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="form-label fw-bold">Descripción</label>
                <textarea id="description" name="description" rows="3"
                          class="form-control @error('description') is-invalid @enderror"
                          placeholder="Describe brevemente las funciones o permisos de este rol">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Permisos --}}
            <h5 class="fw-bold text-warning mb-3">
                <i class="fas fa-key"></i> Asignar permisos
            </h5>

            <div class="alert alert-light border-start border-3 border-warning shadow-sm mb-4">
                <small>
                    Marca los permisos que este rol podrá realizar dentro del sistema.
                </small>
            </div>

            <div class="row">
                @php
                    // Agrupamos permisos por su prefijo
                    $groupedPermissions = [
                        'Usuarios' => $permissions->filter(fn($p) => str_contains($p->slug, 'user')),
                        'Roles y Permisos' => $permissions->filter(fn($p) => str_contains($p->slug, 'role') || str_contains($p->slug, 'permission')),
                        'Agenda y Horarios' => $permissions->filter(fn($p) => str_contains($p->slug, 'schedule') || str_contains($p->slug, 'agenda')),
                        'Citas' => $permissions->filter(fn($p) => str_contains($p->slug, 'appointment')),
                        'Perfil y Autenticación' => $permissions->filter(fn($p) => str_contains($p->slug, 'profile') || str_contains($p->slug, 'login') || str_contains($p->slug, 'logout')),
                    ];
                @endphp

                @foreach ($groupedPermissions as $category => $items)
                    @if ($items->isNotEmpty())
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="border rounded shadow-sm h-100 p-3">
                                <h6 class="fw-bold text-secondary mb-3">
                                    <i class="fas fa-folder-open me-1"></i> {{ $category }}
                                </h6>

                                @foreach ($items as $permission)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox"
                                               id="perm-{{ $permission->id }}"
                                               name="permissions[]"
                                               value="{{ $permission->id }}"
                                               {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label small" for="perm-{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- Botones --}}
            <div class="mt-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-warning fw-bold shadow-sm px-4">
                    <i class="fas fa-save me-1"></i> Guardar rol
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Estilos personalizados --}}
<style>
    .border-start {
        border-left: 5px solid #f6c23e !important;
    }
    .form-check-input:checked {
        background-color: #f6c23e;
        border-color: #f6c23e;
    }
    .form-check-label:hover {
        color: #111;
    }
</style>
@endsection
