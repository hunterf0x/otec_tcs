<?php
class Curso extends Doctrine_Record {

    function setTableDefinition() {
        $this->hasColumn('id');
        $this->hasColumn('nombre');
        $this->hasColumn('codigo_sence');
        $this->hasColumn('horas_curso');
    }

    function setUp() {
        parent::setUp();

        $this->hasMany('Clase as Clases',array(
            'local'=>'codigo_sence',
            'foreign'=>'codigo_sence'
        ));
    }

}