<?php
class DetallePedidoTable extends Doctrine_Table {

	public function getProductosMasVendidos(){
	    $query =   Doctrine_Query::create()
	               ->select('sum(d.cantidad) as suma, d.producto_id')
	               ->from('DetallePedido d, d.Pedido p')
	               ->where('p.estado = 1')
	               ->groupBy('d.producto_id')
	               ->orderBy('suma DESC')
	               ->having('suma > 5');
	               
	     return $query->execute();
	    
	    
	               
	}
	
	
	
	
}