@extends('layouts.app')

@section('content')
	<h1>{{ $user->name }}</h1>

	<a class="btn btn-link" href="/{{ $user->username }}/follows">Sigue a
		<span class="badge badge-secondary">{{ $user->follows->count() }}</span>
	</a>

	<a class="btn btn-link" href="/{{ $user->username }}/followed">Seguidores
		<span class="badge badge-secondary">{{ $user->followers->count() }}</span>
	</a>
	@if(Auth::check())<!--Si hay un usuario logueado-->
		@if(Auth::user()->isFollowing($user))
			<!--Si el usuario logueado está siguiendo al usuario del que se están listando los mensajes-->
			<form action="/{{ $user->username }}/unfollow" method="post">
				{{ csrf_field() }}
				@if(session('success'))
					<span class="text-success">{{ session('success') }}</span>
				@endif
				<button class="btn btn-danger">Un-Follow</button> 		
			</form>
		@else
			<form action="/{{ $user->username }}/follow" method="post">
				{{ csrf_field() }}
				@if(session('success'))
					<span class="text-success">{{ session('success') }}</span>
				@endif
				<button class="btn btn-primary">Follow</button> 		
			</form>
		@endif
	@endif
	<div class="row">
		@foreach($user->messages as $message)
			<div class="col-6">
				@include('messages.message')
			</div>
		@endforeach
	</div>

@endsection