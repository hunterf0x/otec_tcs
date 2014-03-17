<?php

class Usuario extends Doctrine_Record {

    function setTableDefinition() {
        $this->hasColumn('id');
        $this->hasColumn('usuario');
        $this->hasColumn('password');
        $this->hasColumn('nombre');
        $this->hasColumn('apellido');
        $this->hasColumn('sexo');
        $this->hasColumn('region_codigo');
        $this->hasColumn('region_nombre');
        $this->hasColumn('comuna_codigo');
        $this->hasColumn('comuna_nombre');
        $this->hasColumn('direccion');
        $this->hasColumn('fono');
        $this->hasColumn('avatar');
        $this->hasColumn('salt');
        $this->hasColumn('perfil_id');
        $this->hasColumn('activo');
        $this->hasColumn('hash_newpassword');
        $this->hasColumn('hash_time');
        
    }

    function setUp() {
        parent::setUp();
        
        $this->actAs('Timestampable');
        
        $this->hasOne('Perfil',array(
            'local'=>'perfil_id',
            'foreign'=>'id'
        ));
        $this->hasMany('Pedido as Pedidos', array(
            'local'=>'id',
            'foreign'=>'usuario_id'
        ));
        
    }
    
    public function hasPerfil($cod){
        return $this->Perfil->id == $cod;
    }
    
    function setPassword($password,$salt=null) {        
        $hashPassword = sha1($password.$this->salt);
        $this->_set('password', $hashPassword);
    }
    
    function setPasswordWithSalt($password,$salt=null){
        if($salt!==null)
            $this->salt=$salt;
        else
            $this->salt=random_string ('alnum', 32);
        
        $this->setPassword($password);
    }
    
    public function isAdmin(){
        $respuesta = false;
        $perfil = $this->Perfil;
        switch ($perfil->id){
            case 1:
                $respuesta = true;
                break;
            case 2:
                $respuesta = true;
                break;
            case 3:
                $respuesta = false;
                break;
            default:
        }
        
        return $respuesta;
    }
    
    public function isActive(){
        $respuesta = false;
        if($this->activo)
            $respuesta = true;
        
        return $respuesta;
    }
    
           
}
