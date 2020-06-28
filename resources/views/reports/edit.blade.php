@extends ('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
        
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::open(['action' => array('ReportController@update', $report->id), 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
               <div class="form-group">
                    {{Form::label('id_project', 'Project')}}
                    <select class="form-control" name="id_project">
                        @foreach ($projects as $project)
                        <option value="{{ $project->id }}" @if($project->id == $report->id_project) selected='selected' @endif }}>{{ $project->name }}</option>
                        @endforeach
                    </select>

                </div>  

                <div class="form-group">
                    {{Form::label('note', 'Note')}}
                    <input type="text" class="form-control" name="note" value="{{ old('note', $report->note) }}">
                </div>

                <div class="form-group">
                    {{Form::label('ore', 'Time spent (hours)')}}
                    <input type="number" class="form-control" name="ore" value="{{ old('ore', $report->ore) }}">
                </div>
                <div class="form-group">
                    {{Form::label('date', 'Date')}}
                    <input type="date" class="form-control" name="date" value="{{ old('date', $report->date) }}">
                </div>           
         {{Form::submit('Update', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
        </div>
    </div>
@endsection