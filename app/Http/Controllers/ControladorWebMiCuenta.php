<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Cliente;
use App\Entidades\Pedido;
use App\Entidades\Sucursal;
use Session;

class ControladorWebMiCuenta extends Controller
{
    public function index()
    {
        $idCliente = Session::get("idCliente");
        if($idCliente != ""){
        $cliente = new Cliente();
        $cliente->obtenerPorId($idCliente);
        
        
        $sucursal = new Sucursal;
        $aSucursales = $sucursal->obtenerTodos();

        $pedido = new Pedido();
        $aPedidos = $pedido->obtenerPedidosPorCliente($idCliente);

        return view("web.mi-cuenta", compact("cliente", "aSucursales", "aPedidos"));
        } else {
            return redirect("/login");
        }
    }

    public function guardar(Request $request){
        $cliente = new Cliente();
        $idCliente = Session::get("idCliente");
        $cliente->idcliente = $idCliente;
        $cliente->nombre= $request->input("txtNombre");
        $cliente->telefono= $request->input("txtTelefono");
        $cliente->correo= $request->input("txtCorreo");
        $cliente->dni= $request->input("txtDni");
        $cliente->direccion= $request->input("txtDireccion");
        $cliente->guardar();
        
        $sucursal = new Sucursal;
        $aSucursales = $sucursal->obtenerTodos();

        $pedido = new Pedido();
        $aPedidos = $pedido->obtenerPedidosPorCliente($idCliente);

        return view("web.mi-cuenta", compact("cliente","aSucursales", "aPedidos"));
        
    }   
}


    
    

     

        

    

