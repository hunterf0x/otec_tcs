<?php
class ClaseHorario extends Doctrine_Record {

    function setTableDefinition() {
        $this->hasColumn('id');
        $this->hasColumn('clase_id');
        $this->hasColumn('dia');
        $this->hasColumn('hora_inicio');
        $this->hasColumn('cantidad_horas');
    }

    function setUp() {
        parent::setUp();
        $this->hasOne('Clase',array(
            'local'=>'clase_id',
            'foreign'=>'id'
        ));

    }

}