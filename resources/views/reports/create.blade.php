@extends ('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <p class="h3">What are you working on?</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::open(['action' => 'TimeEntryController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

               <div class="form-group">
                    {{Form::label('id_project', 'Project')}}
                    
                    <select class="form-control" name="id_project">
                        @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>  


                <div class="form-group">
                    {{Form::label('note', 'Note')}}
                    {{Form::textarea('note', '', ['class' => 'form-control', 'placeholder' => 'What did you do?'])}}
                </div>


                <div class="form-group">
                    {{Form::label('ore', 'Time spent (hours)')}}
                    {{Form::number('ore', '', ['class' => 'form-control', ])}}
                </div>       
         {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
        </div>
    </div>
@endsection