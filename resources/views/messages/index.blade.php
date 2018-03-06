@extends('layouts.app')

@section('content')
<div class="row">
    @foreach ($messages as $message)
        <div class="col-6">
            @include('messages.message')
        </div>
    @endforeach

	@if(count($messages))
        <div class="mt-2 mx-auto">
            {{ $messages->links() /*Esto solo funciona cuando se usa paginate*/ }}
        </div>
    @endif
</div>
@endsection