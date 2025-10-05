@extends('layouts.app')

@section('title', 'Pacientes - ClinicLite')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Gestión de Pacientes</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Lista de pacientes</h6>
        <a href="{{ url('/admin/pacientes/nuevo') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Nuevo Paciente
        </a>
    </div>
    <div class="card-body">
        <!-- Buscador -->
        <div class="mb-3">
            <input type="text" id="buscarPaciente" class="form-control" placeholder="Buscar por nombre o cédula...">
        </div>

        <!-- Tabla -->
        <div class="table-responsive">
            <table class="table table-hover" id="tablaPacientes">
                <thead>
                    <tr>
                        <th>Nombre completo</th>
                        <th>Cédula / T.I.</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ana Torres</td>
                        <td>1023456789</td>
                        <td>
                            <button class="btn btn-info btn-sm">Ver más</button>
                            <button class="btn btn-warning btn-sm">Editar</button>
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Marcos López</td>
                        <td>1012345678</td>
                        <td>
                            <button class="btn btn-info btn-sm">Ver más</button>
                            <button class="btn btn-warning btn-sm">Editar</button>
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Lucía Ramírez</td>
                        <td>T.I 90223344</td>
                        <td>
                            <button class="btn btn-info btn-sm">Ver más</button>
                            <button class="btn btn-warning btn-sm">Editar</button>
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('buscarPaciente').addEventListener('keyup', function() {
    const search = this.value.toLowerCase();
    const rows = document.querySelectorAll('#tablaPacientes tbody tr');
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(search) ? '' : 'none';
    });
});
</script>
@endpush
