{{--
    VISTA: Lista de Pacientes
    ---------------------------------------------------------------------
    Esta vista pertenece al módulo de administración de pacientes.
    Aquí se muestra la estructura visual del listado de pacientes con
    sus respectivos botones de acción.

    ASIGNACIÓN GENERAL:
    - Esta vista es responsabilidad del área de FRONTEND.
    - El área de BACKEND (a quien le corresponda) debe implementar la lógica
      necesaria para mostrar los datos reales y hacer funcionar los botones.

    TAREAS BACKEND:
    1. Crear el modelo y migración de Pacientes:
         php artisan make:model Paciente -m
       -> Definir campos: nombre, cedula, telefono, direccion, observaciones, etc.

    2. Crear el controlador con sus métodos CRUD:
         php artisan make:controller PacienteController --resource

    3. En PacienteController@index:
         - Obtener todos los registros de la tabla pacientes.
         - Enviar los resultados a esta vista:
             return view('admin.pacientes.index', ['pacientes' => $pacientes]);

    4. En PacienteController@destroy:
         - Implementar la eliminación real del registro.
         - Redirigir con mensaje de confirmación.

    5. En PacienteController@edit y PacienteController@update:
         - Cargar los datos del paciente seleccionado.
         - Guardar los cambios realizados desde el formulario de edición.

    6. Configurar las rutas en routes/web.php:
         Route::resource('pacientes', PacienteController::class);
--}}

@extends('layouts.app')

@section('title', 'Pacientes - ClinicLite')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Gestión de Pacientes</h1>

{{--
    BLOQUE DE MENSAJES SIMULADOS
    ---------------------------------------------------------------------
    Este bloque solo muestra alertas de simulación.
    El encargado del BACKEND debe reemplazarlo con mensajes reales
    provenientes de controladores mediante:
        @if(session('success')) ... @endif
        @if(session('error')) ... @endif
--}}
<?php
    if (isset($_POST['editar'])) {
        echo '<div class="alert alert-warning">El paciente ha sido editado (simulado).</div>';
    }
    if (isset($_POST['eliminar'])) {
        echo '<div class="alert alert-danger">El paciente ha sido eliminado (simulado).</div>';
    }
?>

<div class="card shadow mb-4 border-left-primary">
    <div class="card-header bg-primary text-white">
        <h6 class="m-0 font-weight-bold">Lista de pacientes</h6>
    </div>

    <div class="card-body">
        {{--
            TABLA DE PACIENTES
            ---------------------------------------------------------------------
            RESPONSABLE:
            - FRONTEND: mantiene la estructura y estilo de la tabla.
            - BACKEND: debe reemplazar los datos estáticos por registros reales
              provenientes de la base de datos.

            El encargado debe usar un bucle @foreach($pacientes as $paciente)
            para recorrer los registros del controlador.
        --}}
        <table class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <th>Nombre</th>
                    <th>Cédula</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                {{--
                    DATOS SIMULADOS (solo ejemplo visual)
                    ---------------------------------------------------------------------
                    A quien le corresponda en BACKEND debe eliminar estas filas estáticas
                    y generar las filas dinámicamente mediante Blade:

                    @foreach($pacientes as $paciente)
                        <tr>
                            <td>{{ $paciente->nombre }}</td>
                            <td>{{ $paciente->cedula }}</td>
                            <td>
                                <!-- Aquí irán los botones con rutas reales -->
                            </td>
                        </tr>
                    @endforeach
                --}}
                <tr>
                    <td>Ana Torres</td>
                    <td>1023456789</td>
                    <td>
                        {{--
                            BOTONES DE ACCIÓN
                            ---------------------------------------------------------------------
                            RESPONSABLE:
                            - FRONTEND: mantiene el estilo visual y posición de los botones.
                            - BACKEND: debe conectar cada botón con las rutas reales del CRUD.

                            El encargado debe vincular:
                            - Editar  -> route('pacientes.edit', $paciente->id)
                            - Eliminar -> route('pacientes.destroy', $paciente->id)
                            - Mostrar -> route('pacientes.show', $paciente->id)
                        --}}
                        <form method="POST" style="display:inline;">
                            <button type="submit" name="editar" class="btn btn-warning btn-sm">Editar</button>
                        </form>

                        <form method="POST" style="display:inline;">
                            <button type="submit" name="eliminar" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>

                <tr>
                    <td>Marcos López</td>
                    <td>1012345678</td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <button type="submit" name="editar" class="btn btn-warning btn-sm">Editar</button>
                        </form>

                        <form method="POST" style="display:inline;">
                            <button type="submit" name="eliminar" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>

        {{--
            NOTA FINAL:
            ---------------------------------------------------------------------
            - El encargado del BACKEND debe manejar la eliminación usando el método DELETE.
            - La edición debe cargarse en un formulario prellenado.
            - La creación de nuevos pacientes se gestiona desde la vista create.blade.php.
        --}}
    </div>
</div>
@endsection
