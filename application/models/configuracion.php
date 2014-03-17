<?php

class Configuracion extends Doctrine_Record {
    

    public function setTableDefinition() {
        $this->hasColumn('id');
        $this->hasColumn('param');
        $this->hasColumn('valor');
    }
    
    

    public function setUp() {
        parent::setUp();
    }


    public function getValorConfig($search){
        $result = '';
        
        $query =   Doctrine_Query::create()
                ->select('c.valor')
                ->from('Configuracion c')
                ->where('c.param = ? AND c.valor != ""', $search)
                ->fetchOne();
        
        if ($query)
            $result = $query->valor;
        
        return $result;
        
          
    }
}

?>