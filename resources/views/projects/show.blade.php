@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>Project's details</h2>
            <p class="h3">{{ $elemento->name }} </p>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-secondary" href="{{  URL::action('ProjectController@destroy', $elemento->id) }}" >Delete</a>
        </div>
    </div>
@endsection
