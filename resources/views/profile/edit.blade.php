@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Encabezado -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-user-circle"></i> Mi Perfil
        </h1>
    </div>

    <!-- Tarjeta de perfil -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary text-white">
                    <h6 class="m-0 font-weight-bold">Información del Usuario</h6>
                </div>
                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Nombre completo:</strong>
                            <p>{{ $user->first_name }} {{ $user->last_name }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Documento:</strong>
                            <p>{{ $user->document ?? 'No registrado' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Correo electrónico:</strong>
                            <p>{{ $user->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Teléfono:</strong>
                            <p>{{ $user->phone ?? 'No registrado' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Dirección:</strong>
                            <p>{{ $user->address ?? 'No registrada' }}</p>
                        </div>
                        <div class="col-md-6">
                            <strong>Rol:</strong>
                            <p>
                                <span class="badge bg-info text-dark">
                                    {{ $user->role->name ?? 'Sin rol asignado' }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver al Dashboard
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
