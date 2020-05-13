    <div class="row">
        <div class="col-md-6">
            <h1>Inserisci un nuovo progetto</h1>

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
                    {{Form::label('title', 'Title')}}
                    {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
                </div>
                <div class="form-group">
                    {{Form::label('description', 'Description')}}
                    {{Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'Description'])}}
                </div>
                <div class="form-group">
                     {{Form::label('date_start', 'Start from')}}
                    {{Form::date('date_start', '', ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                     {{Form::label('date_end', 'End')}}
                    {{Form::date('date_end', '', ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    <label for="description">Descrizione</label>
                    <input class="form-control" type="text" name="description" />
                </div>

                <input class="btn btn-primary" type="submit" value="Crea">
         {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
        </div>
    </div>