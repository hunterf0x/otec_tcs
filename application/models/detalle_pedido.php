<?php

class DetallePedido extends Doctrine_Record {

    function setTableDefinition() {
        $this->hasColumn('id');
        $this->hasColumn('pedido_id');
        $this->hasColumn('producto_id');
        $this->hasColumn('cantidad');
        $this->hasColumn('precio');
        
    }

    function setUp() {
        parent::setUp();
        
        $this->hasOne('Pedido',array(
                'local'=>'pedido_id',
                'foreign'=>'id'
        ));
        
        $this->hasOne('Producto',array(
                'local'=>'producto_id',
                'foreign' => 'id'
        ));
    }
    
    
    public function ActualizaStock(){
        
         $this->Producto->stock = $this->Producto->stock - $this->cantidad;
         
         $this->Producto->save();
         return true;
    }
   

}
