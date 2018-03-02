<img class="img-thumbnail" src="{{ $message->image }}"></img>
<p class="card-text">
	<div class="text-muted">Escrito Por: 
		<a href="{{ $message->user->username }}">{{ $message->user->name }}</a>
		<small class="text-muted">{{ $message->created_at }}</small>
	</div>
	{{ $message->content }} 
	<a href="/messages/{{ $message->id }}">Leer mas</a> 
</p>