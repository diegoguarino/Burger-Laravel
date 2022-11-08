@extends("web.plantilla")
@section("banner")
<!-- slider section -->
<section class="slider_section ">
  <div id="customCarousel1" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="container ">
          <div class="row">
            <div class="col-md-7 col-lg-6 ">
              <div class="detail-box">
                <h1>
                  Hamburguesas a domicilio
                </h1>
                <p>
                  Disfruta de nuestros deliciosos productos desde la comodidad de tu hogar, a solo unos clics de distancia. ¡Con solo crear una cuenta en nuestro portal tendrás acceso a todos los beneficios de ser un cliente de Burgers SRL!
                </p>
                <div class="btn-box">
                  <a href="/registrarse" class="btn1">
                    Crea tu cuenta
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item ">
        <div class="container ">
          <div class="row">
            <div class="col-md-7 col-lg-6 ">
              <div class="detail-box">
                <h1>
                  Promociones todos los días
                </h1>
                <p>
                  ¿Tienes antojo de hamburguesa? ¡No lo pienses más! Calma tu hambre sin gastar más con nuestras inigualables promociones. ¡Todos los días tenemos descuentos para ti!
                </p>
                <div class="btn-box">
                  <a href="" class="btn1">
                    Ingresa a tu cuenta
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="container ">
          <div class="row">
            <div class="col-md-7 col-lg-6 ">
              <div class="detail-box">
                <h1>
                  Variedad de sabores
                </h1>
                <p>
                  Nuestra carta de hamburguesas y guarniciones está pensada para deleitar hasta a los paladares más exigentes y ofrecer una amplia variedad de opciones y sabores para todos los gustos. ¡Conócela ahora!
                </p>
                <a href="/takeaway" class="btn1">
                  Pide ahora
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <ol class="carousel-indicators">
        <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
        <li data-target="#customCarousel1" data-slide-to="1"></li>
        <li data-target="#customCarousel1" data-slide-to="2"></li>
      </ol>
    </div>
  </div>

</section>
<!-- end slider section -->
@endsection

<!-- offer section -->
@section("contenido")
<section class="offer_section layout_padding-bottom">
  <div class="offer_container">
    <div class="container ">
      <div class="row">
        <div class="col-12 text-center">
          <h2>Promociones y combos</h2>
        </div>
        @foreach ($aPromos as $producto)
        <div class="col-md-6  ">
          <div class="box">
            <div class="img-box">
              <img src="files/{{ $producto->imagen }}" alt="" class="img-fluid">
            </div>
            <div class="detail-box">
              <div class="mt-3">
                <h5>{{ $producto->titulo }}</h5>
                <h6>$ {{ number_format($producto->precio, 0, ',', '.')  }}</h6>
              </div>
              <div class="mt-3">
                <p>{{ $producto->descripcion }}</p>
                <a href="/takeaway" class="btn">
                  <i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> ¡Pide ahora!
                </a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        @foreach ($aCombo as $producto)
        <div class="col-md-6  ">
          <div class="box ">
            <div class="img-box">
              <img src="files/{{ $producto->imagen }}" alt="">
            </div>
            <div class="detail-box">
              <div class="mt-3">
                <h5>{{ $producto->titulo }}</h5>
                <h6>$ {{ number_format($producto->precio, 0, ',', '.')  }}</h6>
              </div>
              <div class="mt-3">
                <p>{{ $producto->descripcion }}</p>
                <a href="/takeaway" class="btn">
                  <i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> ¡Pide ahora!
                </a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<!-- end offer section -->
@endsection