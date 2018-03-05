@extends('layouts.app')

@section('content')
<form method="post" action="/auth/facebook/register">
	{{ csrf_field() }}
	<div class="card">
		<div class="card-block">
			<img src="{{ $user->avatar }}" alt="" class="img-thumbnail">
		</div>
		<div class="card-block">
			<div class="form-group">	
				<label for="name" class="form-control-label">Nombre:</label>
				<input class="form-control" type="text" name="name" value="{{ $user->name }}" readonly>
			</div>

			<div class="form-group">	
				<label for="email" class="form-control-label">E-mail:</label>
				<input class="form-control" type="text" name="enmail" value="{{ $user->email }}" readonly>
			</div>

			<div class="form-group">	
				<label for="username" class="form-control-label">Nombre Usuario:</label>
				<input class="form-control" type="text" name="username" value="{{ old('username') }}">
			</div>
		</div>
		<div class="car-footer">
			<button class="btn btn-primary">Registrarse</button>
		</div>
	</div>
</form>
@endsection