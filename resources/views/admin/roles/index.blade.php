@extends('layouts.app')

@section('title', 'Roles y Permisos - ClinicLite')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Gestión de Roles y Permisos</h1>
        <a href="{{ route('roles.create') }}" class="btn btn-warning fw-bold shadow-sm px-3">
            <i class="fas fa-plus-circle me-1"></i> Crear nuevo rol
        </a>
    </div>


    <div class="card shadow-sm border-left-warning">
        <div class="card-header bg-warning bg-gradient text-dark d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold text-uppercase">
                <i class="fas fa-user-shield me-1"></i> Lista de Roles
            </h6>
        </div>

        <div class="card-body">
            <div class="row">
                {{-- Si existen roles en la base de datos --}}
                @if ($roles->count() > 0)
                    @foreach ($roles as $rol)
                        @php
                            $roleStyles = [
                                'Administrador' => ['color' => 'danger', 'icon' => 'fa-user-shield'],
                                'Doctor' => ['color' => 'success', 'icon' => 'fa-user-md'],
                                'Paciente' => ['color' => 'info', 'icon' => 'fa-user'],
                                'Recepcionista' => ['color' => 'primary', 'icon' => 'fa-user-tie'],
                                'Invitado' => ['color' => 'secondary', 'icon' => 'fa-user'],
                            ];
                            $style = $roleStyles[$rol->name] ?? ['color' => 'warning', 'icon' => 'fa-user-cog'];
                        @endphp

                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card shadow-sm border-start border-4 border-{{ $style['color'] }} role-card h-100">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="fw-bold text-{{ $style['color'] }}">
                                            <i class="fas {{ $style['icon'] }}"></i>
                                            {{ $rol->name }}
                                        </h5>
                                        <p class="text-muted small mb-3">
                                            {{ $rol->description ?? 'Sin descripción disponible.' }}
                                        </p>
                                    </div>

                                    <div class="d-flex mt-2">
                                        <a href="{{ route('roles.edit', $rol->id) }}"
                                            class="btn btn-outline-warning btn-sm px-3 me-5">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <button type="button" class="btn btn-outline-danger btn-sm px-3"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal{{ $rol->id }}">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Modal de confirmación --}}
                        <div class="modal fade" id="deleteModal{{ $rol->id }}" tabindex="-1"
                            aria-labelledby="deleteModalLabel{{ $rol->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content shadow-lg border-0 rounded-3">
                                    <form action="{{ route('roles.destroy', $rol->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $rol->id }}">
                                                <i class="fas fa-exclamation-triangle me-2"></i> Confirmar eliminación
                                            </h5>
                                            <button type="button"
                                                class="btn btn-sm btn-light text-danger fw-bold shadow-sm"
                                                data-bs-dismiss="modal">
                                                <i class="fas fa-times"></i>
                                            </button>

                                        </div>

                                        <div class="modal-body text-center py-4">
                                            <p>¿Seguro que deseas eliminar el rol <strong>{{ $rol->name }}</strong>?</p>
                                            <p class="text-muted small">Esta acción no se puede deshacer.</p>
                                        </div>

                                        <div class="modal-footer justify-content-center border-0 pb-4">
                                            <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">
                                                <i class="fas fa-times"></i> Cancelar
                                            </button>
                                            <button type="submit" class="btn btn-danger shadow-sm">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Si no hay roles en la base de datos --}}
                @else
                    <div class="d-flex justify-content-center align-items-center w-100" style="min-height: 250px;">
                        <div class="text-center text-muted">
                            <i class="fas fa-info-circle fa-3x mb-3 text-warning"></i>
                            <p class="lead fw-semibold mb-1">Aún no hay roles registrados</p>
                            <p class="small mb-3">Puedes comenzar creando uno nuevo.</p>
                            <a href="{{ route('roles.create') }}" class="btn btn-warning mt-2 shadow-sm fw-bold px-4">
                                <i class="fas fa-plus-circle me-1"></i> Crear rol
                            </a>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

    {{-- Estilos específicos --}}
    <style>
        .role-card {
            transition: all 0.2s ease-in-out;
            border-radius: 12px;
        }

        .role-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

<style>
    /* Soluciona el problema de separación entre botones en las cards */
    .card-body .d-flex>*:not(:last-child) {
        margin-right: 0.5rem !important;
        /* ajustá el valor si querés más espacio */
    }

    /* Opcional: mejora el hover */
    .btn-outline-warning:hover {
        background-color: #ffc107;
        color: #fff;
        border-color: #ffc107;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: #fff;
        border-color: #dc3545;
    }
</style>
