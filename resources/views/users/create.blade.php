@extends ('layout.app')

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

            {!! Form::open(['action' => 'UserController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                 <div class="form-group">
                    {{Form::label('nome', 'Nome referente')}}
                    {{Form::text('nome_referente', '', ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('cognome_referente', 'Cognome referente')}}
                    {{Form::text('cognome_referente', '', ['class' => 'form-control' ])}}
                </div>


                <div class="form-group">
                    {{Form::label('note', 'Note')}}
                    {{Form::textarea('note', '', ['class' => 'form-control', 'placeholder' => 'What did you do?'])}}
                </div>


                <div class="form-group">
                    {{Form::label('ore', 'Time spent')}}
                    {{Form::number('ore', '', ['class' => 'form-control', ])}}
                </div>       
         {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
        </div>
    </div>
@endsection