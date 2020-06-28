@extends ('layouts.app')

@section('content')
 <div class="flex-container">
 <div class="columns m-t-10">
   <div class="column">
	<h1 class="title">Projects</h1>
</div>
	 <div class="column">
          <a href="{{route('projects.create')}}" class="button is-primary is-pulled-right"><i class="fa fa-user-plus m-r-10"></i> Add New Project</a>
        </div>
        <div class="column">
          <a href="{{route('assignments.create')}}" class="button is-primary is-pulled-right"><i class="fa fa-user-plus m-r-10"></i> Add Assignment</a>
        </div>
</div>
	      <hr class="m-t-0">

	    <div class="card">
        <div class="card-content">
          <table class="table is-narrow">
            <thead>
              <tr>
                <th>Project name</th>
                <th>Description</th>
                <th>Company</th>
                <th>Action</th>
                <th></th>
              </tr>
            </thead>

            <tbody>
              
				@foreach ($projects as $project)
                <tr>
                  <td><a class="button is-outlined" href="{{route('projects.show', $project->id)}}">{{$project->name}}</a></td>
                  <td>{{$project->description}}</td>
                  <td><a class="button is-outlined" href="{{route('clients.show', $project->client_id)}}">{{$project->client}}</a></td>
                  <td> <a class="btn btn-danger btn-xs" href="{{  URL::action('ProjectController@destroy', $project->id) }}" >Delete</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
	</div>
</div>
@endsection