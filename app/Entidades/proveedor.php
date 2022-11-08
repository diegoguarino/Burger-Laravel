<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{

    protected $table = 'proveedores';
    public $timestamps = false;

    protected $fillable = [ //Son los campos de la tabla clientes en la BBDD
        'idproveedor', 'nombre', 'domicilio', 'cuit', 'fk_idrubro'
    ];

    protected $hidden = [];

    public function obtenerTodos()
    {
        $sql = "SELECT
                  	idproveedor,
                    nombre,
                    domicilio,
                    cuit,
                    fk_idrubro
                FROM proveedores ORDER BY nombre ASC";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }
    public function obtenerPorId($idProveedores)
    {
        $sql = "SELECT
                idproveedor,
                nombre,
                domicilio,
                cuit,
                fk_idrubro
                FROM proveedores WHERE idproveedor = $idProveedores";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idproveedor = $lstRetorno[0]->idproveedor;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->domicilio = $lstRetorno[0]->domicilio;
            $this->cuit = $lstRetorno[0]->cuit;
            $this->fk_idrubro = $lstRetorno[0]->fk_idrubro;
            return $this;
        }
        return null;
    }

    public function cargarDesdeRequest($request)
    {
        $this->idproveedor = $request->input('id') != "0" ? $request->input('id') : $this->idproveedor;
        $this->nombre = $request->input('txtNombre');
        $this->domicilio = $request->input('txtDomicilio');
        $this->cuit = $request->input('txtCuit');
        $this->fk_idrubro = $request->input('lstRubro');
    }

    public function obtenerPorTipo($idRubro)
    {
        $sql = "SELECT
                idproveedor,
                nombre,
                domicilio,
                cuit,
                fk_idrubro
                FROM proveedores WHERE fk_idrubro = $idRubro";
        $lstRetorno = DB::select($sql);
    }

    public function guardar()
    {
        $sql = "UPDATE proveedores SET
            nombre='$this->nombre',
            domicilio=$this->domicilio,
            cuit=$this->cuit,
            fk_idrubro=$this->fk_idrubro
            WHERE idproveedor=?";
        $affected = DB::update($sql, [$this->idrubro]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM proveedores WHERE idproveedor=?";
        $affected = DB::delete($sql, [$this->idproveedor]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO proveedores (
				nombre,
				domicilio,
				cuit,
				fk_idrubro
            ) VALUES (?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->domicilio,
            $this->cuit,
            $this->fk_idrubro,
        ]);
        return $this->idproveedor = DB::getPdo()->lastInsertId();
    }

    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'nombre',
            1 => 'domicilio',
            2 => 'cuit',

        );
        $sql = "SELECT DISTINCT
                    idproveedor,
                    nombre,
                    domicilio,
                    cuit,  
                    fk_idrubro
                    FROM proveedores
                        WHERE 1=1
                ";
        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR domicilio LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR cuit LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR fk_idrubro LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    public function existeProveedoresPorRubro($idRubro)
    {
        $sql = "SELECT
                        idproveedor,
                        nombre,
                        domicilio,
                        cuit,
                        fk_idrubro                        
                FROM proveedores WHERE fk_idrubro = $idRubro";
        $lstRetorno = DB::select($sql);

        return (count($lstRetorno) > 0);
    }
}
