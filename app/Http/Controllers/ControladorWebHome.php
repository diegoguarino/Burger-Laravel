<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;
use App\Entidades\Producto;

class ControladorWebHome extends Controller
{
    public function index()
    {        
        $sucursal = new Sucursal;
        $aSucursales = $sucursal->obtenerTodos();

        $idPromocion = 2;
        $productoPromo = new Producto;
        $aPromos = $productoPromo->obtenerPorTipo($idPromocion);

        $idCombos = 3;
        $productoCombo = new Producto;
        $aCombo = $productoPromo->obtenerPorTipo($idCombos);

        return view("web.index", compact("aSucursales", "aPromos", "aCombo"));
    }

}
