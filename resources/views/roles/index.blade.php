@extends('layouts.app')

@section('title', 'Gestión de Roles - ClinicLite')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 text-gray-800">Gestión de Roles</h1>

    @if (\App\Helpers\RoleHelper::isAuthorized('create-role'))
        <a href="{{ route('roles.create') }}" class="btn btn-warning fw-bold shadow-sm px-3">
            <i class="fas fa-plus-circle me-1"></i> Crear nuevo rol
        </a>
    @endif
</div>

<div class="card shadow-sm border-left-warning">
    <div class="card-header bg-warning bg-gradient text-dark d-flex justify-content-between align-items-center">
        <h6 class="m-0 fw-bold text-uppercase">
            <i class="fas fa-user-shield me-1"></i> Lista de Roles
        </h6>
    </div>

    <div class="card-body">
        <div class="row">
            {{-- Si existen roles --}}
            @if ($roles->count() > 0)
                @foreach ($roles as $role)
                    @php
                        $styleMap = [
                            'Administrador' => ['color' => 'danger', 'icon' => 'fa-user-shield'],
                            'Recepcionista' => ['color' => 'primary', 'icon' => 'fa-user-tie'],
                            'Médico' => ['color' => 'success', 'icon' => 'fa-user-md'],
                            'Paciente' => ['color' => 'info', 'icon' => 'fa-user'],
                        ];
                        $style = $styleMap[$role->name] ?? ['color' => 'secondary', 'icon' => 'fa-user-cog'];
                    @endphp

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card shadow-sm border-start border-4 border-{{ $style['color'] }} role-card h-100">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="fw-bold text-{{ $style['color'] }}">
                                        <i class="fas {{ $style['icon'] }}"></i> {{ $role->name }}
                                    </h5>
                                    <p class="text-muted small mb-3">{{ $role->description ?? 'Sin descripción disponible.' }}</p>
                                    <p class="text-muted small mb-1">
                                        <i class="fas fa-users"></i>
                                        {{ $role->users_count }} usuario{{ $role->users_count == 1 ? '' : 's' }} asignado{{ $role->users_count == 1 ? '' : 's' }}
                                    </p>
                                </div>

                                <div class="d-flex mt-3">
                                    @if (\App\Helpers\RoleHelper::isAuthorized('edit-role'))
                                        <a href="{{ route('roles.edit', $role->id) }}"
                                           class="btn btn-outline-warning btn-sm px-3 me-2">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                    @endif

                                    @if (\App\Helpers\RoleHelper::isAuthorized('delete-role'))
                                        <button type="button"
                                                class="btn btn-outline-danger btn-sm px-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $role->id }}">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal de confirmación --}}
                    <div class="modal fade" id="deleteModal{{ $role->id }}" tabindex="-1"
                         aria-labelledby="deleteModalLabel{{ $role->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content shadow-lg border-0 rounded-3">
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">
                                            <i class="fas fa-exclamation-triangle me-2"></i> Confirmar eliminación
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body text-center py-4">
                                        <p>¿Seguro que deseas eliminar el rol <strong>{{ $role->name }}</strong>?</p>
                                        <p class="text-muted small">Esta acción no se puede deshacer.</p>
                                    </div>

                                    <div class="modal-footer justify-content-center border-0 pb-4">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
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
            @else
                {{-- Si no hay roles --}}
                <div class="d-flex justify-content-center align-items-center w-100" style="min-height: 250px;">
                    <div class="text-center text-muted">
                        <i class="fas fa-info-circle fa-3x mb-3 text-warning"></i>
                        <p class="lead fw-semibold mb-1">Aún no hay roles registrados</p>
                        <p class="small mb-3">Puedes comenzar creando uno nuevo.</p>

                        @if (\App\Helpers\RoleHelper::isAuthorized('create-role'))
                            <a href="{{ route('roles.create') }}" class="btn btn-warning mt-2 shadow-sm fw-bold px-4">
                                <i class="fas fa-plus-circle me-1"></i> Crear rol
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Estilos --}}
<style>
    .role-card {
        transition: all 0.2s ease-in-out;
        border-radius: 12px;
    }

    .role-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    .card-body .d-flex>*:not(:last-child) {
        margin-right: 0.5rem !important;
    }

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
@endsection
