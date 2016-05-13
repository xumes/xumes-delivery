<!DOCTYPE html>
<html>
    <head>
        <title>Xumes Delivery</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    @if(Auth::user())
                        @if(Auth::user()->role == 'admin')
                            <li><a href="{{route("admin.categories.index") }}">Categories</a></li>
                            <li><a href="{{route("admin.products.index") }}">Products</a></li>
                            <li><a href="{{route("admin.clients.index") }}">Clients</a></li>
                            <li><a href="{{route("admin.orders.index") }}">Orders</a></li>
                            <li><a href="{{route("admin.cupoms.index") }}">Cupoms</a></li>
                        @elseif(Auth::user()->role == 'client')
                            <li><a href="{{route("customer.order.index") }}">My Orders</a></li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </body>
</html>
