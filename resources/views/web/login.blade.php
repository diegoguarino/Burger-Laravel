@extends("web.plantilla")
@section("contenido")

<!-- book section -->
<section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Ingresar al sistema
        </h2>
      </div>
      @if(isset($msg))
      <div class="row">
        <div class="col-md-6">
          <div class="alert alert-{{ $msg['ESTADO'] }}" role="alert">
            {{ $msg['MSG'] }}
          </div>
        </div>
      </div>
      @endif
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form action="" method= "POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            <div>
                  <label for="">Correo</label>
                  <input type="text" class="form-control" placeholder="Ingresar correo" id="txtCorreo" name="txtCorreo"/>
            </div>
            <div>
                  <label for="">Contraseña</label>
                  <input type="password" class="form-control" placeholder="Ingresar clave" id="txtClave" name="txtClave"/>
            </div>
            <div>
              <button type="submit" name="btnIngresar">Ingresar</button>
            </div>
            </form>
            <div class="btn-box">
              <a href="/registrarse" class="btn1">
                    ¿No tenes cuenta? Registrar nuevo usuario
                      </a>
              </div>
            <div class="btn-box">
              <a href="/recuperar-clave" class="btn1">
                    ¿Olvidaste tu clave?
              </a>
            </div>
            </div>
      </div>
</section>             
  <!-- end book section -->

@endsection