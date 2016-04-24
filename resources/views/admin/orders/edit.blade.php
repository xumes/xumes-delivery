@extends('app')


@section('content')
    <div class="container">
        <h2>Order #{{$order->id}} - R$ {{ $order->total }}</h2>
        <h3>Client {{$order->client->user->name}} </h3>
        <h4>Data: {{ $order->created_at }}</h4>
    <p>
        <b>Delivery at:</b> <br>
        {{ $order->client->address }} - {{ $order->client->city }} - {{ $order->client->state }}
    </p>
    <br>

        {!! Form::model($order, ['route'=>['admin.orders.update', $order->id], 'class'=>'form']) !!}

        <div class="form-group">
            {!! Form::label('Status', 'Status:') !!}
            {!! Form::select('status', $list_status, null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Deliveryman', 'Delivery man:') !!}
            {!! Form::select('user_deliveryman_id', $deliveryman, null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>



@endsection