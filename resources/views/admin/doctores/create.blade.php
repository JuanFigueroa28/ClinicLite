{{--
    VISTA: Registrar nuevo Doctor
    ---------------------------------------------------------------------
    Esta vista corresponde al formulario de registro de doctores.
    El diseño es responsabilidad del FRONTEND, mientras que el BACKEND
    debe encargarse de conectar el formulario con el controlador y la base de datos.

    ASIGNACIONES BACKEND:
    1. Crear el modelo y migración para Doctores:
         php artisan make:model Doctor -m
       -> En la migración agregar campos: nombre, especialidad, telefono, correo, cedula_profesional, disponibilidad, etc.

    2. Crear el controlador CRUD:
         php artisan make:controller DoctorController --resource

    3. En DoctorController@create:
         - Retornar esta vista (admin.doctores.create).

    4. En DoctorController@store:
         - Recibir los datos del formulario.
         - Validar los campos.
         - Guardar el registro en la tabla "doctores".
         - Redirigir con un mensaje de éxito a la lista de doctores.

    5. En routes/web.php:
         Route::resource('doctores', DoctorController::class);

    6. El encargado debe conectar este formulario con el método store():
         <form method="POST" action="{{ route('doctores.store') }}">
             @csrf
             <!-- Campos con atributos name -->
         </form>
--}}

@extends('layouts.app')

@section('title', 'Nuevo Doctor - ClinicLite')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Registrar nuevo doctor</h1>

{{--
    BLOQUE DE FORMULARIO
    ---------------------------------------------------------------------
    - FRONTEND: mantiene el diseño, estructura y estilos del formulario.
    - BACKEND: debe agregar los atributos "name" a cada input, definir
      el método POST y la acción hacia el controlador.
    El encargado del BACKEND debe también validar los datos al recibirlos.
--}}
<div class="card shadow p-4 border-left-success">
    <form>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre completo</label>
            {{-- El encargado debe agregar name="nombre" --}}
            <input type="text" id="nombre" class="form-control" placeholder="Ej: Dr. Carlos Pérez">
        </div>

        <div class="mb-3">
            <label for="especialidad" class="form-label">Especialidad</label>
            {{-- El encargado debe agregar name="especialidad" --}}
            <input type="text" id="especialidad" class="form-control" placeholder="Ej: Cardiología">
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            {{-- El encargado debe agregar name="telefono" --}}
            <input type="text" id="telefono" class="form-control" placeholder="Ej: 3001234567">
        </div>

        <div class="mb-3">
            <label for="correo" class="form-label">Correo electrónico</label>
            {{-- El encargado debe agregar name="correo" --}}
            <input type="email" id="correo" class="form-control" placeholder="Ej: doctor@cliniclite.com">
        </div>

        <div class="mb-3">
            <label for="cedula" class="form-label">Número de cédula profesional</label>
            {{-- El encargado debe agregar name="cedula_profesional" --}}
            <input type="text" id="cedula" class="form-control" placeholder="Ej: 987654321">
        </div>

        {{--
            BOTONES DE ACCIÓN
            ---------------------------------------------------------------------
            - El botón "Guardar" debe enviar los datos al método store() del DoctorController.
            - El botón "Cancelar" regresa a la vista index de doctores.
            - El encargado del BACKEND debe implementar la validación y guardado real.
        --}}
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ url('/admin/doctores') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

{{--
    NOTA PARA EL BACKEND:
    ---------------------------------------------------------------------
    Dentro del método store() del DoctorController se debe realizar:
        $request->validate([
            'nombre' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
            'telefono' => 'nullable|string',
            'correo' => 'required|email|unique:doctores',
            'cedula_profesional' => 'required|numeric|unique:doctores',
        ]);

        Doctor::create($request->all());

        return redirect()->route('doctores.index')
                         ->with('success', 'Doctor registrado correctamente');
--}}
@endsection
