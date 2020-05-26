@extends('layout.app')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>Client's details</h2>
            <p class="h3">{{ $elemento->ragione_sociale }} </p>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-secondary" href="{{  URL::action('ClientController@edit', $elemento->id) }}" >Edit</a>
            <a class="btn btn-danger" href="#" >Cancel</a>
        </div>
    </div>
@endsection
