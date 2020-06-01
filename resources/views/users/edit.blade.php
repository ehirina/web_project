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

            {!! Form::open(['action' => ['UserController@update', '$user->id'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                {{method_field('PUT')}}
                {{csrf_field()}}
                 <div class="form-group">
                    {{Form::label('name', 'Nome')}}
                    {{Form::text('name', $user->name, ['class' => 'form-control'])}}
                </div>

                <div class="form-group">
                     {{Form::label('email', 'Email')}}
                    {{Form::email('email', $user->email, ['class' => 'form-control', 'placeholder' => 'example@address.com'])}}
                </div>

                <div class="form-group">
                      {{ Form::radio('result', 'Do not change password' , true) }}
                        {{ Form::radio('result', 'Change password with' , false) }}
                    {{Form::password('password')}}
                </div>

                
                <div class="form-group">
                    {{Form::label('admin', 'Admin')}}
                    {{Form::checkbox('admin', '' )}}
                </div>

        {{Form::hidden('_method','PUT')}}
         {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
        </div>
    </div>
@endsection

