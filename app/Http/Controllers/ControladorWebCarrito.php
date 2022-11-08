<?php

namespace App\Http\Controllers;

use App\Entidades\Carrito;
use App\Entidades\Cliente;
use App\Entidades\Pedido;
use App\Entidades\Pedido_producto;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;
use MercadoPago\Item;
use MercadoPago\Payer;
use MercadoPago\Preference;
use MercadoPago\SDK;
use Session;

require app_path() . '/start/constants.php';

class ControladorWebCarrito extends Controller
{
    public function index()
    {
        $idCliente = Session::get("idCliente");
        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);
        $sucursal = new Sucursal;
        $aSucursales = $sucursal->obtenerTodos();

        return view("web.carrito", compact("aSucursales", "aCarritos"));
    }

    public function procesar(Request $request)
    {
        if (isset($_POST["btnBorrar"])) {
            return $this->eliminar($request);
        } else if (isset($_POST["btnActualizar"])) {
            return $this->actualizar($request);
        } else if (isset($_POST["btnFinalizar"])) {
            return $this->insertarPedido($request);
        }
    }

    public function actualizar(Request $request)
    {
        $cantidad = $request->input("txtCantidad");
        $idCarrito = $request->input("txtCarrito");
        $idProducto = $request->input("txtProducto");
        $idCliente = Session::get("idCliente");

        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);
        $sucursal = new Sucursal;
        $aSucursales = $sucursal->obtenerTodos();

        $carrito->idcarrito = $idCarrito;
        $carrito->cantidad = $cantidad;
        $carrito->fk_idcliente = $idCliente;
        $carrito->fk_idproducto = $idProducto;
        $carrito->guardar();
        $msg["err"] = EXIT_SUCCESS;
        $msg["mensaje"] = "Producto actualizado exitosamente.";

        return view('web.carrito', compact('msg', 'aSucursales', 'aCarritos'));
    }

    public function eliminar(Request $request)
    {
        $idCliente = Session::get("idCliente");
        $idCarrito = $request->input("txtCarrito");

        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);
        $sucursal = new Sucursal;
        $aSucursales = $sucursal->obtenerTodos();

        $carrito->idcarrito = $idCarrito;
        $carrito->eliminar();
        $msg["err"] = EXIT_SUCCESS;
        $msg["mensaje"] = "Producto eliminado exitosamente.";

        return view('web.carrito', compact('msg', 'aSucursales', 'aCarritos'));
    }

    public function insertarPedido(Request $request)
    {

        $idCliente = Session::get("idCliente");
        $idSucursal = $request->input("lstSucursal");
        $pago = $request->input("lstPago");

        if ($pago == "Mercadopago") {
            $this->procesarMercadopago($request);
        } else {

            $carrito = new Carrito();
            $aCarritos = $carrito->obtenerPorCliente($idCliente);

            $sucursal = new Sucursal;
            $aSucursales = $sucursal->obtenerTodos();

            $total = 0;
            foreach ($aCarritos as $item) {
                $total += $item->cantidad * $item->precio;
            }

            $fecha = date("Y-m-d");

            $pedido = new Pedido();
            $pedido->fk_idsucursal = $idSucursal;
            $pedido->fk_idcliente = $idCliente;
            $pedido->fk_idestadopedido = 1;
            $pedido->fecha = $fecha;
            $pedido->total = $total;
            $pedido->pago = $pago;
            $pedido->insertar();

            $pedidoProducto = new Pedido_producto();
            foreach ($aCarritos as $item) {
                $pedidoProducto->fk_idproducto = $item->fk_idproducto;
                $pedidoProducto->fk_idpedido = $pedido->idpedido;
                $pedidoProducto->cantidad = $item->cantidad;
                $pedidoProducto->insertar();
            }

            $carrito->eliminarPorCliente($idCliente);

            $msg["err"] = MSG_SUCCESS;
            $msg["mensaje"] = "El pedido se ha confirmado correctamente.";
            return view('web.carrito', compact('msg', 'aSucursales', 'aCarritos'));
        }
    }

    public function procesarMercadopago(Request $request)
    {
        $access_token = "";
        SDK::setClientId(config("payment-methods.mercadopago.client"));
        SDK::setClientSecret(config("payment-methods.mercadopago.secret"));
        SDK::setAccessToken($access_token); //Es el token de la cuenta de MP donde se deposita el dinero

        $idCliente = Session::get("idCliente");
        $cliente = new Cliente();
        $cliente->obtenerPorId($idCliente);
        $idSucursal = $request->input("lstSucursal");
        $pago = $request->input("lstPago");

        $carrito = new Carrito();
        $aCarritos = $carrito->obtenerPorCliente($idCliente);

        $sucursal = new Sucursal;
        $aSucursales = $sucursal->obtenerTodos();

        $total = 0;
        foreach ($aCarritos as $item) {
            $total += $item->cantidad * $item->precio;
        }
        $fecha = date("Y-m-d");

        //Armado del producto ‘item’
        $item = new Item();
        $item->id = "1234";
        $item->title = "Compra Web Burger SRL";
        $item->category_id = "products";
        $item->quantity = 1;
        $item->unit_price = $total;
        $item->currency_id = "ARS"; // "COP"

        $preference = new Preference();
        $preference->items = array($item);

        //Datos del comprador
        $payer = new Payer();
        $payer->name = $cliente->nombre;
        $payer->surname = "";
        $payer->email = $cliente->correo;
        $payer->date_created = date('Y-m-d H:m:s');
        $payer->identification = array(
            "type" => "DNI", //cc
            "number" => $cliente->dni,
        );
        $preference->payer = $payer;

        $pedido = new Pedido();
        $pedido->fk_idsucursal = $idSucursal;
        $pedido->fk_idcliente = $idCliente;
        $pedido->fk_idestadopedido = 5;
        $pedido->fecha = $fecha;
        $pedido->total = $total;
        $pedido->pago = $pago;
        $pedido->insertar();

        $pedidoProducto = new Pedido_producto();
        foreach ($aCarritos as $item) {
            $pedidoProducto->fk_idproducto = $item->fk_idproducto;
            $pedidoProducto->fk_idpedido = $pedido->idpedido;
            $pedidoProducto->cantidad = $item->cantidad;
            $pedidoProducto->insertar();
        }

        $carrito->eliminarPorCliente($idCliente);

        //URL de configuración para indicarle a MP
        $preference->back_urls = [
            "success" => "http://127.0.0.1:8000/mercado-pago/aprobado/" . $pedido->idpedido,
            "pending" => "http://127.0.0.1:8000/mercado-pago/pendiente/" . $pedido->idpedido,
            "failure" => "http://127.0.0.1:8000/mercado-pago/error/" . $pedido->idpedido,
        ];

        $preference->payment_methods = array("installments" => 6);
        $preference->auto_return = "all";
        $preference->notification_url = '';
        $preference->save(); //Ejecuta la transacción

    }
}
