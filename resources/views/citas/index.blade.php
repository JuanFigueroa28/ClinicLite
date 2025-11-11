{{--
    VISTA: Gestión de Citas
    ---------------------------------------------------------------------
    Esta vista pertenece al módulo de administración de citas.
    Aquí se muestra la lista visual de todas las citas registradas
    junto con las opciones para crear, ver, editar o eliminar una cita.

    RESPONSABILIDADES:
    - FRONTEND: encargado del diseño, estructura y presentación de los datos.
    - BACKEND: encargado de conectar los datos reales, manejar las acciones
      de búsqueda, creación, edición y eliminación de citas.

    ASIGNACIONES PARA EL BACKEND:
    1. Crear el modelo y migración de Citas:
         php artisan make:model Cita -m
       -> En la migración agregar campos: id_cita, paciente_id, doctor_id, fecha, estado, observaciones.

    2. Crear el controlador con funciones CRUD:
         php artisan make:controller CitaController --resource

    3. En CitaController@index:
         - Obtener todas las citas desde la base de datos.
         - Relacionar las tablas pacientes y doctores mediante Eloquent.
         - Enviar los datos a esta vista:
             return view('admin.citas.index', ['citas' => $citas]);

    4. En CitaController@destroy:
         - Implementar la eliminación de citas por ID.
         - Redirigir con mensaje de confirmación.

    5. En CitaController@edit y @update:
         - Cargar los datos de la cita seleccionada.
         - Guardar los cambios en la base de datos.

    6. Configurar las rutas en routes/web.php:
         Route::resource('citas', CitaController::class);
--}}

@extends('layouts.app')

@section('title', 'Citas - ClinicLite')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Gestión de Citas</h1>

<div class="card shadow mb-4 border-left-info">
    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-info text-white">
        <h6 class="m-0 font-weight-bold">Lista de citas</h6>
        {{--
            BOTÓN NUEVA CITA
            ---------------------------------------------------------------------
            - FRONTEND: mantiene el botón visible y su estilo.
            - BACKEND: debe conectar este botón con la ruta del formulario de creación:
                href="{{ route('citas.create') }}"
        --}}
        <a href="{{ url('/admin/citas/nueva') }}" class="btn btn-light btn-sm">
            <i class="fas fa-plus"></i> Nueva Cita
        </a>
    </div>

    <div class="card-body">
        {{--
            BUSCADOR
            ---------------------------------------------------------------------
            Este campo permite filtrar visualmente por texto.
            El encargado del BACKEND puede reemplazarlo con una búsqueda real
            mediante consultas o AJAX.
        --}}
        <div class="mb-3">
            <input type="text" id="buscarCita" class="form-control" placeholder="Buscar por ID, paciente o doctor...">
        </div>

        {{--
            TABLA DE CITAS
            ---------------------------------------------------------------------
            RESPONSABLES:
            - FRONTEND: mantiene la estructura y el diseño de la tabla.
            - BACKEND: debe reemplazar los datos estáticos por registros
              provenientes de la base de datos, usando un bucle con Blade.

            Ejemplo para el encargado del BACKEND:
                @foreach($citas as $cita)
                    <tr>
                        <td>{{ $cita->id_cita }}</td>
                        <td>{{ $cita->paciente->nombre }}</td>
                        <td>{{ $cita->doctor->nombre }}</td>
                        <td>{{ $cita->fecha }}</td>
                        <td>
                            <span class="badge
                                {{ $cita->estado == 'Confirmada' ? 'bg-success' :
                                   ($cita->estado == 'Pendiente' ? 'bg-warning text-dark' : 'bg-danger') }}">
                                {{ $cita->estado }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('citas.show', $cita->id) }}" class="btn btn-info btn-sm">Ver más</a>
                            <a href="{{ route('citas.edit', $cita->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('citas.destroy', $cita->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
        --}}
        <div class="table-responsive">
            <table class="table table-hover" id="tablaCitas">
                <thead class="table-info">
                    <tr>
                        <th>ID Cita</th>
                        <th>Paciente</th>
                        <th>Doctor</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {{--
                        DATOS SIMULADOS
                        ---------------------------------------------------------------------
                        Estos registros son solo visuales.
                        El encargado del BACKEND debe eliminarlos y generar las filas
                        dinámicamente desde el controlador con los datos reales.
                    --}}
                    <tr>
                        <td>#CT-001</td>
                        <td>Ana Torres</td>
                        <td>Dr. Pérez</td>
                        <td>2025-10-06</td>
                        <td><span class="badge bg-success text-white">Confirmada</span></td>
                        <td>
                            {{--
                                BOTONES DE ACCIÓN
                                ---------------------------------------------------------------------
                                RESPONSABLE:
                                - FRONTEND: mantener los botones y su estilo visual.
                                - BACKEND: vincular cada botón a sus rutas correspondientes.
                                El encargado debe usar:
                                    route('citas.show', $cita->id)
                                    route('citas.edit', $cita->id)
                                    route('citas.destroy', $cita->id)
                            --}}
                            <button class="btn btn-info btn-sm">Ver más</button>
                            <button class="btn btn-warning btn-sm">Editar</button>
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>#CT-002</td>
                        <td>Marcos López</td>
                        <td>Dra. Gómez</td>
                        <td>2025-10-07</td>
                        <td><span class="badge bg-warning text-dark">Pendiente</span></td>
                        <td>
                            <button class="btn btn-info btn-sm">Ver más</button>
                            <button class="btn btn-warning btn-sm">Editar</button>
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>#CT-003</td>
                        <td>Lucía Ramírez</td>
                        <td>Dr. Jiménez</td>
                        <td>2025-10-08</td>
                        <td><span class="badge bg-danger text-white">Cancelada</span></td>
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

{{--
    INDICACIONES ADICIONALES
    ---------------------------------------------------------------------
    - El encargado del BACKEND debe:
        -> Implementar la búsqueda real en CitaController@index.
        -> Controlar el cambio de estado (confirmada, pendiente, cancelada).
        -> Relacionar el modelo Cita con Paciente y Doctor (belongsTo).
        -> Crear vistas adicionales:
             - create.blade.php (para registrar cita)
             - edit.blade.php (para editar cita)
             - show.blade.php (para ver más detalles)
--}}
@endsection

@push('scripts')
{{--
    SCRIPT DEL BUSCADOR VISUAL
    ---------------------------------------------------------------------
    Este script permite buscar coincidencias dentro de la tabla de forma
    instantánea. Si el BACKEND implementa una búsqueda real, este bloque
    puede mantenerse o eliminarse según el método elegido.
--}}
<script>
document.getElementById('buscarCita').addEventListener('keyup', function() {
    const search = this.value.toLowerCase();
    const rows = document.querySelectorAll('#tablaCitas tbody tr');
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(search) ? '' : 'none';
    });
});
</script>
@endpush
