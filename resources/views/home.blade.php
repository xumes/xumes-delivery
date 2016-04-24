@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					<ul>
					<li><a href="{{ url('/') }}">Home</a></li>
					<li><a href="{{route("admin.categories.index") }}">Categories</a></li>
					<li><a href="{{route("admin.products.index") }}">Products</a></li>
					<li><a href="{{route("admin.clients.index") }}">Clients</a></li>
						<li><a href="{{route("admin.orders.index") }}">Orders</a></li>
                        <li><a href="{{route("admin.cupoms.index") }}">Cupoms</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection