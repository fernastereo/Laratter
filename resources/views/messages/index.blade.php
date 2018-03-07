@extends('layouts.app')

@section('content')
<div class="row">
    @foreach ($messages as $message)
        <div class="col-6">
            @include('messages.message')
        </div>
    @endforeach
</div>
@endsection