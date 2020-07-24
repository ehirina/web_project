@extends ('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <p class="h3">New project?</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::open(['action' => 'ProjectController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    {{Form::label('name', 'Title')}}
                    {{Form::text('name', '', ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('description', 'Description')}}
                    {{Form::textarea('description', '', ['class' => 'form-control', ])}}
                </div>
                <div class="form-group">
                     {{Form::label('date_start', 'Start')}}
                    {{Form::date('date_start', '', ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                     {{Form::label('date_end', 'End')}}
                    {{Form::date('date_end', '', ['class' => 'form-control'])}}
                </div>   

                <div class="form-group">
                    {{Form::label('id_cliente', 'Client')}}
                    
                    <select class="form-control" name="id_cliente">
                        @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->ragione_sociale }}</option>
                        @endforeach
                    </select>
                </div>     
         {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
        </div>
    </div>
@endsection