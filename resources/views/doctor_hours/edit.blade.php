@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 text-gray-800">Editar horario</h1>
    <a href="{{ route('doctor_hours.index') }}" class="btn btn-outline-secondary shadow-sm">
        <i class="fas fa-arrow-left me-1"></i> Volver
    </a>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    {{-- Mensaje de confirmación cuando se retorna con status desde el controlador --}}
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form action="{{ route('doctor_hours.update', $horario->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="doctor_id">Médico</label>
                            <select class="form-control" id="doctor_id" name="doctor_id" required>
                                @foreach($medicos as $medico)
                                    <option value="{{ $medico->id }}" {{ $horario->doctor_id == $medico->id ? 'selected' : '' }}>{{ $medico->first_name }} {{ $medico->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="week_day">Día de la semana</label>
                            <select class="form-control" id="week_day" name="week_day" required>
                                <option value="Lunes" {{ $horario->week_day=='Lunes'?'selected':'' }}>Lunes</option>
                                <option value="Martes" {{ $horario->week_day=='Martes'?'selected':'' }}>Martes</option>
                                <option value="Miercoles" {{ $horario->week_day=='Miercoles'?'selected':'' }}>Miércoles</option>
                                <option value="Jueves" {{ $horario->week_day=='Jueves'?'selected':'' }}>Jueves</option>
                                <option value="Viernes" {{ $horario->week_day=='Viernes'?'selected':'' }}>Viernes</option>
                                <option value="Sabado" {{ $horario->week_day=='Sabado'?'selected':'' }}>Sábado</option>
                                <option value="Domingo" {{ $horario->week_day=='Domingo'?'selected':'' }}>Domingo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="start_time">Hora de inicio</label>
                            {{-- Formato H:i para compatibilidad con input type="time" --}}
                            <input type="time" class="form-control" id="start_time" name="start_time" value="{{ substr($horario->start_time,0,5) }}">
                        </div>
                        <div class="form-group">
                            <label for="end_time">Hora de fin</label>
                            {{-- Formato H:i para compatibilidad con input type="time" --}}
                            <input type="time" class="form-control" id="end_time" name="end_time" value="{{ substr($horario->end_time,0,5) }}">
                        </div>
                        <div class="form-group">
                            <label for="duration_minutes">Duración de cada cita (minutos)</label>
                            {{-- Campo opcional en edición para soportar actualización parcial --}}
                            <input type="number" class="form-control" id="duration_minutes" name="duration_minutes" min="5" value="{{ $horario->duration_minutes }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('doctor_hours.index') }}" class="btn btn-secondary">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection