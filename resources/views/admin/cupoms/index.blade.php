@extends('app')


@section('content')
    <div class="container">
        <h3>Cupoms</h3>
    <br>
    <a href="{{route('admin.cupoms.create')}}" class="btn btn-default">New cupom</a>

    <br><br>

    <table class="table table-bordered table-hover">

        <thead>
        <tr>
            <th>ID</th>
            <th>Cupom</th>
            <th>Valor</th>
            <th>Action</th>
        </tr>
        </thead>

        <tdoby>
            @foreach($cupoms as $cupom)
            <tr>
                <td>{{ $cupom->id  }}</td>
                <td>{{ $cupom->code  }}</td>
                <td>{{ $cupom->value  }}</td>
                <td>
                    <a href="{{route('admin.cupoms.edit', $cupom->id)}}" class="btn btn-default btn-sm">Edit</a>
                </td>
            </tr>
            @endforeach
        </tdoby>
    </table>

    {!! $cupoms->render() !!}

    </div>

@endsection