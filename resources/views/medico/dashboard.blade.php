@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="alert alert-success shadow-sm">
        🩺 Hola Dr. <strong>{{ $user->last_name }}</strong>.<br>
        Eres <strong>{{ $user->role->name }}</strong> y puedes consultar tu agenda y atender pacientes.
    </div>
</div>
@endsection
