@extends("web.plantilla")
@section("contenido")
<section class="about_section layout_padding">
  <div class="container  ">

    <div class="row">
      <div class="col-md-6 ">
        <div class="img-box">
          <img src="web/images/about-img.png" alt="">
        </div>
      </div>
      <div class="col-md-6">
        <div class="detail-box">
          <div class="heading_container">
            <h2>
              Sobre Nosotros
            </h2>
          </div>
          <p>
            Somos una Cadena de Hamburguesas líder en el mercado, nuestro placer siempre será ofrecer el mejor servicio y satisfacer las necesidades de nuestros clientes.
          </p>
          <a href="">
            Leer Más
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- end about section -->
<!-- client section -->

<section class="client_section layout_padding-bottom">
  <div class="container">
    <div class="heading_container heading_center psudo_white_primary mb_45 mt-4">
      <h2>
        Qué dicen Nuestros Clientes
      </h2>
    </div>
    <div class="carousel-wrap row ">
      <div class="owl-carousel client_owl-carousel">
        <div class="item">
          <div class="box">
            <div class="detail-box">
              <p>
                En todo Buenos aires, no hay otro lugar mejor que este. Me gustan mucho!!! Son las mejores. 
              </p>
              <h6>
                Juliana Pérez
              </h6>
              <p>
                Buenos Aires, Argentina
              </p>
            </div>
            <div class="img-box">
              <img src="web/images/client1.jpg" alt="" class="box-img">
            </div>
          </div>
        </div>
        <div class="item">
          <div class="box">
            <div class="detail-box">
              <p>
                Viajaria desde china solo por las hamburguesas. Puedo comerlas a cualquier hora del día. 
              </p>
              <h6>
                Andrés Urdaneta
              </h6>
              <p>
                Buenos Aires, Argentina
              </p>
            </div>
            <div class="img-box">
              <img src="web/images/client2.jpg" alt="" class="box-img">
            </div>
          </div>
        </div>
        <div class="item">
          <div class="box">
            <div class="detail-box">
              <p>
                Las hamburguesas son muy buenas, la atención es increible. muy atentos.
              </p>
              <h6>
                Margarita Rosa de Frnacisco
              </h6>
              <p>
                Bógota, Colombia.
              </p>
            </div>
            <div class="img-box">
              <img src="web/images/client1.jpg" alt="" class="box-img">
            </div>
          </div>
        </div>
        <div class="item">
          <div class="box">
            <div class="detail-box">
              <p>
                Visite Buenos aires el mes pasado y me tope con este restaurante, sin lugar a dudas son las mejores hamburguesas
              </p>
              <h6>
                Brando Pérez
              </h6>
              <p>
                Maracaibo, Venezuela
              </p>
            </div>
            <div class="img-box">
              <img src="web/images/client2.jpg" alt="" class="box-img">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="client_section layout_padding-bottom">
  <div class="container">
    <div class="heading_container heading_center psudo_white_primary mb_45 mt-4">
      <h2>
        Trabajá Con Nosotros
      </h2>
    </div>
    <div class="form_container ">
      <form action="" method="POST" enctype="multipart/form-data">
      	<input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
        <div class="row">
          <div class="col-md-4 offset-4 my-2 ">
            <div class="my-2">
              <input type="text" class="form-control" placeholder="Nombre" id="txtNombre" name="txtNombre">
            </div>
            <div class="my-2">
              <input type="text" class="form-control" placeholder="Apellido" id="txtApellido" name="txtApellido">
            </div>
             <div class="my-2">
              <input type="text" class="form-control" placeholder="Correo" id="txtCorreo" name="txtCorreo">
            </div>
            <div class="my-2">
              <input type="text" class="form-control" placeholder="Whatsapp" id="txtWhatsapp" name="txtWhatsapp">
            </div>
            <div class="my-2">
				<label for="">Cargar CV</label>
				<input type="file" name="archivo" id="archivo" accept=".doc, .docx, .pdf">
				<small class="d-block">Archivos admitidos: .doc, .docx, .pdf</small>
			</div>
			<div class="my-2 text-center">
            	<button type="submit" class="my-2 btn" style="background-color: #ffbe33;">Enviar</button>
            </div>
          </div>
        </div>
      </form>
    </div>

  </div>
  </div>
  </div>
  </div>
</section>


<!-- end client section -->
@endsection