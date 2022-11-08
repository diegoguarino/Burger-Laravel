<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Rubro;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Proveedor;

require app_path() . '/start/constants.php';


class ControladorRubro extends Controller
{

    public function nuevo()
    {
        $titulo = "Nuevo Rubro";             
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("RUBROALTA")) {
                $codigo = "RUBROALTA";
                $mensaje = "No tiene permisos para la operación.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $rubro = new Rubro();
                $rubro->obtenerTodos();               
             
                return view("sistema.rubro-nuevo", compact("titulo","rubro"));
            }
        } else {
            return redirect('admin/login');
        }
    } 

        public function index()
    {
        $titulo = "Listado de Rubros";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("RUBROCONSULTA")) {
                $codigo = "RUBROCONSULTA";
                $mensaje = "No tiene permisos para la operación.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view("sistema.rubro-listar", compact("titulo"));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function guardar(Request $request)
    {
        try {
            //Define la entidad servicio
            $titulo = "Modificar rubro";
            $entidad = new Rubro();
            $entidad->cargarDesdeRequest($request);

            //validaciones
            if ($entidad->nombre == "") {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Complete todos los datos";
            } else {
                if ($_POST["id"] > 0) {
                    //Es actualizacion
                    $entidad->guardar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                } else {
                    //Es nuevo
                    $entidad->insertar();

                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                }

                $_POST["id"] = $entidad->idrubro;
                return view('sistema.rubro-listar', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $entidad->idrubro;
        $rubro = new Rubro();
        $rubro->obtenerPorId($idrubro);

        return view('sistema.rubro-nuevo', compact('msg', 'cliente', 'titulo')) . '?id=' . $cliente->idrubro;
    }

    public function cargarGrilla(Request $request)
    {
        $request = $_REQUEST;

        $entidad = new Rubro();
        $aRubros = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        for ($i = $inicio; $i < count($aRubros) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = "<a href='/admin/rubro/" . $aRubros[$i]->idrubro . "'>" . $aRubros[$i]->nombre . "</a>";
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aRubros), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aRubros), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }

    public function editar($idrubro)
    {
       
    $titulo = "Modificar Rubro";
        if (Usuario::autenticado() == true) {
         if (!Patente::autorizarOperacion("RUBROMODIFICACION")) {
        $codigo = "RUBROMODIFICACION";
        $mensaje = "No tiene pemisos para la operación.";
        return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
    } else {
        $rubro = new Rubro();
        $rubro->obtenerPorId($idrubro);

        $entidad = new Rubro();
        $array_rubro = $entidad->obtenerPorId($id);

        $rubro_grupo = new RubroArea();
        $array_rubro_grupo = $rubro_grupo->obtenerPorId($id);

        return view("sistema.rubro-nuevo", compact("titulo", "rubro"));
    }
} else {
    return redirect('admin/login');
}
}

public function eliminar(Request $request){

    if (Usuario::autenticado() == true) {
    if (Patente::autorizarOperacion("RUBROELIMINAR")) {

        $resultado["err"] = EXIT_FAILURE;
        $resultado["mensaje"] = "No tiene permisos para la operación.";
    }else{
        $entidad = new Rubro();
        $entidad->cargarDesdeRequest($request);
        $entidad->eliminar();

        $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
        $resultado["mensaje"] = "Registro eliminado correctamente.";
    }
    }else{   
        $aResultado["err"] = "No tiene pemisos para la operación.";
    }
    echo json_encode($aResultado);
}
}