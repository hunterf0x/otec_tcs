<?php
class TagProducto extends Doctrine_Record {

    public function setTableDefinition()
    {
        $this->hasColumn('tag_id', 'integer', 4, array(
            'primary' => true,
            "autoincrement" => false
        ));
        $this->hasColumn('producto_id', 'integer', 4, array(
            'primary' => true,
            "autoincrement" => false
        ));
    }
    

    
    
}

?>