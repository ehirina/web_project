@extends('layouts.app')


@section('content')

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="row">
        <div class="col-md-12">
            <p class="h3">{{ $elemento->name }} </p>
        </div>
    </div>
            <hr class="m-t-0">

    <h5>Total time: {{$ore_totale}} h</h5>
        <div class="card">
        <div class="card-content">
          <table class="table is-narrow">
            <thead>
              <tr>
                <th>Position</th>
                <th>Work description</th>
                <th>Date</th>
                <th>Hours</th>
                <th></th>
              </tr>
            </thead>

            <tbody>
              
                @foreach ($reports as $report)
                <tr>
                  <td>{{$report->position}}</td>
                  <td>{{$report->note}}</td>
                  <td>{{$report->date}}</td>
                  <td>{{$report->hours}}</a></td>
                  <td> 
                  <a class="btn btn-danger btn-xs" onclick="event.preventDefault(); document.getElementById('delete-report').submit();">Delete</a>
                    <form id="delete-report"
                                action="{{ route('reports.destroy', $report->id) }}"
                                method="POST"
                                style="display: none;"
                    >
                        {{ method_field('DELETE') }}
                      {{ csrf_field() }}
                    </form></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    </div>
</div>
</div>

@endsection