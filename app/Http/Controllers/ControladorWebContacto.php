<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use App\Entidades\Cliente;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require app_path() . '/start/constants.php';

class ControladorWebContacto extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal;
        $aSucursales = $sucursal->obtenerTodos();

        return view("web.contacto", compact('aSucursales'));
    }
    

    public function enviar(Request $request)
    {
        $titulo = 'Contacto';
        $nombre = $request->input('txtNombre');
        $telefono = $request->input('txtTelefono');
        $correo = $request->input('txtCorreo');
        $comentario = $request->input('txtComentario');

        $sucursal = new Sucursal;
        $aSucursales = $sucursal->obtenerTodos();

        
        if ($nombre != "" && $telefono != "" && $correo != "" && $comentario != "") {
            //Envia  mail con las instrucciones

            $data = "Instrucciones";

            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
            try {
                //Server settings
                $mail->SMTPDebug = 0;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = env('MAIL_HOST');  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = env('MAIL_USERNAME');                 // SMTP username
                $mail->Password = env('MAIL_PASSWORD');                           // SMTP password
                $mail->SMTPSecure = env('MAIL_ENCRYPTION');                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = env('MAIL_PORT');                                    // TCP port to connect to

                //Recipients
                $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->addAddress($correo);               // Name is optional
                $mail->addReplyTo('no-reply@fmed.uba.ar');

                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Gracias por contactarte';
                $mail->Body = "Los datos del formulario son: 
                    Nombre: $nombre<br>
                    Teléfono: $telefono<br>
                    Correo: $correo<br>
                    Comentario: $comentario<br>
                ";

                 //$mail->send();
        
                return view('web.contacto-gracias', compact('aSucursales'));
            } catch (Exception $e) {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] =  "Hubo un error al enviar el correo.";
                return view('web.contacto', compact('aSucursales', 'msg'));
            }
        } else {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = "Complete todos los datos";
            return view('web.contacto', compact('aSucursales', 'msg'));
        }
    }

}

