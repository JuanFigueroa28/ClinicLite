@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="alert alert-secondary shadow-sm">
        👋 Hola {{ $user->first_name }}.<br>
        No tienes un rol asignado actualmente.
    </div>
</div>
@endsection
