@extends ('layout.app')

@section('content')

	<p class="h3">Clients</p>
<ul>
	@foreach ($clients as $client)

		<a href="clients/{{$client->id}}">
		<li>{{$client->ragione_sociale}}</li>
	</a>
	@endforeach
</ul>
@endsection