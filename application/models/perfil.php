<?php
class Perfil extends Doctrine_Record {
    
    public function setTableDefinition() {
        $this->hasColumn('id');
        $this->hasColumn('nombre');
    }
    
    public function setUp() {
        $this->hasMany('Usuario', array(
                'local'=>'id',
                'foreign'=>'perfil_id'
        ));
    }
    
    
}

?>