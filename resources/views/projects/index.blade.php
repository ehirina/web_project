@extends ('layouts.app')

@section('content')

	<p class="h3">Projects</p>

	@foreach ($projects as $project)
	<a href="projects/{{$project->id}}">
		<li>{{$project->name}}</li>
	</a>
	@endforeach
@endsection