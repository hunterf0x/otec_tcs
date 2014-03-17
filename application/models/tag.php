<?php

class Tag extends Doctrine_Record {

    public function setTableDefinition() {
        $this->hasColumn('id');
        $this->hasColumn('etiqueta');
        $this->hasColumn('categoria', 'enum', null,
            array('values' => array('Marca', 'Descripcion', 'Producto'))
        );
    }

    public function setUp() {
        parent::setUp();

        $this->hasMany('Producto as Productos', array(
            'local'=>'tag_id',
            'foreign'=>'producto_id',
            'refClass' => 'TagProducto'
        ));
    }


}

?>