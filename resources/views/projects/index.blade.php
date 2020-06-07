@extends ('layouts.app')

@section('content')

<p class="h3">Your projects</p>
<br />
<div class="row">
    <div class="col-md-12">
            @if (count($projects) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Project Title</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->description }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else 
                <p>There are not projects yet :)</p>
            @endif
    </div>        
</div>
@endsection