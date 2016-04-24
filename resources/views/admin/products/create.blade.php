@extends('app')


@section('content')
    <div class="container">
        <h3>New Product</h3>
    <br>

        @include('errors._check')

        {!! Form::open(['route'=>'admin.products.store', 'class'=>'form']) !!}

        @include('admin.products._form')

        <div class="form-group">
            {!! Form::submit('Create product', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection