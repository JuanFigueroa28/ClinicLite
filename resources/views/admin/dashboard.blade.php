{{--
    VISTA: Dashboard Principal del Panel de Administración (ClinicLite)
    -------------------------------------------------------------------
    Este archivo muestra la vista principal del panel administrativo.
    Contiene tarjetas con datos estadísticos, un gráfico (usando Chart.js)
    y una tabla con citas próximas.

    OBJETIVO DE ESTA VISTA:
    - Mostrar de forma visual un resumen del sistema.
    - Simular datos que más adelante se obtendrán de la base de datos.

    SIGUIENTE PASO (para los encargados del backend):
    1. Conectar esta vista con datos reales desde los modelos y controladores.
    2. Crear controladores y modelos para Pacientes, Doctores y Citas.
    3. Desde el controlador del Dashboard, enviar los datos a la vista Blade
       usando compact() o with().
    4. Reemplazar los valores estáticos por variables dinámicas:
       Ejemplo:
       <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPacientes }}</div>
    5. Para el gráfico, pasar los valores desde el controlador en formato JSON
       y reemplazar el arreglo de "data: [12, 19, ...]" por datos reales.
--}}

@extends('layouts.app')

@section('title', 'Dashboard - ClinicLite')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Panel de Control</h1>

    {{--
        SECCIÓN: Tarjetas de resumen
        Cada tarjeta muestra un conteo o estadística.
        Estos valores (124, 18, 45, 32) actualmente están fijos.
        En el futuro deben venir desde el controlador con variables.
        Ejemplo: {{ $pacientesRegistrados }}
    --}}
    <div class="row">

        <!-- Pacientes registrados -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Pacientes registrados</div>
                            {{-- Reemplazar este valor por una variable: {{ $pacientesRegistrados }} --}}
                            <div class="h5 mb-0 font-weight-bold text-gray-800">124</div>
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
                            {{-- Reemplazar por variable: {{ $doctoresActivos }} --}}
                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
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
                            {{-- Reemplazar por variable: {{ $citasProgramadas }} --}}
                            <div class="h5 mb-0 font-weight-bold text-gray-800">45</div>
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
                            {{-- Reemplazar por variable: {{ $citasCompletadas }} --}}
                            <div class="h5 mb-0 font-weight-bold text-gray-800">32</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{--
        SECCIÓN: Gráfico de citas y tabla
        --------------------------------------------------------------------
        En esta parte se muestra un gráfico (Chart.js) y una tabla con citas.
        Más adelante, los valores del gráfico deben venir desde el backend.
        Ejemplo: pasar las citas por día desde el controlador.
    --}}
    <div class="row">

        <!-- Gráfico de citas -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Citas solicitadas por día</h6>
                </div>
                <div class="card-body">
                    {{-- El gráfico se genera con JavaScript (Chart.js) --}}
                    {{-- Próximo paso: pasar los valores de citas desde el controlador --}}
                    <div class="chart-area">
                        <canvas id="appointmentsChart"></canvas>
                    </div>
                    <hr>
                    <p class="mb-0 text-muted small">Datos simulados de citas recibidas esta semana.</p>
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
                    {{-- La tabla actualmente muestra datos fijos.
                       Próximo paso: reemplazar por un @foreach($citas as $cita)
                       para recorrer los registros de la base de datos. --}}
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
                            {{-- Ejemplo de fila: --}}
                            {{-- @foreach($citas as $cita)
                                 <tr>
                                     <td>{{ $cita->paciente->nombre }}</td>
                                     <td>{{ $cita->doctor->nombre }}</td>
                                     <td>{{ $cita->fecha }}</td>
                                     <td>{{ $cita->estado }}</td>
                                 </tr>
                               @endforeach
                            --}}
                            <tr>
                                <td>Ana Torres</td>
                                <td>Dr. Pérez</td>
                                <td>06/10/2025</td>
                                <td><span class="badge bg-success text-white">Confirmada</span></td>
                            </tr>
                            <tr>
                                <td>Marcos López</td>
                                <td>Dra. Gómez</td>
                                <td>07/10/2025</td>
                                <td><span class="badge bg-warning text-white">Pendiente</span></td>
                            </tr>
                            <tr>
                                <td>Lucía Ramírez</td>
                                <td>Dr. Jiménez</td>
                                <td>08/10/2025</td>
                                <td><span class="badge bg-info text-white">En curso</span></td>
                            </tr>
                            <tr>
                                <td>Javier Cruz</td>
                                <td>Dra. Ortega</td>
                                <td>09/10/2025</td>
                                <td><span class="badge bg-danger text-white">Cancelada</span></td>
                            </tr>
                            <tr>
                                <td>Carla Ruiz</td>
                                <td>Dr. Soto</td>
                                <td>10/10/2025</td>
                                <td><span class="badge bg-success text-white">Confirmada</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

{{--
    BLOQUE DE SCRIPTS
    --------------------------------------------------------------------
    Aquí se encuentra el script para el gráfico de Chart.js.
    Actualmente los datos son estáticos (array con números).
    Para hacerlo dinámico, el backend debe enviar los valores al script.
    Ejemplo:
        data: {!! json_encode($datosCitas) !!}
--}}
@push('scripts')
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
<script>
    const ctx = document.getElementById("appointmentsChart");
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"],
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
                data: [12, 19, 8, 15, 22, 13, 9], // Reemplazar estos valores por datos reales
            }],
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                x: {
                    grid: { display: false, drawBorder: false },
                },
                y: {
                    ticks: { beginAtZero: true },
                    grid: { color: "rgba(234, 236, 244, 1)", zeroLineColor: "rgba(234, 236, 244, 1)" },
                },
            },
            plugins: {
                legend: { display: false },
            },
        },
    });
</script>
@endpush
