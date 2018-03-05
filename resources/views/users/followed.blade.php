@extends('layouts.app')

@section('content')
	@foreach($user->followers as $follow)
		<li>
			{{ $follow->username }}
		</li>
	@endforeach
@endsection