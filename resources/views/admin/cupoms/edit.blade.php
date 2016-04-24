@extends('app')


@section('content')
    <div class="container">
        <h3>Edit category {{$category->name}}</h3>
    <br>

        @include('errors._check')

        {!! Form::model($category, ['route'=>['admin.categories.update', $category->id], 'class'=>'form']) !!}

        @include('admin.categories._form')

        <div class="form-group">
            {!! Form::submit('Update category', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection