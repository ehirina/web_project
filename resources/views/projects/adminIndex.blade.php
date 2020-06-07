@extends ('layouts.app')

@section('content')
<div class="container">
	<p class="h3">Projects</p>

	  <a class="btn btn-primary float-md-right" href="{{ URL::action('AssignmentController@create') }}" > Add assignment</a>
	@foreach ($projects as $project)
	<a href="projects/{{$project->id}}">
		<li>{{$project->name}}, {{$project->id}}</li>
	</a>
	@endforeach
</div>
@endsection