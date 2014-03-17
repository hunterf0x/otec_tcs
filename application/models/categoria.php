<?php
class Categoria extends Doctrine_Record {

	function setTableDefinition() {
		$this->hasColumn('id');
		$this->hasColumn('nombre');
		$this->hasColumn('descripcion');
		$this->hasColumn('public');
		$this->hasColumn('estado');
		$this->hasColumn('parent_id');
	}

	function setUp() {
		parent::setUp();

		$this->hasMany('Producto as Productos',array(
				'local'=>'id',
				'foreign'=>'categoria_id'
		));
		$this->hasMany('Categoria as SubCategorias',array(
		        'local'=>'id',
		        'foreign'=>'parent_id'
		));
		$this->hasOne('Categoria as ParentCategoria',array(
		        'local'=>'parent_id',
		        'foreign'=>'id'
		));
	}
	
	public function getSubCategoriasPublicadas(){
	    return Doctrine_Query::create()
	    ->from('Categoria c')
	    ->where('c.parent_id = ? AND c.public=1',$this->id)
	    ->execute();
	}
	
	public function getSubcategoriasHijas(){
	    return Doctrine_Query::create()
	    ->from('Categoria c')
	    ->where('c.parent_id = ?',$this->parent_id)
	    ->execute();
	}
	
	public function getParentCategoria(){
	    return Doctrine_Query::create()
	    ->from('Categoria c')
	    ->where('c.id = ? AND c.public = 1',$this->parent_id)
	    ->fetchOne();
	}
	
	/* public function getProductos(){
	    return Doctrine_Query::create()
	        ->from('Producto')
	        ->where($where)
	} */
	
	public function getContent(){
    	$result = false;
    	

    	if ($this->SubCategorias->count()) {
    	    
            foreach ($this->SubCategorias as $s) {
                $sub_categoria = $s->getContent();
                if($sub_categoria){
                    $result = clone $this;
                    $result->SubCategorias[] = $sub_categoria;
                    
                }
                    
            }
        }else{
            if($this->Productos->count())
                $result = clone $this;
        }
    	       
        return $result;
    }
    
    public function getGranPadre(){
        $result = false;
        if($padre = $this->getParentCategoria()){
            $sub = $padre->getGranPadre(); 
            $result = clone $sub;
        }else{
            $sub = clone $this;
            $result = $sub;
        }
        
        return $result;
    }
    
   public function getTreeCategoria(){
        
        $tree = new Doctrine_Collection('Categoria');
        $tree[] = clone $this;
        if($this->ParentCategoria){
            $padre = $this->ParentCategoria;
            
            $tree[] = $padre;
            if($r = $padre->ParentCategoria){
                $tree[] = $r;
            }
               
            
        }else{
            
            $tree[] = clone $this;
            
        }
        
        return $tree;
       
     
   }
   public function getCuenta(){
       $result =0;
       foreach ($this->getSubCategoriasPublicadas() as $sub){
           if($sub->getContent()){
               $result++;
           }
       }
       return $result;
   }
   
}