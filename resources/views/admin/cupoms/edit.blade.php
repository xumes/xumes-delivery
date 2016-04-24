@extends('app')


@section('content')
    <div class="container">
        <h3>Edit cupom {{$cupom->name}}</h3>
    <br>

        @include('errors._check')

        {!! Form::model($cupom, ['route'=>['admin.cupoms.update', $cupom->id], 'class'=>'form']) !!}

        @include('admin.cupoms._form')

        <div class="form-group">
            {!! Form::submit('Update cupom', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection