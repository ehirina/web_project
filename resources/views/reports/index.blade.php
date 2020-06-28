@extends ('layouts.app')

@section('content')

	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


 <div class="flex-container">
 <div class="columns m-t-10">
   <div class="column">
	<h1 class="title">Reports</h1>
</div>
	 <div class="column">
          <a href="{{route('projects.create')}}" class="button is-primary is-pulled-right"  data-toggle="modal" data-target="#exampleModal"><i class="fa fa-user-plus m-r-10"></i> Add New Report</a>
        </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
                    {{Form::label('id_project', 'Project')}}
                    
                    <select class="form-control" name="id_project" id='id_project'>
                        @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>  


                <div class="form-group">
                    {{Form::label('note', 'Note')}}
                    {{Form::textarea('note', '', ['class' => 'form-control', 'id' => 'note', 'placeholder' => 'What did you do?'])}}
                </div>


                <div class="form-group">
                    {{Form::label('ore', 'Time spent (hours)')}}
                    {{Form::number('ore', '', ['class' => 'form-control', 'id' => 'ore', 'min'=> '0'])}}
                </div>   
                  <div class="form-group">
                     {{Form::label('date', 'Date')}}
                    {{Form::date('date', '', ['class' => 'form-control', 'id' => 'date'])}}
                </div>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="postRequest">Save</button>
      </div>
    </div>
  </div>
</div>

        <hr class="m-t-0">
<h5>Info for period from {{$from}} to {{$to}}</b> </h5>
        <hr class="m-t-0">

        <div class="card">
        <div class="card-content">
          <table class="table is-narrow">
            <thead>
              <tr>
                <th>Project name</th>
                <th>Position</th>
                <th>Work description</th>
                <th>Date</th>
                <th>Hours</th>
                <th></th>
              </tr>
            </thead>

            <tbody>
              
                @foreach ($reports as $report)
                <tr>
                  <td><a class="button is-outlined" href="{{route('projects.show', $report->project_id)}}">{{$report->project_name}}</a></td>
                  <td>{{$report->position}}</td>
                  <td>{{$report->note}}</td>
                  <td>{{$report->date}}</td>
                  <td>{{$report->hours}}</a></td>
                  <td> 
                    <div class="btn-group" role="group" aria-label="Basic example">
                   <form
                                action="{{ route('reports.destroy', $report->id) }}"
                                method="POST"
                    >
                      <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    {{ method_field('DELETE') }}
                      {{ csrf_field()}}
                    </form>
                    <form
                                action="{{ route('reports.edit', $report->id) }}"
                                method="GET"
                    >
                      <button type="submit" class="btn btn-primary  btn-sm">Update</button>
                    </form>
                  </div>
                  </td>
                     
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    </div>
    <hr class="m-t-0">
<h5> Change period: </h5>
 <form
    action="{{ route('reports-bydate.index') }}"
    method="GET"
                    >
              <div class="form-group">
                     {{Form::label('date_from', 'Start')}}
                    {{Form::date('date_from', '', ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                     {{Form::label('date_to', 'End')}}
                    {{Form::date('date_to', '', ['class' => 'form-control'])}}
                </div>   
                <button type="submit" class="btn btn-primary">Save</button>
 </form>
        


<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    $('document').ready(function(){
        console.log('Ciao');

        $('#postRequest').bind('click', function(event) {
            event.preventDefault(); // Fermo l'azione 
       
            var Jdata = {
            	id_project: $('#id_project').val(),
            	id_user: "{{Auth::id()}}",
            	ore: $('#ore').val(),
            	date: $('#date').val(),
            	note: $('#note').val(),
            };

            console.log(Jdata);
            $.ajax({
                url: "/reports", 
                //url: url,
                type: "POST",
                dataType: "json",
                data: {
                	'message': Jdata,
                	'_token': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                	$("#exampleModal").modal("hide");
                    console.log(response);
                }, 
                error: function(response, stato) {
                	alert("Data is incorrect, please try again.");
                    console.log(response);
                }
            });

        });

    });
</script>
@endsection