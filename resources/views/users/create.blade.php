@extends ('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <p class="h3">Add new users</p>

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
                {{csrf_field()}}
                 <div class="form-group">
                    {{Form::label('name', 'Name')}}
                    {{Form::text('name', '', ['class' => 'form-control'])}}
                </div>

                <div class="form-group">
                    {{Form::label('surname', 'Surname')}}
                    {{Form::text('surname', '', ['class' => 'form-control'])}}
                </div>

                <div class="form-group">
                     {{Form::label('email', 'Email')}}
                    {{Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'example@address.com'])}}
                </div>

                <div class="form-group">
                    {{Form::label('password', 'Password')}}
                    {{Form::password('password', ['class' => 'form-control'])}}
                </div>

                
                <div class="form-group">
                {{Form::label('role', 'Role')}}
                    
                    <select class="form-control" name="role">
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                        @endforeach
                    </select>
                </div>  

         {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
        </div>
    </div>
@endsection

