@extends('layouts.app')

@section('title', 'Usuarios - ClinicLite')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Gestión de Usuarios</h1>

<div class="card shadow mb-4 border-left-secondary">
    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold">Lista de usuarios</h6>

        @if (\App\Helpers\RoleHelper::isAuthorized('create-user'))
            <a href="{{ route('users.create') }}" class="btn btn-light btn-sm">
                <i class="fas fa-user-plus"></i> Nuevo Usuario
            </a>
        @endif
    </div>

    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($users->isEmpty())
            <p class="text-center text-muted">No hay usuarios registrados en el sistema.</p>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role->name ?? 'Sin rol' }}</td>
                                <td>
                                    @if ($user->status)
                                        <span class="badge bg-success text-white">Activo</span>
                                    @else
                                        <span class="badge bg-danger text-white">Inactivo</span>
                                    @endif
                                </td>
                                <td class="text-center">

                                    {{-- Editar usuario --}}
                                    @if (\App\Helpers\RoleHelper::isAuthorized('edit-user'))
                                        <a href="{{ route('users.edit', $user->id) }}"
                                           class="btn btn-warning btn-sm text-white">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                    @endif

                                    {{-- Eliminar usuario --}}
                                    @if (\App\Helpers\RoleHelper::isAuthorized('delete-user') && $user->role->name !== 'Administrador')
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
