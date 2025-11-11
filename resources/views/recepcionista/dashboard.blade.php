@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="alert alert-warning shadow-sm">
        💼 Bienvenido, <strong>{{ $user->first_name }}</strong>.<br>
        Eres <strong>{{ $user->role->name }}</strong> y puedes gestionar usuarios, agendas y citas.
    </div>
</div>
@endsection
