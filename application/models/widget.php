<?php
class Widget extends Doctrine_Record {
    
    public function setTableDefinition() {
        $this->hasColumn('id');
        $this->hasColumn('producto_id');
        $this->hasColumn('habilitado');
        $this->hasColumn('sidebar');
        $this->hasColumn('slideshow');
        $this->hasColumn('imagen');
        $this->hasColumn('descripcion');
    }
    
    public function setUp() {
        $this->hasOne('Producto', array(
                'local'=>'producto_id',
                'foreign'=>'id'
        ));
    }
    
    
}

?>