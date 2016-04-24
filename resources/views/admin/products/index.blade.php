@extends('app')


@section('content')
    <div class="container">
        <h3>Products</h3>
    <br>
    <a href="{{route('admin.products.create')}}" class="btn btn-default">New product</a>

    <br><br>

    <table class="table table-bordered table-hover">

        <thead>
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Category</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        </thead>

        <tdoby>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id  }}</td>
                <td>{{ $product->name  }}</td>
                <td>{{ $product->category->name  }}</td>
                <td>{{ $product->price  }}</td>
                <td>
                    <a href="{{route('admin.products.edit', $product->id)}}" class="btn btn-default btn-sm">Edit</a>
                    <a href="{{route('admin.products.destroy', $product->id)}}" class="btn btn-default btn-sm">Remove</a>
                </td>
            </tr>
            @endforeach
        </tdoby>
    </table>

    {!! $products->render() !!}

    </div>

@endsection