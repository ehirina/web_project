@extends ('layouts.app')


@section('content')
 <div class="flex-container">
 <div class="columns m-t-10">
   <div class="column">
          <h1 class="title">Clients</h1>
        </div>
        <div class="column">
          <a href="{{route('clients.create')}}" class="button is-primary is-pulled-right"><i class="fa fa-user-plus m-r-10"></i> Add New Client</a>
        </div>
      </div>

       <hr class="m-t-0">

      <div class="card">
        <div class="card-content">
          <table class="table is-narrow">
            <thead>
              <tr>
                <th>Company name</th>
                <th>Contact person</th>
                <th>Email</th>
                <th></th>
              </tr>
            </thead>

            <tbody>
              @foreach ($clients as $client)
                <tr>
                  <td><a class="button is-outlined" href="{{route('clients.show', $client->id)}}">{{$client->ragione_sociale}}</a></td>
                  <td>{{$client->nome_referente}} {{$client->cognome_referente}}</td>
                  <td>{{$client->email}}</td>

              <td>{{ Form::open(['method' => 'DELETE', 'route' => ['clients.destroy', $client->id]]) }}
                  <button type="submit" class="btn btn-danger btn-xs">Delete</button>
                  {{ Form::close() }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
	</div>
</div>

@endsection