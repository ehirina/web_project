@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>Users's details</h2>
            <p class="h3">{{ $user->name }} </p>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-secondary" href="{{  URL::action('UserController@destroy', $user->id) }}" >Delete</a>
        </div>
    </div>
@endsection
