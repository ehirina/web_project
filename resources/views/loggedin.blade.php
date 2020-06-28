@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Your personal report in {{ Carbon\Carbon::now()->format('F')}}:</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table is-narrow">
                    <thead>
                    <tr>
                    <th>Total hours</th>
                    <th>Invoiced sum</th>
                </tr>
                
                    <tr>
                        <td>{{ $total_hours }}</td>
                        <td>{{ $total_sum . '  €'}}</td>
                    </tr>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
