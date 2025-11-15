@extends('layouts.app')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Gestión de agenda y horarios</h1>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Lista de Horarios Médicos</h6>
                    @if (\App\Helpers\RoleHelper::isAuthorized('manage-schedule'))
                        <a href="{{ route('doctor_hours.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Nuevo Horario
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    {{-- Contenedor de alertas para mostrar mensajes arriba de la tabla --}}
                    <div id="alerts"></div>
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="mb-3 d-flex flex-wrap gap-2">
                        <select id="filterDoctor" class="form-control" style="max-width:240px">
                            <option value="">Todos los médicos</option>
                            @foreach($medicos as $m)
                                <option value="{{ $m->first_name }} {{ $m->last_name }}">{{ $m->first_name }} {{ $m->last_name }}</option>
                            @endforeach
                        </select>
                        <select id="filterDay" class="form-control" style="max-width:200px">
                            <option value="">Todos los días</option>
                            <option value="Lunes">Lunes</option>
                            <option value="Martes">Martes</option>
                            <option value="Miercoles">Miércoles</option>
                            <option value="Jueves">Jueves</option>
                            <option value="Viernes">Viernes</option>
                            <option value="Sabado">Sábado</option>
                            <option value="Domingo">Domingo</option>
                        </select>
                        <input type="time" id="filterStart" class="form-control" style="max-width:160px" placeholder="Desde">
                        <input type="time" id="filterEnd" class="form-control" style="max-width:160px" placeholder="Hasta">
                        <input type="text" id="filterText" class="form-control" style="max-width:240px" placeholder="Buscar">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Médico</th>
                                    <th>Fecha</th>
                                    <th>Día</th>
                                    <th>Hora Inicio</th>
                                    <th>Hora Fin</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($horarios as $horario)
                                <tr>
                                    <td>{{ $horario->id }}</td>
                                    <td>{{ optional($horario->doctor)->first_name }} {{ optional($horario->doctor)->last_name }}</td>
                                    <td>{{ $horario->date ?? '' }}</td>
                                    <td>{{ $horario->week_day }}</td>
                                    <td>{{ $horario->start_time }}</td>
                                    <td>{{ $horario->end_time }}</td>
                                    <td>
                                        @if (\App\Helpers\RoleHelper::isAuthorized('manage-schedule'))
                                            <a href="{{ route('doctor_hours.edit', $horario->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Editar</a>
                                        @endif
                                        @if (\App\Helpers\RoleHelper::isAuthorized('delete-schedule'))
                                            <form action="{{ route('doctor_hours.destroy', $horario->id) }}" method="POST" style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar horario?')"><i class="fas fa-trash"></i> Eliminar</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
$(function(){
  var table = $('#dataTable').DataTable({
    pageLength: 10,
    order: [[0,'desc']],
    language: {
      // Localización completa de DataTables al español
      decimal: ",",
      thousands: ".",
      sProcessing: "Procesando...",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible",
      sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sSearch: "Buscar:",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior"
      },
      oAria: {
        sSortAscending: ": Activar para ordenar la columna ascendente",
        sSortDescending: ": Activar para ordenar la columna descendente"
      }
    }
  });
  $('#filterText').on('keyup', function(){
    table.search(this.value).draw();
  });
  function applyColumnFilters(){
    var doctor = $('#filterDoctor').val();
    var day = $('#filterDay').val();
    var start = $('#filterStart').val();
    var end = $('#filterEnd').val();
    table.columns(1).search(doctor || '', true, false);
    table.columns(3).search(day || '', true, false);
    table.draw();
    if(start || end){
      var rows = table.rows({search:'applied'}).nodes();
      rows.each(function(){
        var s = $('td:eq(3)', this).text();
        var e = $('td:eq(4)', this).text();
        var keep = true;
        if(start && s < start) keep = false;
        if(end && e > end) keep = false;
        $(this).toggle(keep);
      });
    }
  }
  $('#filterDoctor, #filterDay').on('change', applyColumnFilters);
  $('#filterStart, #filterEnd').on('change', applyColumnFilters);
  // Helper para imprimir alertas de Bootstrap en el contenedor superior
  function showAlert(type, message){
    var html = '<div class="alert alert-'+type+' alert-dismissible fade show" role="alert">'+
               message+
               '<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">'+
               '<span aria-hidden="true">&times;</span></button></div>';
    $('#alerts').html(html);
  }
  // Eliminar horario vía AJAX usando método DELETE y token CSRF
  $(document).on('submit','form[action*="doctor_hours/"][method="post"]', function(ev){
    var method = $(this).find('input[name="_method"]').val();
    if(method === 'DELETE'){
      ev.preventDefault();
      var form = $(this);
      var token = form.find('input[name="_token"]').val();
      $.ajax({
        url: form.attr('action'),
        type: 'DELETE',
        headers: { 'X-CSRF-TOKEN': token },
        success: function(resp){
          var row = form.closest('tr');
          table.row(row).remove().draw();
          showAlert('success', resp && resp.message ? resp.message : 'Eliminado correctamente');
        },
        error: function(xhr){
          if(xhr.status === 404){
            var row = form.closest('tr');
            table.row(row).remove().draw();
            showAlert('warning', 'El horario ya no existe');
          } else {
            showAlert('danger', 'No se pudo eliminar el horario (' + xhr.status + ')');
          }
        }
      });
    }
  });
});
</script>
@endpush