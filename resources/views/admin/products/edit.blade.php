@extends('app')


@section('content')
    <div class="container">
        <h3>Edit product {{$product->name}}</h3>
    <br>

        @include('errors._check')

        {!! Form::model($product, ['route'=>['admin.products.update', $product->id], 'class'=>'form']) !!}

        @include('admin.products._form')

        <div class="form-group">
            {!! Form::submit('Update product', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection