<?php
class Producto extends Doctrine_Record {

	function setTableDefinition() {
		$this->hasColumn('id');
		$this->hasColumn('sku');
		$this->hasColumn('categoria_id');
		$this->hasColumn('nombre');
		$this->hasColumn('short_descripcion');
		$this->hasColumn('full_descripcion');
		$this->hasColumn('peso');
		$this->hasColumn('precio');
		$this->hasColumn('stock');
		$this->hasColumn('destacado');
		$this->hasColumn('imagen');
		$this->hasColumn('public');
	}

	function setUp() {
		parent::setUp();

        $this->actAs('Searchable', array(
                'fields' => array('nombre')
            )
        );

		$this->actAs('Timestampable');
		
		$this->hasOne('Categoria',array(
				'local'=>'categoria_id',
				'foreign'=>'id'
		));
		
		$this->hasMany('Tag as Tags',array(
            'local'=>'producto_id',
            'foreign'=>'tag_id',
            'refClass' => 'TagProducto'
		));


	}
	
	public function hasCategory($c){
	    return isset($this->categoria_id) && $this->categoria_id == $c->id;
	}
	
	public function getImagen(){
	    $item = $this->getData();
	    if(!empty($item['imagen']))
	        return $item['imagen'];
	    else 
	        return '/default.png';
	}


}