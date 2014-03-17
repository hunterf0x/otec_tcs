<?php
class CategoriaTable extends Doctrine_Table {

	public function getCategoriasPadresId($id){
	    return Doctrine_Query::create()
	           ->from('Categoria c')
	           ->where('id = ?', $id)
	           ->execute();
	}
	
	public function getCategoriasPadresNull(){
	    return Doctrine_Query::create()
	    ->from('Categoria c')
	    ->where('parent_id is NULL')
	    ->execute();
	}
	
	public function getCategoriasProductos(){
	    return Doctrine_Query::create()
	    ->from('Categoria c')
	    ->where('c.estado = 1')
	    ->execute();
	}
	
	
}