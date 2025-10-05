@extends('layouts.app')

@section('title', 'Nuevo Paciente - ClinicLite')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Registrar nuevo paciente</h1>

<div class="card shadow p-4">
    <form>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre completo</label>
            <input type="text" id="nombre" class="form-control" placeholder="Ej: Ana Torres">
        </div>

        <div class="mb-3">
            <label for="cedula" class="form-label">Cédula / T.I.</label>
            <input type="text" id="cedula" class="form-control" placeholder="Ej: 1023456789">
        </div>

        <div class="mb-3">
            <label for="edad" class="form-label">Edad</label>
            <input type="number" id="edad" class="form-control" min="0" max="120">
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" id="telefono" class="form-control" placeholder="Ej: 3001234567">
        </div>

        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea id="observaciones" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ url('/admin/pacientes') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
