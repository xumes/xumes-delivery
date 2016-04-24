@extends('app')


@section('content')
    <div class="container">
        <h3>Edit client {{$client->user->name}}</h3>
    <br>

        @include('errors._check')

        {!! Form::model($client, ['route'=>['admin.clients.update', $client->id], 'class'=>'form']) !!}

        @include('admin.clients._form')

        <div class="form-group">
            {!! Form::submit('Update client', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection