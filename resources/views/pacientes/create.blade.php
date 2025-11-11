{{--
    VISTA: Crear nuevo Paciente
    ---------------------------------------------------------------------
    Esta vista pertenece al módulo de administración de pacientes.
    Aquí se encuentra el formulario visual para registrar un nuevo paciente.

    RESPONSABILIDADES:
    - FRONTEND: mantener el diseño, estructura y estilo del formulario.
    - BACKEND: conectar este formulario con el método "store" del controlador
      y manejar el guardado real de los datos en la base de datos.

    ASIGNACIÓN BACKEND:
    1. Crear el modelo y migración de Pacientes:
         php artisan make:model Paciente -m
       -> Agregar los campos: nombre, cedula, telefono, direccion, observaciones.

    2. Crear el controlador con las funciones CRUD:
         php artisan make:controller PacienteController --resource

    3. En PacienteController@create:
         - Retornar esta vista (admin.pacientes.create).

    4. En PacienteController@store:
         - Recibir los datos del formulario (request->input()).
         - Validar los campos.
         - Guardar en la tabla "pacientes".
         - Redirigir a la vista index con mensaje de éxito.

    5. En routes/web.php:
         - Configurar la ruta:
           Route::resource('pacientes', PacienteController::class);

    6. Reemplazar este formulario por uno conectado al backend:
         <form method="POST" action="{{ route('pacientes.store') }}">
             @csrf
             <input type="text" name="nombre">
             ...
         </form>
--}}

@extends('layouts.app')

@section('title', 'Nuevo Paciente - ClinicLite')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Registrar nuevo paciente</h1>

{{--
    BLOQUE DE MENSAJES
    ---------------------------------------------------------------------
    Este bloque solo muestra una alerta de simulación cuando se hace clic
    en el botón "Guardar".
    El encargado del BACKEND debe reemplazar esto por mensajes reales
    que vengan desde el controlador usando sesiones:
        @if(session('success')) ... @endif
--}}
<?php
    if (isset($_POST['guardar'])) {
        echo '<div class="alert alert-success">El paciente ha sido guardado correctamente (simulado).</div>';
    }
?>

<div class="card shadow p-4">
    {{--
        FORMULARIO DE REGISTRO
        ---------------------------------------------------------------------
        RESPONSABLES:
        - FRONTEND: deja el diseño y los campos listos visualmente.
        - BACKEND: conecta los campos con el controlador y base de datos.
          El encargado debe:
            -> Agregar los atributos "name" a cada input.
            -> Cambiar el "method" a POST y agregar @csrf.
            -> Definir el "action" con la ruta hacia pacientes.store.
    --}}
    <form method="POST">
        <label>Nombre completo</label>
        <input type="text" class="form-control mb-3">

        <label>Cédula / T.I.</label>
        <input type="text" class="form-control mb-3">

        <label>Teléfono</label>
        <input type="text" class="form-control mb-3">

        <label>Observaciones</label>
        <textarea class="form-control mb-3"></textarea>

        {{--
            BOTONES DE ACCIÓN
            ---------------------------------------------------------------------
            - El botón "Guardar" debe enviar los datos al controlador mediante POST.
            - El botón "Cancelar" redirige al listado de pacientes.
            El encargado del BACKEND debe implementar el guardado en el método store().
        --}}
        <button type="submit" name="guardar" class="btn btn-success">Guardar</button>
        <a href="{{ url('/admin/pacientes') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

{{--
    NOTA PARA EL BACKEND:
    ---------------------------------------------------------------------
    - En el método store() del PacienteController, usar la validación:
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cedula' => 'required|numeric|unique:pacientes',
            'telefono' => 'nullable|string',
            'observaciones' => 'nullable|string',
        ]);
    - Crear el registro con:
        Paciente::create($request->all());
    - Finalmente redirigir con:
        return redirect()->route('pacientes.index')->with('success', 'Paciente registrado correctamente');
--}}
@endsection
