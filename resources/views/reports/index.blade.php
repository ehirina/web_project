@extends ('layout.app')

@section('content')

	<p class="h3">Reports</p>

	@foreach ($reports as $report)
	<a href="projects/{{$report->id}}">
		<li>{{$report->note}}</li>
	</a>
	@endforeach
@endsection