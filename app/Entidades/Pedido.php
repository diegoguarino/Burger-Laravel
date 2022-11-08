<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{

    protected $table = 'pedidos';
    public $timestamps = false;

    protected $fillable = [ //Son los campos de la tabla clientes en la BBDD
        'idpedido', 'fk_idcliente', 'fk_idsucursal', 'fk_idestadopedido', 'fecha', 'total', 'pago'
    ];

    protected $hidden = [];

    public function cargarDesdeRequest($request)
    {
        $this->idpedido = $request->input('id') != "0" ? $request->input('id') : $this->idpedido;
        $this->fk_idcliente = $request->input('lstCliente');
        $this->fk_idsucursal = $request->input('lstSucursal');
        $this->fk_idestadopedido = $request->input('lstEstadoPedido');
        $this->fecha = $request->input('txtFecha');
        $this->total = $request->input('txtTotal');
        $this->pago = $request->input('lstPago');
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                        idpedido,
                        fk_idcliente,
                        fk_idsucursal,
                        fk_idestadopedido,
                        fecha,
                        total,
                        pago
                FROM pedidos ORDER BY fecha DESC";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idPedido)
    {
        $sql = "SELECT
                        idpedido,
                        fk_idcliente,
                        fk_idsucursal,
                        fk_idestadopedido,
                        fecha,
                        total,
                        pago
                FROM pedidos WHERE idpedido = $idPedido";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idpedido = $lstRetorno[0]->idpedido;
            $this->fk_idcliente = $lstRetorno[0]->fk_idcliente;
            $this->fk_idsucursal = $lstRetorno[0]->fk_idsucursal;
            $this->fk_idestadopedido = $lstRetorno[0]->fk_idestadopedido;
            $this->fecha = $lstRetorno[0]->fecha;
            $this->total = $lstRetorno[0]->total;
            $this->pago = $lstRetorno[0]->pago;
            return $this;
        }
        return null;
    }

    public function guardar()
    {
        $sql = "UPDATE pedidos SET
                        fk_idcliente=$this->fk_idcliente,
                        fk_idsucursal=$this->fk_idsucursal,
                        fk_idestadopedido=$this->fk_idestadopedido,
                        fecha='$this->fecha',
                        total=$this->total,
                        pago='$this->pago'
                  WHERE idpedido=?";
        $affected = DB::update($sql, [$this->idpedido]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM pedidos WHERE idpedido=?";
        $affected = DB::delete($sql, [$this->idpedido]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO pedidos (
				fk_idcliente,
				fk_idsucursal,
				fk_idestadopedido,
				fecha,
				total,
                pago
            ) VALUES (?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->fk_idcliente,
            $this->fk_idsucursal,
            $this->fk_idestadopedido,
            $this->fecha,
            $this->total,
            $this->pago
        ]);
        return $this->idpedido = DB::getPdo()->lastInsertId();
    }

    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'fecha',
            1 => 'fk_idsucursal',
            2 => 'fk_idcliente',
            3 => 'fk_idestadopedido',
            4 => 'total',
            5 => 'pago',
        );
        $sql = "SELECT DISTINCT
                            A.idpedido,
                            A.fecha,
                            A.fk_idsucursal ,
                            A.fk_idcliente,
                            A.fk_idestadopedido,
                            A.total,
                            A.pago,
                            B.nombre AS sucursal,
                            C.nombre AS cliente,
                            D.nombre AS estado_del_pedido
                        FROM pedidos A
                        INNER JOIN sucursales B ON A.fk_idsucursal = B.idsucursal
                        INNER JOIN clientes C ON A.fk_idcliente = C.idcliente
                        INNER JOIN estado_pedidos D ON A.fk_idestadopedido = D.idestadopedido
                        WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " OR fecha LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR fk_idsucursal LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR fk_idcliente LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR fk_idestadopedido LIKE '%" . $request['search']['value'] . "%' )";
            $sql .= " OR total LIKE '%" . $request['search']['value'] . "%' )";
            $sql .= " OR pago LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    public function existePedidosPorCliente($idCliente)
    {
        $sql = "SELECT
                        idpedido,
                        fk_idcliente,
                        fk_idsucursal,
                        fk_idestadopedido,
                        fecha,
                        total,
                        pago
                FROM pedidos WHERE fk_idcliente = '$idCliente'";

        $lstRetorno = DB::select($sql);

        return (count($lstRetorno) > 0);
    }
    public function obtenerPedidosPorCliente($idCliente)
    {
        $sql = "SELECT 
                    A.idpedido,
                    A.fecha,
                    A.fk_idsucursal ,
                    A.fk_idcliente,
                    A.fk_idestadopedido,
                    A.total,
                    A.pago,
                    B.nombre AS sucursal,                            
                    C.nombre AS estado_del_pedido
                FROM pedidos A
                INNER JOIN sucursales B ON A.fk_idsucursal = B.idsucursal                        
                INNER JOIN estado_pedidos C ON A.fk_idestadopedido = C.idestadopedido
                WHERE fk_idcliente = '$idCliente' AND A.fk_idestadopedido <> 3";

        $lstRetorno = DB::select($sql);

        return ($lstRetorno);
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

    public function existePedidosPorSucursal($idSucursal)
    {
        $sql = "SELECT
                        idpedido,
                        fk_idcliente,
                        fk_idsucursal,
                        fk_idestadopedido,
                        fecha,
                        total,
                        pago
                FROM pedidos WHERE fk_idsucursal = $idSucursal";

        $lstRetorno = DB::select($sql);

        return (count($lstRetorno) > 0);
    }
}
