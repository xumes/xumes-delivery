@extends('app')


@section('content')
    <div class="container">
        <h3>Clients</h3>
    <br>
    <a href="{{route('admin.clients.create')}}" class="btn btn-default">New client</a>

    <br><br>

    <table class="table table-bordered table-hover">

        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
        </thead>

        <tdoby>
            @foreach($clients as $client)
            <tr>
                <td>{{ $client->id  }}</td>
                <td>{{ $client->user->name  }}</td>
                <td>
                    <a href="{{route('admin.clients.edit', $client->id)}}" class="btn btn-default btn-sm">Edit</a>
                </td>
            </tr>
            @endforeach
        </tdoby>
    </table>

    {!! $clients->render() !!}

    </div>

@endsection