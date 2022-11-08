@extends("web.plantilla")
@section("contenido")
<!-- food section -->

<section class="food_section layout_padding">
	<div class="container">
		<div class="heading_container heading_center">
			<h2>
				Nuestro Menu
			</h2>
		</div>

		<ul class="filters_menu">
			<li class="active" data-filter="*">Todos</li>
			@foreach($aCategorias AS $categoria)
			<li data-filter=".{{ $categoria->nombre }}">{{ $categoria->nombre }}</li>
			@endforeach
		</ul>
		@if(isset($msg))
		<div class="row">
			<div class="col-12 text-center">
				<div class="alert alert-{{ $msg['ESTADO'] }}" role="alert">
					{{ $msg['MSG'] }}
				</div>
			</div>
		</div>
		@endif
		<div class="filters-content">
			<div class="row grid">
				@foreach($aProductos AS $producto)
				<div class="col-sm-6 col-lg-4 all {{ $producto->categoria }}">
					<div class="box">
						<div>
							<div class="img-box">
								<img src="/files/{{ $producto->imagen }}" alt="">
							</div>
							<div class="detail-box">
								<h5>
									{{ $producto->titulo }}
								</h5>
								<p>
									{{ $producto->descripcion }}
								</p>
								<div class="options">
									<h6>
										${{ number_format($producto->precio, 0, ',', '.') }}
									</h6>
										<div class="options">
										<form action="" id="" method="POST">
											<!-- cantidad del producto que desea agregar al carrito -->
											<input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
											<input type="hidden" id="txtProducto" name="txtProducto" value="{{ $producto->idproducto }}" required>
											<input type="number" id="txtCantidad" name="txtCantidad" class="form-control" min="0" style="width: 70px;" value="0" required>
										</div>
										<div>
										<button type="submit" class="btn btn-carrito fa fa-shopping-cart fa-lg"></button>
										</div>
										</form>

								</div>

							</div>
						</div>
					</div>
				</div>
				@endforeach


			</div>
		</div>

	</div>
	<div class="btn-box">
		<a href="">
			Ver Más
		</a>
	</div>
	</div>
</section>

<!-- end food section -->
@endsection