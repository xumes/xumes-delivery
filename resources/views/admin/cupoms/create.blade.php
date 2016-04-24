@extends('app')


@section('content')
    <div class="container">
        <h3>New Cupom</h3>
    <br>

        @include('errors._check')

        {!! Form::open(['route'=>'admin.cupoms.store', 'class'=>'form']) !!}

        @include('admin.cupoms._form')

        <div class="form-group">
            {!! Form::submit('Create cupom', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection