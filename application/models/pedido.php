<?php

class Pedido extends Doctrine_Record {

    function setTableDefinition() {
        $this->hasColumn('id');
        $this->hasColumn('usuario_id');
        $this->hasColumn('direccion_destino');
        $this->hasColumn('comuna_destino');
        $this->hasColumn('fono_destino');
        $this->hasColumn('estado');
        
    }

    function setUp() {
        parent::setUp();
        $this->actAs('Timestampable');
        
        $this->hasMany('DetallePedido',array(
                'local'=>'id',
                'foreign'=>'pedido_id'
        ));
        
        $this->hasOne('Usuario',array(
                'local'=>'usuario_id',
                'foreign'=>'id'
        ));
    }
    
    function ActualizaStock(){
        foreach ($this->DetallePedido as $d){
             $d->ActualizaStock();
        }
        return true;
    }
    
   

}
