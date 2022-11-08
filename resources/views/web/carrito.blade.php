@extends("web.plantilla")
@section("contenido")
<!-- carrito -->

<section class="carrito layout_padding">
      <div class="container">
            <div class="heading_container">
                  <h2>
                        Mi carrito
                  </h2>
            </div>
            @if(isset($msg))
            <div class="row">
                  <div class="col-12 text-center">
                        <div class="alert alert-{{ $msg['err'] }}" role="alert">
                              {{ $msg['mensaje'] }}
                        </div>
                  </div>
            </div>
            @endif

            <div class="row">
                  @if($aCarritos)
                  <div class="col-md-9">
                        <div class="row mt-2 p-2">
                              <div class="col-md-12">
                                    <table class="table table-hover">
                                          <thead>
                                                <tr>
                                                      <th></th>
                                                      <th></th>
                                                      <th></th>
                                                      <th>Precio</th>
                                                      <th style="width: 15px;">Cantidad</th>
                                                      <th>Subtotal</th>
                                                      <th></th>
                                                </tr>
                                          </thead>
                                          <tbody>
                                                <?php 
                                                $total = 0;
                                                ?>

                                                @foreach($aCarritos AS $carrito)
                                                <?php 
                                                $subtotal = $carrito->precio * $carrito->cantidad;
                                                $total += $subtotal;
                                                ?>
                                                <tr>
                                                      <form action="" id="" method="POST">
                                                            <td style="width: 0px;">
                                                                  <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                                                  <input type="hidden" id="txtCarrito" name="txtCarrito" class="form-control" value="{{ $carrito->idcarrito }}" required>
                                                            </td>
                                                            <td style="width: 100px;">
                                                                  <img src="/files/{{$carrito->imagen}}" class="img-thumbnail">
                                                            </td>
                                                            <td>
                                                                  {{ $carrito->producto }}
                                                            </td>
                                                            <td>
                                                                  ${{ $carrito->precio }}
                                                            </td>
                                                            <td style="width: 15px;">

                                                                  <input class="form-control" value="{{$carrito->fk_idproducto}}" type="hidden" name="txtProducto" id="txtProducto">
                                                                  <input class="form-control" value="{{$carrito->cantidad}}" min="1" type="number" name="txtCantidad" id="txtCantidad">

                                                            </td>
                                                            <td>
                                                                  ${{ number_format($subtotal, 2, ",", ".") }}
                                                            </td>
                                                            <td>
                                                                  <div class="btn-group">
                                                                        <button type="submit" class="btn btn-info" id="btnActualizar" name="btnActualizar"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                                                                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                                                                                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                                                                              </svg>
                                                                        </button>
                                                                        <button type="submit" class="btn btn-danger" id="btnBorrar" name="btnBorrar"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                                              </svg>
                                                                        </button>
                                                                  </div>
                                                            </td>
                                                      </form>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                      <td colspan="4" style="text-align: right;">¿Te faltó algo?</td>
                                                      <td colspan="2" style="text-align: right;"><a class="btn btn-primary" href="takeaway">Continuar pedido</a></td>
                                                </tr>
                                          </tbody>
                                    </table>
                              </div>
                        </div>
                  </div>
                  <div class="col-md-3">
                        <div class="row mt-2 p-2">
                              <div class="col-md-12">
                                    <table class="table">
                                          <thead>
                                                <tr>
                                                      <th> TOTAL: $ {{ number_format($total, 2, ",", ".") }} </th>
                                                </tr>
                                          </thead>
                                          <form action="" id="" method="POST">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                                <tbody>
                                                      <tr>
                                                            <td>
                                                                  <label class="d-block">Sucursal:</label>
                                                                  <select id="lstSucursal" name="lstSucursal" class="form-select" required>
                                                                        <option value="" disabled selected>Seleccionar</option>
                                                                        @foreach($aSucursales as $sucursal)
                                                                        <option value="{{ $sucursal->idsucursal }}">{{ $sucursal->nombre }}</option>
                                                                        @endforeach
                                                                  </select>
                                                            </td>
                                                      </tr>
                                                      <tr>
                                                            <td>
                                                                  <label>Metodo de pago:</label>
                                                                  <select id="lstPago" name="lstPago" class="form-select" required>
                                                                        <option value="" disabled selected>Seleccionar</option>
                                                                        <option value="Mercadopago">Mercadopago</option>
                                                                        <option value="Efectivo">Efectivo</option>
                                                                  </select>
                                                            </td>
                                                      </tr>
                                                      <tr>
                                                            <td><button type="submit" class="btn btn-success" id="btnFinalizar" name="btnFinalizar">Finalizar compra</button></td>
                                                      </tr>
                                                </tbody>
                                          </form>
                                    </table>
                              </div>
                        </div>
                  </div>
                  @else
                  <div class="row">
                        <div class=" col-md-12">
                              <p>No hay productos seleccionados</p>
                        </div>
                  </div>
                  @endif
            </div>
</section>
<!-- endcarrito -->
@endsection