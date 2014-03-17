<?php
class Contactos extends Doctrine_Record {
    
    public function setTableDefinition() {
        $this->hasColumn('id');
        $this->hasColumn('email');
        $this->hasColumn('nombre');
        $this->hasColumn('mensaje');
    }
    
    public function setUp() {
        parent::setUp();

    }
    
    
}

?>