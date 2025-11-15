@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 text-gray-800">Crear nuevo horario</h1>
    <a href="{{ route('doctor_hours.index') }}" class="btn btn-outline-secondary shadow-sm">
        <i class="fas fa-arrow-left me-1"></i> Volver
    </a>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form id="doctorHoursForm" action="{{ route('doctor_hours.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="doctor_id">Médico</label>
                            <select class="form-control" id="doctor_id" name="doctor_id" required>
                                <option value="">Seleccionar médico</option>
                                @foreach($medicos as $medico)
                                    <option value="{{ $medico->id }}">{{ $medico->first_name }} {{ $medico->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Seleccionar días</label>
                            {{-- Selección profesional de múltiples días mediante checkboxes --}}
                            <div class="d-flex flex-wrap gap-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="diaLunes" name="week_days[]" value="Lunes" required>
                                    <label class="form-check-label" for="diaLunes">Lunes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="diaMartes" name="week_days[]" value="Martes">
                                    <label class="form-check-label" for="diaMartes">Martes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="diaMiercoles" name="week_days[]" value="Miercoles">
                                    <label class="form-check-label" for="diaMiercoles">Miércoles</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="diaJueves" name="week_days[]" value="Jueves">
                                    <label class="form-check-label" for="diaJueves">Jueves</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="diaViernes" name="week_days[]" value="Viernes">
                                    <label class="form-check-label" for="diaViernes">Viernes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="diaSabado" name="week_days[]" value="Sabado">
                                    <label class="form-check-label" for="diaSabado">Sábado</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="diaDomingo" name="week_days[]" value="Domingo">
                                    <label class="form-check-label" for="diaDomingo">Domingo</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="start_date">Fecha inicio</label>
                            {{-- Mínimo hoy; valor por defecto: hoy --}}
                            <input type="date" class="form-control" id="start_date" name="start_date" required min="{{ \Carbon\Carbon::today()->toDateString() }}" value="{{ \Carbon\Carbon::today()->toDateString() }}">
                        </div>
                        <div class="form-group">
                            <label for="end_date">Fecha fin</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required min="{{ \Carbon\Carbon::today()->addDay()->toDateString() }}">
                        </div>
                        <div class="form-group">
                            <label for="start_time">Hora de inicio</label>
                            <input type="time" class="form-control" id="start_time" name="start_time" required>
                        </div>
                        <div class="form-group">
                            <label for="end_time">Hora de fin</label>
                            <input type="time" class="form-control" id="end_time" name="end_time" required>
                        </div>
                        <div class="form-group">
                            <label for="duration_minutes">Duración de cada cita (minutos)</label>
                            <input type="number" class="form-control" id="duration_minutes" name="duration_minutes" min="5" required>
                        </div>
                        {{-- Mensaje de carga durante la creación --}}
                        <div id="loadingMessage" class="alert alert-info d-none" role="alert">
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span class="ms-2">Procesando creación de horarios...</span>
                        </div>
                        <button type="submit" class="btn btn-primary" id="submitButton">Guardar Horario</button>
                        <a href="{{ route('doctor_hours.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function(){
  // Script de UX: asegura que la fecha fin sea siempre posterior a la de inicio
  function toDate(str){ var d = new Date(str + 'T00:00:00'); return isNaN(d) ? null : d; }
  function formatDate(d){ return d.toISOString().slice(0,10); }
  var $start = document.getElementById('start_date');
  var $end = document.getElementById('end_date');
  function updateEndMin(){
    var sd = toDate($start.value);
    if(!sd) return;
    sd.setDate(sd.getDate()+1);
    var min = formatDate(sd);
    $end.min = min;
    if($end.value && $end.value <= $start.value){ $end.value = ''; }
  }
  $start.addEventListener('change', updateEndMin);
  updateEndMin();
  // Mensaje de carga y bloqueo de botón durante el envío
  var form = document.getElementById('doctorHoursForm');
  var loading = document.getElementById('loadingMessage');
  var submitBtn = document.getElementById('submitButton');
  form.addEventListener('submit', function(){
    loading.classList.remove('d-none');
    if(submitBtn){
      submitBtn.disabled = true;
      submitBtn.textContent = 'Guardando...';
    }
  });
})();
</script>
@endpush