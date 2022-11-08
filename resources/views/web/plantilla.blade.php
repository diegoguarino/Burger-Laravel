<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="Deliciosas hamburguesas y guarniciones que puedes comprar sin salir de casa. ¡Descubre nuestras promociones y deléitate con nuestros sabores! ¡Pide ahora!" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="#" type="">

  <title> Burgers SRL </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="web/css/bootstrap.css" />

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <!-- font awesome style -->
  <link href="web/css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="web/css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="web/css/responsive.css" rel="stylesheet" />

</head>

<body class="sub_page">

  <div class="hero_area">
    <div class="bg-box">
      <img src="web/images/hero-bg.jpg" alt="">
    </div>
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="\">
            <span>
              Burgers SRL
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  mx-auto ">
              <li class="nav-item <?php echo (Request::path() == "/")? "active" : ""; ?>">
                <a class="nav-link" href="/">Inicio <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item <?php echo (Request::path() == "takeaway")? "active" : ""; ?>">
                <a class="nav-link" href="/takeaway">Takeaway</a>
              </li>
              <li class="nav-item <?php echo (Request::path() == "nosotros")? "active" : ""; ?>">
                <a class="nav-link" href="/nosotros">Nosotros</a>
              </li>
              <li class="nav-item <?php echo (Request::path() == "contacto")? "active" : ""; ?>">
                <a class="nav-link" href="/contacto">Contacto</a>
              </li>
            </ul>
            <div class="user_option">
              <a class="user_link" href="/mi-cuenta">
                <i class="fa fa-user fa-lg" aria-hidden="true"></i>
              </a>
              <a class="user_link" href="/carrito">
               <i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i>
              </a>
              @if(Session::get("idCliente") && Session::get("idCliente") > 0)
              <a href="/logout" class="order_online">
                Cerrar sesión
              </a>
              @else
              <a href="/login" class="order_online">
                Ingresar
              </a>
              @endif
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
    @yield("banner")
  </div>


  @yield("contenido")



  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <div class="row">
        <div class="col-md-4 footer-col px-4">
          <div class="footer_contact">
            <h4>
              Sucursales
            </h4>
            <div class="contact_link_box">
              <div id="carruselSucursal" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                  @foreach ($aSucursales as $sucursal)

                  @if ($sucursal == $aSucursales[0])
                  <div class="carousel-item active">
                    <i class="fa fa-building" aria-hidden="true"></i> {{ $sucursal->nombre }}<br />
                    <i class="fa fa-map-marker" aria-hidden="true"></i> {{ $sucursal->direccion }}<br />
                    <i class="fa fa-phone" aria-hidden="true"></i> {{ $sucursal->telefono }}<br />
                    <a href="{{ $sucursal->linkmapa }}"><i class="fa fa-map" aria-hidden="true"></i> Ver ubicación en Google Maps</a>
                  </div>
                  @else
                  <div class="carousel-item">
                    <i class="fa fa-building" aria-hidden="true"></i> {{ $sucursal->nombre }}<br />
                    <i class="fa fa-map-marker" aria-hidden="true"></i> {{ $sucursal->direccion }}<br />
                    <i class="fa fa-phone" aria-hidden="true"></i> {{ $sucursal->telefono }}<br />
                    <i class="fa fa-map" aria-hidden="true"></i><a href="{{ $sucursal->linkmapa }}"> Ver ubicación en Google Maps</a>
                  </div>

                  @endif
                  @endforeach
                </div>

                <a class="carousel-control-prev" href="#carruselSucursal" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carruselSucursal" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>

              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <div class="footer_detail">
            <a href="" class="footer-logo">
              Burgers SRL
            </a>
            <p>
              ¡Síguenos en nuestras redes sociales!
            </p>
            <div class="footer_social">
              <a href="">
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col px-4">
          <h4>
            Nuestros horarios
          </h4>
            Lunes a domingo<br/><br/>
          <div id="carruselHorario" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              @foreach ($aSucursales as $sucursal)

              @if ($sucursal == $aSucursales[0])
              <div class="carousel-item active">
                <i class="fa fa-clock-o" aria-hidden="true"></i> {{ $sucursal->nombre }}: {{ $sucursal->horario }}
              </div>
              @else
              <div class="carousel-item">
                <i class="fa fa-clock-o" aria-hidden="true"></i> {{ $sucursal->nombre }}: {{ $sucursal->horario }}
              </div>

              @endif
              @endforeach
            </div>

            <a class="carousel-control-prev" href="#carruselHorario" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carruselHorario" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>

          </div>
        </div>
      </div>
      <div class="footer-info">
        <p>
          &copy; <span id="displayYear"></span> Burguers SRL<br><br>
          Adaptación de plantilla de <a href="https://html.design/">Free Html Templates</a>
          <span id="displayYear"></span> /
          <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
        </p>
      </div>
    </div>
  </footer>
  <!-- footer section -->

  <!-- jQery -->
  <script src="web/js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script src="web/js/bootstrap.js"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- isotope js -->
  <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
  <!-- nice select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
  <!-- custom js -->
  <script src="web/js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
  </script>
  <!-- End Google Map -->

</body>

</html>