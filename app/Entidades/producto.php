<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    protected $table = 'productos';
    public $timestamps = false;

    protected $fillable = [ //Son los campos de la tabla clientes en la BBDD
        'idproducto', 'titulo', 'precio', 'cantidad', 'descripcion', 'imagen', 'fk_idtipoproducto'
    ];

    protected $hidden = [];

    public function obtenerTodos()
    {
        $sql = "SELECT DISTINCT
                    A.idproducto,
                    A.titulo,
                    A.precio,
                    A.cantidad,
                    A.descripcion,
                    A.imagen,
                    A.fk_idtipoproducto,
                    B.nombre AS categoria
                FROM productos A
                INNER JOIN tipo_productos B ON A.fk_idtipoproducto = B.idtipoproducto  
                WHERE 1=1
                ORDER BY titulo ASC";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }
    public function obtenerPorId($idProducto)
    {
        $sql = "SELECT
                    idproducto,
                    titulo,
                    precio,
                    cantidad,
                    descripcion,
                    imagen,
                    fk_idtipoproducto
                FROM productos WHERE idproducto = $idProducto";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idproducto = $lstRetorno[0]->idproducto;
            $this->titulo = $lstRetorno[0]->titulo;
            $this->precio = $lstRetorno[0]->precio;
            $this->cantidad = $lstRetorno[0]->cantidad;
            $this->descripcion = $lstRetorno[0]->descripcion;
            $this->imagen = $lstRetorno[0]->imagen;
            $this->fk_idtipoproducto = $lstRetorno[0]->fk_idtipoproducto;
            return $this;
        }
        return null;
    }

    public function cargarDesdeRequest($request)
    { //consulta de cargar imagen
        $this->idproducto = $request->input('id') != "0" ? $request->input('id') : $this->idproducto;
        $this->titulo = $request->input('txtNombre');
        $this->fk_idtipoproducto = $request->input('lstTipoProducto');
        $this->cantidad = $request->input('txtCantidad');
        $this->precio = $request->input('txtPrecio');
        $this->descripcion = $request->input('txtDescripcion');
    }

    public function obtenerPorTipo($idTipoProducto)
    {
        $sql = "SELECT
                    idproducto,
                    titulo,
                    precio,
                    cantidad,
                    descripcion,
                    imagen,
                    fk_idtipoproducto
                FROM productos WHERE fk_idtipoproducto = $idTipoProducto";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function guardar()
    {
        $sql = "UPDATE productos SET
                    titulo='$this->titulo',
                    precio=$this->precio,
                    cantidad=$this->cantidad,
                    descripcion='$this->descripcion',
                    imagen='$this->imagen',
                    fk_idtipoproducto=$this->fk_idtipoproducto
                WHERE idproducto=?";
        $affected = DB::update($sql, [$this->idproducto]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM productos WHERE idproducto=?";
        $affected = DB::delete($sql, [$this->idproducto]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO productos (
                    titulo,
                    precio,
                    cantidad,
                    descripcion,
                    imagen,
                    fk_idtipoproducto
                    )
                VALUES (?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->titulo,
            $this->precio,
            $this->cantidad,
            $this->descripcion,
            $this->imagen,
            $this->fk_idtipoproducto,
        ]);
        return $this->idproducto = DB::getPdo()->lastInsertId();
    }

    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.titulo',
            1 => 'A.precio',
            2 => 'A.cantidad',
            3 => 'B.nombre',
            4 => 'A.descripcion',
            5 => 'A.imagen'
        );
        $sql = "SELECT DISTINCT
                    A.idproducto,
                    A.titulo,
                    A.precio,
                    A.cantidad,
                    A.descripcion,
                    A.imagen,
                    A.fk_idtipoproducto,
                    B.nombre AS categoria
                FROM productos A
                INNER JOIN tipo_productos B ON A.fk_idtipoproducto = B.idtipoproducto  
                WHERE 1=1";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( titulo LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR precio LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR fk_idtipoproducto LIKE '%" . $request['search']['value'] . "%' )";
            $sql .= " OR descripcion LIKE '%" . $request['search']['value'] . "%' ";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    public function existeProductosPorCategoria($idTipoProducto)
    {
        $sql = "SELECT
                    idproducto,
                    titulo,
                    precio,
                    cantidad,
                    descripcion,
                    imagen,
                    fk_idtipoproducto
                FROM productos WHERE fk_idtipoproducto = $idTipoProducto";


        $lstRetorno = DB::select($sql);

        return (count($lstRetorno) > 0);
    }

    public function existePedidosPorProducto($idProducto)
    {
                        $sql = "SELECT
                        idpedidoproducto,
                        fk_idproducto,
                        fk_idpedido
            FROM pedido_productos WHERE fk_idproducto = $idProducto";


        $lstRetorno = DB::select($sql);

        return (count($lstRetorno) > 0);

    }
}
