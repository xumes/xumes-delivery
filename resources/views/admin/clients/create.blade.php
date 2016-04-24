@extends('app')


@section('content')
    <div class="container">
        <h3>New Client</h3>
    <br>

        @include('errors._check')

        {!! Form::open(['route'=>'admin.clients.store', 'class'=>'form']) !!}

        @include('admin.clients._form')

        <div class="form-group">
            {!! Form::submit('Save client', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection