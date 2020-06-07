@extends ('layouts.app')

@section('content')

	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<p class="h3">Reports</p>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>


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
                    console.log(response);
                }, 
                error: function(response, stato) {
                    console.log(response);
                }
            });

        });
    });
</script>
@endsection