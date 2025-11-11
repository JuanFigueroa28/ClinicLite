@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Encabezado -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-tachometer-alt"></i> Panel de Administración
        </h1>
    </div>

    <!-- Mensaje de bienvenida -->
    <div class="alert alert-primary shadow-sm">
        👋 ¡Bienvenido, <strong>{{ $user->first_name }} {{ $user->last_name }}</strong>!
        <br>
        Actualmente tienes el rol de <span class="badge bg-info text-dark">{{ $user->role->name }}</span>.
    </div>

    <!-- Aquí puedes mantener tus estadísticas o tarjetas -->
    <div class="row">

        <!-- Pacientes -->
        <div class="col-md-3 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pacientes</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPacientes }}</div>
                </div>
            </div>
        </div>

        <!-- Doctores -->
        <div class="col-md-3 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Doctores</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDoctores }}</div>
                </div>
            </div>
        </div>

        <!-- Citas Programadas -->
        <div class="col-md-3 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Citas Programadas</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCitas }}</div>
                </div>
            </div>
        </div>

        <!-- Citas Completadas -->
        <div class="col-md-3 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Citas Completadas</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCitasCompletadas }}</div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
