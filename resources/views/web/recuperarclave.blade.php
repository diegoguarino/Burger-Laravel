@extends("web.plantilla")
@section("contenido")
<!-- book section -->
<section class="book_section layout_padding">
  <div class="container">
    <div class="heading_container">
      <h2>¿Olvidaste la clave?</h2>
      <p>Ingresa la dirección de correo con la que te registraste y te enviaremos las instrucciones para cambiar la clave.</p>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form_container">
          <form action="" method="POST">
            <input type="hidden" class="form-control" name="_token" value="{{ csrf_token() }}"></input>
            @if(isset($mensaje))
            <div class="alert alert-secondary text-center" role="alert">
              {{ $mensaje }}
            </div>
        </div>
      </div>
      @else
      <div class="form-group">
        <div class="form-label-group">
          <input type="email" id="txtMail" name="txtMail" class="form-control" placeholder="Ingresar su correo electrónico" required="required" autofocus="autofocus">
        </div>
      </div>
      <button class="btn btn-primary btn-block" type="submit">Recuperar</button>
      @endif
      </form>
          </div>
  </div>
  </div>
  </body>
  </section>
  <!-- end book section -->
@endsection