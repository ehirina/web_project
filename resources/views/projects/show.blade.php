@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <p class="h3">{{ $elemento->name }} </p>

        </div>
    </div>
    <div class="card">
        <div class="card-content">
          <table class="table is-narrow table-bordered">
              <tr>
                <th style="width: 20%">Project description</th>
                <th>{{$elemento->description}}</th>
              </tr>
              <tr>
                <th>Client</th>
                <th><a class="button is-outlined" href="{{route('clients.show', $client->id)}}">{{$client->ragione_sociale}}</a></th>
              </tr>
                <tr>
                <th>Contact person</th>
                <th> {{$client->nome_referente}} {{$client->cognome_referente}} : {{$client->email}}</th>
              </tr>
              </tr>
                <tr>
                <th>Team</th>
                <th> 
                    @foreach ($team as $team_member)
                      <a class="button is-outlined" href="{{  URL::action('UserController@show', $team_member->id) }}">
                         {{$team_member->name}} {{$team_member->surname}}</a>
                    @endforeach
                    </th>
              </tr>


            <tbody>
  
            </tbody>
          </table>
        </div>
@endsection
