@extends('layouts.app')

@section('title', 'Dashboard - ClinicLite')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Panel de Control</h1>

    {{-- SECCIÓN: TARJETAS DE RESUMEN --}}
    <div class="row">

        <!-- Pacientes registrados -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Pacientes registrados</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPacientes }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-injured fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Doctores activos -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Doctores activos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDoctores }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-md fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Citas programadas -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Citas programadas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $citasProgramadas }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Citas completadas -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Citas completadas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $citasCompletadas }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- SECCIÓN: GRÁFICO Y TABLA --}}
    <div class="row">

        <!-- Gráfico de citas -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Citas solicitadas por día</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="appointmentsChart"></canvas>
                    </div>
                    <hr>
                    <p class="mb-0 text-muted small">Datos de citas generados desde la base de datos.</p>
                </div>
            </div>
        </div>

        <!-- Tabla de próximas citas -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Próximas citas</h6>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th>Paciente</th>
                                <th>Doctor</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proximasCitas as $cita)
                            <tr>
                                <td>{{ $cita->patient->first_name }} {{ $cita->patient->last_name }}</td>
                                <td>{{ $cita->doctor->user->first_name }} {{ $cita->doctor->user->last_name }}</td>
                                <td>{{ \Carbon\Carbon::parse($cita->appointment_date)->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge bg-{{ $cita->status == 'completed' ? 'success' : ($cita->status == 'scheduled' ? 'info' : 'secondary') }} text-white">
                                        {{ ucfirst($cita->status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
<script>
    const ctx = document.getElementById("appointmentsChart");
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: "Citas",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: {!! json_encode($datosCitas) !!},
            }],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
            },
        },
    });
</script>
@endpush
