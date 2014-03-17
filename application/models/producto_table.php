<?php
class ProductoTable extends Doctrine_Table {

	public function getProductosDestacados(){
	    return Doctrine_Query::create()
	    ->from('Producto p')
	    ->where('p.destacado = 1')
        ->orderBy('id DESC')
	    ->limit(12)
	    ->execute();
	}
	
	public function getUltimosProductos(){
	    return Doctrine_Query::create()
	    ->from('Producto p')
	    ->orderBy('p.created_at Desc')
	    ->limit(6)
	    ->execute();
	}

    public function getProductosDisponibles(){
        return Doctrine_Query::create()
            ->from('Producto p,p.Categoria c')
            ->where('p.public = 1 AND c.estado=1 AND c.public=1')
            ->execute();
    }
	
	
}