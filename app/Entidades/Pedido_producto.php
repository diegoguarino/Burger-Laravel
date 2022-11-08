<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Pedido_producto extends Model
{

    protected $table = 'pedido_productos';
    public $timestamps = false;

    protected $fillable = [ //Son los campos de la tabla pedido_productos en la BBDD
        'idpedidoproducto', 'fk_idproducto', 'fk_idpedido', 'cantidad'
    ];

    protected $hidden = [

    ];

	 public function obtenerTodos() {
        $sql = "SELECT
                  	idpedidoproducto,
                    fk_idproducto,
                    fk_idpedido,
                    cantidad
                FROM pedido_productos ORDER BY idpedidoproducto ASC";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

	public function obtenerPorPedido($idPedido) {
        $sql = "SELECT
                  	A.idpedidoproducto,
                    A.fk_idproducto,
                    A.fk_idpedido,
                    A.cantidad,
                    B.titulo,
                    B.imagen
                FROM pedido_productos A
                INNER JOIN productos B ON A.fk_idproducto = B.idproducto
                WHERE A.fk_idpedido = $idPedido
                ORDER BY idpedidoproducto ASC";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

	 public function obtenerPorId($idpedidoproducto)
    {
        $sql = "SELECT
                idpedidoproducto,
				fk_idproducto,
				fk_idpedido,
                cantidad	
                FROM pedido_productos WHERE idpedidoproducto = $idpedidoproducto";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idpedidoproducto = $lstRetorno[0]->idpedidoproducto;
            $this->fk_idproducto = $lstRetorno[0]->fk_idproducto;
            $this->fk_idpedido = $lstRetorno[0]->fk_idpedido;
            $this->cantidad = $lstRetorno[0]->cantidad;
      
            return $this;
        }
        return null;
    }

	public function guardar() {
        $sql = "UPDATE pedido_productos SET
            fk_idproducto= $this->fk_idproducto,
            fk_idpedido= $this->fk_idpedido,
            cantidad= $this->cantidad
            
            WHERE idpedidoproducto=?";
        $affected = DB::update($sql, [$this->idpedidoproducto]);
    }

	public function eliminar()
    {
        $sql = "DELETE FROM pedido_productos WHERE
            idpedidoproducto=?";
        $affected = DB::delete($sql, [$this->idpedidoproducto]);
    }

	public function insertar()
    {
        $sql = "INSERT INTO pedido_productos (
				fk_idproducto,
				fk_idpedido,
                cantidad
				
            ) VALUES (?, ?, ?);";
        $result = DB::insert($sql, [
            $this->fk_idproducto,
            $this->fk_idpedido,
            $this->cantidad
            
        ]);
        return $this->idpedidoproducto = DB::getPdo()->lastInsertId();
    }

}