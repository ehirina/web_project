@extends('layouts.app')


@section('content')

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="row">
        <div class="col-md-12">
            <p class="h3">{{ $elemento->ragione_sociale }} </p>

        </div>
    </div>
    <div class="card">
        <div class="card-content">
          <table class="table is-narrow">
              <tr>
                <th style="width: 17%">Contact Person</th>
                <th>{{$elemento->nome_referente}} {{$elemento->cognome_referente}}</th>
              </tr>
              <tr>
                <th>Email</th>
                <th>{{$elemento->email}}</th>
              </tr>
              <tr>
                <th>SSID</th>
                <th>{{$elemento->ssid}}</th>
              </tr>
              <tr>
                <th>Pec</th>
                <th>{{$elemento->pec}}</th>
              </tr>
              <tr>
                <th>Partita IVA</th>
                <th>{{$elemento->partita_iva}}</th>
                </tr>
                <tr>
                <th>Projects</th>
                <th> 
                    @foreach ($projects as $project)
                      <a class="button is-outlined" href="{{  URL::action('ProjectController@show', $project->id) }}">
                         {{$project->name}}</a>
                    @endforeach
                    </th>
              </tr>
          </table>
</div>
</div>

 <hr class="m-t-0">
<h5>Info for period from <b id="from">{{Carbon\Carbon::now()->startOfMonth()->format('d F Y')}} </b> to <b id="to">{{Carbon\Carbon::now()->endOfMonth()->format('d F Y')}}</b> </h5>
        <div class="card">
        <div class="card-content">
          <table class="table is-narrow">
            <thead>
              <tr>
                <th>Total time spent</th>
                <th>Income</th>
                <th>Personnel expenses</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                  <td id="total_time">{{$total_time_spent}}</td>
                  <td id="income">{{$income. '  €'}}</td>
                  <td id="expenses">{{$expenses. '  €'}}</td>
              </tr>
            </tbody>
          </table>
        </div>
    </div>
<br>
<h5> Change period: </h5>

              <div class="form-group">
                     {{Form::label('date_from', 'Start')}}
                    {{Form::date('date_from', '', ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                     {{Form::label('date_to', 'End')}}
                    {{Form::date('date_to', '', ['class' => 'form-control'])}}
                </div>   
                <button type="button" class="btn btn-primary" id="getRequest">Save</button>
 
        

<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    $('document').ready(function(){
        console.log('Ciao');

        $('#getRequest').bind('click', function(event) {
            event.preventDefault(); // Fermo l'azione 

            var button = $(this);
       
            var Jdata = {
              date_from: $('#date_from').val(),
              date_to: $('#date_to').val(),
              client_id: {{$elemento->id}},
            };

            console.log(Jdata);
            $.ajax({
                url: "/clientinfo/", 
                //url: url,
                type: "GET",
                dataType: "json",
                data: {
                  'message': Jdata,
                  '_token': $('meta[name="csrf-token"]').attr('content')},
                success: function(response) {
                  // $("#exampleModal").modal("hide");
                    console.log(response);
                    $("#from").text(response.date_from);
                    $("#to").text(response.date_to);
                    $("#total_time").text(response.total_time_spent);
                    $("#income").text(response.income);
                    $("#expenses").text(response.expenses);
                    $("#date_to").val('');
                    $("#date_from").val('');
                    // $(button).parents('tr').fadeOut();
                }, 
                error: function(response, stato) {
                  //alert("Data is incorrect, please try again.");
                    console.log(response);
                }
            });

        });
    });
</script>

@endsection
