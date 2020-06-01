@extends ('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <p class="h3">Pair your employee with a project <3 </p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::open(['action' => 'AssignmentController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

               <div class="form-group">
                    {{Form::label('id_project', 'Project')}}
                    
                    <select class="form-control" name="id_project">
                        @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>  

                <div class="form-group">
                    {{Form::label('id_user', 'Employee')}}
                    
                    <select class="form-control" name="id_project">
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div> 

                <div class="form-group">
                    {{Form::label('internal_rate', 'Internal rate')}}
                    {{Form::number('internal_rate', '', ['class' => 'form-control', 'step' => '0.5' ])}}
                </div>   

                   <div class="form-group">
                    {{Form::label('external_rate', 'External rate')}}
                    {{Form::number('external_rate', '', ['class' => 'form-control', 'step' => '0.5' ])}}
                </div> 


         {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
        </div>
    </div>
@endsection