@extends ('layout.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <p class="h3">New client?</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::open(['action' => 'ClientController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            @csrf
                <div class="form-group">
                    {{Form::label('ragione_sociale', 'Ragione Sociale')}}
                    {{Form::text('ragione_sociale', '', ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('nome_referente', 'Nome referente')}}
                    {{Form::text('nome_referente', '', ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    {{Form::label('cognome_referente', 'Cognome referente')}}
                    {{Form::text('cognome_referente', '', ['class' => 'form-control' ])}}
                </div>
                <div class="form-group">
                     {{Form::label('email', 'Email')}}
                    {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'example@address.com'])}}
                </div>
                  <div class="form-group">
                     {{Form::label('ssid', 'SSID')}}
                    {{Form::text('ssid', '', ['class' => 'form-control', 'placeholder' => 'es. 0000000'])}}
                </div>
                  <div class="form-group">
                     {{Form::label('pec', 'PEC')}}
                    {{Form::email('pec', '', ['class' => 'form-control', 'placeholder' => 'example@address.com'])}}
                </div>
                <div class="form-group">
                     {{Form::label('partita_iva', 'Partita Iva')}}
                    {{Form::text('partita_iva', '', ['class' => 'form-control'])}}
                </div>       
         {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
        </div>
    </div>
    @endsection