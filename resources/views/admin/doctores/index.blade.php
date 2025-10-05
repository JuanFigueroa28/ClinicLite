{{--
    VISTA: Lista de Doctores
    ---------------------------------------------------------------------
    Esta vista pertenece al módulo de administración de doctores.
    Muestra la tabla visual con los doctores registrados y los botones
    de acción correspondientes.

    RESPONSABILIDADES:
    - FRONTEND: encargarse del diseño, estructura y estilos visuales.
    - BACKEND: responsable de conectar esta vista con datos reales desde
      la base de datos, y de vincular los botones con sus rutas CRUD.

    TAREAS ASIGNADAS AL BACKEND:
    1. Crear el modelo y la migración para los doctores:
         php artisan make:model Doctor -m
       -> En la migración agregar campos: nombre, especialidad, telefono,
          correo, cedula_profesional, disponibilidad, etc.

    2. Crear el controlador con las funciones CRUD:
         php artisan make:controller DoctorController --resource

    3. En DoctorController@index:
         - Obtener todos los doctores de la base de datos.
         - Enviar los datos a esta vista:
             return view('admin.doctores.index', ['doctores' => $doctores]);

    4. En DoctorController@destroy:
         - Implementar la eliminación real de un registro.
         - Redirigir con un mensaje de confirmación.

    5. En DoctorController@edit y @update:
         - Cargar los datos del doctor seleccionado.
         - Guardar los cambios realizados desde el formulario de edición.

    6. Configurar las rutas en routes/web.php:
         Route::resource('doctores', DoctorController::class);
--}}

@extends('layouts.app')

@section('title', 'Doctores - ClinicLite')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Gestión de Doctores</h1>

{{--
    BLOQUE DE MENSAJES SIMULADOS
    ---------------------------------------------------------------------
    Este bloque actualmente muestra alertas simuladas al presionar los
    botones. El encargado del BACKEND debe reemplazarlo por mensajes
    reales provenientes del controlador, usando sesiones:
        @if(session('success')) ... @endif
        @if(session('error')) ... @endif
--}}
<?php
    if (isset($_POST['editar'])) {
        echo '<div class="alert alert-warning">El doctor ha sido editado (simulado).</div>';
    }
    if (isset($_POST['eliminar'])) {
        echo '<div class="alert alert-danger">El doctor ha sido eliminado (simulado).</div>';
    }
?>

<div class="card shadow mb-4 border-left-success">
    <div class="card-header bg-success text-white">
        <h6 class="m-0 font-weight-bold">Lista de doctores</h6>
    </div>

    <div class="card-body">
        {{--
            TABLA DE DOCTORES
            ---------------------------------------------------------------------
            RESPONSABLES:
            - FRONTEND: mantener estructura, clases Bootstrap y estilo visual.
            - BACKEND: reemplazar los datos estáticos por registros obtenidos
              desde la base de datos.

            El encargado del BACKEND debe usar un bucle:
                @foreach($doctores as $doctor)
                    <tr>
                        <td>{{ $doctor->nombre }}</td>
                        <td>{{ $doctor->especialidad }}</td>
                        <td>{{ $doctor->telefono }}</td>
                        <td>
                            <!-- Botones con rutas reales -->
                        </td>
                    </tr>
                @endforeach
        --}}
        <table class="table table-hover">
            <thead class="table-success">
                <tr>
                    <th>Nombre</th>
                    <th>Especialidad</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                {{--
                    DATOS DE EJEMPLO
                    ---------------------------------------------------------------------
                    Los siguientes registros son solo ejemplos visuales.
                    El encargado del BACKEND debe reemplazarlos por registros
                    reales usando el modelo Doctor y el controlador correspondiente.
                --}}
                <tr>
                    <td>Dr. Carlos Pérez</td>
                    <td>Cardiología</td>
                    <td>3001122334</td>
                    <td>
                        {{--
                            BOTONES DE ACCIÓN
                            ---------------------------------------------------------------------
                            RESPONSABLE:
                            - FRONTEND: mantiene estilo y posición de botones.
                            - BACKEND: conectar cada uno con sus rutas CRUD.

                            El encargado debe vincular:
                            - Editar  -> route('doctores.edit', $doctor->id)
                            - Eliminar -> route('doctores.destroy', $doctor->id)
                            - Mostrar -> route('doctores.show', $doctor->id)
                            También se deben usar métodos PUT y DELETE.
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
                    <td>Dra. Laura Gómez</td>
                    <td>Pediatría</td>
                    <td>3014455667</td>
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
            INDICACIONES FINALES
            ---------------------------------------------------------------------
            - El encargado del BACKEND debe:
                -> Usar el método DELETE en los formularios de eliminación.
                -> Manejar la edición mediante formulario prellenado.
                -> Controlar validaciones y mensajes de respuesta.
            - La vista de creación y edición de doctores debe reutilizar
              los mismos campos definidos en el modelo Doctor.
        --}}
    </div>
</div>
@endsection
