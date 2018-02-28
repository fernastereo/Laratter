@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>Laratter</h1>
        <nav class="">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <form action="/messages/create" method="post">
            <div class="form-group">
                {{ csrf_field() }}
                <input type="text" name="message" class="form-control" placeholder="Qué estás Pensando?">
            </div>
        </form>
    </div>
    <div class="row">
        @forelse ($messages as $message)
            <div class="col-6">
                <img class="img-thumbnail" src="{{ $message->image }}"></img>
                <p class="card-text">{{ $message->content }} <a href="/messages/{{ $message->id }}">Leer mas</a> </p>
            </div>
        @empty 
            <p>No hay ningun mensaje destacados!</p>
        @endforelse
    </div>
@endsection
