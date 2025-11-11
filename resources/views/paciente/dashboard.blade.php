@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="alert alert-info shadow-sm">
        🙋‍♂️ Bienvenido, <strong>{{ $user->first_name }}</strong>.<br>
        Eres <strong>{{ $user->role->name }}</strong> y puedes ver y gestionar tus citas.
    </div>
</div>
@endsection
