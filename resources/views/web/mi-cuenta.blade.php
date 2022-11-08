@extends("web.plantilla")
@section("contenido")

<section class="book_section layout_padding">
  <div class="container">
    <div class="heading_container">
      <h2>
        Datos del Usuario
      </h2>
    </div>

    <div class="form_container">
      <form action="" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
        <div class="row">
          <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Nombre" id="txtNombre" name="txtNombre" value="{{ $cliente->nombre }} " required/>
          </div>
          <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Telefono" id="txtTelefono" name="txtTelefono" value="{{ $cliente->telefono}}"required />
          </div>
          <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Direccion" id="txtDireccion" name="txtDireccion" value="{{ $cliente->direccion }}" required/>
          </div>
          
          <div class="col-md-6">
            <input type="text" class="form-control" placeholder="Documento" id="txtDni" name="txtDni" value="{{ $cliente->dni}}"required />
          </div>
          <div class="col-md-6">
            <input type="email" class="form-control" placeholder="Correo" id="txtCorreo" name="txtCorreo" value="{{ $cliente->correo}}" required />
          </div>
        </div>
        <div class="btn_box text-center">
          <button type="submit" name="btnGuardar" id="btnGuardar">
            Guardar
          </button>
        </div>
      </form>
    </div>
    <div class="row">
      <div class="col-12">
        <a href="/cambiar-clave">Cambiar clave</a>
      </div>
    </div>
  
    <div class="row">
      <h2 class="mt-4">Pedidos Activos</h2>
      <div class="col-10 offset-1 mt-2">
        <table class="table table-hover mt-3">
          <thead>
            <tr>
              <th>Sucursal</th>
              <th>Pedido</th>
              <th>Estado Pedido</th>
              <th>Fecha</th>
              <th>Total</th>
            </tr>
        </thead>
          <tbody>
          @foreach($aPedidos AS $pedido)
            <tr>
              <td>{{$pedido->sucursal}}</td>
              <td>{{$pedido->idpedido}}</td>
              <td>{{$pedido->estado_del_pedido}}</td>
              <td>{{ $pedido->fecha}}</td>
              <td>${{$pedido->total}}</td>
              
              
              
              @endforeach
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>


</section>
@endsection