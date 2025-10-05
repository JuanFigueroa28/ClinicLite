{{--
    VISTA: Registrar nueva Cita
    ---------------------------------------------------------------------
    Esta vista corresponde al formulario de creación de citas médicas.
    El área de FRONTEND es responsable del diseño, estructura y estilo
    del formulario, mientras que el BACKEND debe encargarse de enlazar
    este formulario con la base de datos y la lógica de guardado.

    ASIGNACIONES PARA EL BACKEND:
    1. Crear el modelo y migración de Citas:
         php artisan make:model Cita -m
       -> En la migración agregar campos: id_cita, paciente_id, doctor_id, fecha, estado, observaciones.

    2. Crear el controlador CRUD:
         php artisan make:controller CitaController --resource

    3. En CitaController@create:
         - Retornar esta vista (admin.citas.create).
         - Si ya existen pacientes y doctores en la base de datos,
           el encargado debe pasarlos a la vista para mostrarlos en selects.

    4. En CitaController@store:
         - Validar los campos.
         - Guardar la nueva cita en la base de datos.
         - Redirigir a la vista de listado de citas con mensaje de éxito.

    5. En routes/web.php:
         Route::resource('citas', CitaController::class);

    6. Conectar este formulario con el método store() del controlador:
         <form method="POST" action="{{ route('citas.store') }}">
             @csrf
             <!-- Campos con atributo name -->
         </form>
--}}

@extends('layouts.app')

@section('title', 'Nueva Cita - ClinicLite')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Registrar nueva cita</h1>

<div class="card shadow p-4 border-left-info">
    {{--
        FORMULARIO DE REGISTRO
        ---------------------------------------------------------------------
        RESPONSABLES:
        - FRONTEND: mantener los campos, estilos y estructura visual.
        - BACKEND: agregar los atributos name, definir method="POST" y action
          hacia la ruta correcta (route('citas.store')).

        El encargado del BACKEND también debe validar los campos y manejar
        el guardado real en la base de datos.
    --}}
    <form>
        <div class="mb-3">
            <label for="idCita" class="form-label">ID Cita</label>
            {{-- El encargado debe agregar name="id_cita" --}}
            <input type="text" id="idCita" class="form-control" placeholder="Ej: CT-004">
        </div>

        <div class="mb-3">
            <label for="paciente" class="form-label">Paciente</label>
            {{--
                El encargado debe reemplazar este campo de texto por un SELECT
                que cargue los pacientes registrados desde la base de datos.
                Ejemplo:
                    <select name="paciente_id" class="form-control">
                        @foreach($pacientes as $paciente)
                            <option value="{{ $paciente->id }}">{{ $paciente->nombre }}</option>
                        @endforeach
                    </select>
            --}}
            <input type="text" id="paciente" class="form-control" placeholder="Ej: Ana Torres">
        </div>

        <div class="mb-3">
            <label for="doctor" class="form-label">Doctor asignado</label>
            {{--
                El encargado debe reemplazar este campo de texto por un SELECT
                que muestre los doctores disponibles desde la base de datos.
                Ejemplo:
                    <select name="doctor_id" class="form-control">
                        @foreach($doctores as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->nombre }}</option>
                        @endforeach
                    </select>
            --}}
            <input type="text" id="doctor" class="form-control" placeholder="Ej: Dr. Pérez">
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha de la cita</label>
            {{-- El encargado debe agregar name="fecha" --}}
            <input type="date" id="fecha" class="form-control">
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            {{-- El encargado debe agregar name="estado" --}}
            <select id="estado" class="form-control">
                <option value="confirmada">Confirmada</option>
                <option value="pendiente">Pendiente</option>
                <option value="cancelada">Cancelada</option>
            </select>
        </div>

        {{--
            BOTONES DE ACCIÓN
            ---------------------------------------------------------------------
            - El botón "Guardar" debe enviar el formulario al método store().
            - El botón "Cancelar" redirige al listado de citas.
            - El encargado del BACKEND debe implementar la validación y el
              guardado real en CitaController@store.
        --}}
        <button type="submit" class="btn btn-info">Guardar</button>
        <a href="{{ url('/admin/citas') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

{{--
    NOTA PARA EL BACKEND:
    ---------------------------------------------------------------------
    En el método store() del CitaController, el encargado debe incluir:
        $request->validate([
            'id_cita' => 'required|string|unique:citas',
            'paciente_id' => 'required|exists:pacientes,id',
            'doctor_id' => 'required|exists:doctores,id',
            'fecha' => 'required|date',
            'estado' => 'required|string',
        ]);

        Cita::create($request->all());

        return redirect()->route('citas.index')
                         ->with('success', 'Cita registrada correctamente');
--}}
@endsection
