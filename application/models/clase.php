<?php
class Clase extends Doctrine_Record {

    function setTableDefinition() {
        $this->hasColumn('id');
        $this->hasColumn('codigo_sence');
        $this->hasColumn('fecha_inicio');
        $this->hasColumn('fecha_termino');
        $this->hasColumn('horas_aprox');
        $this->hasColumn('dias');
        $this->hasColumn('observaciones');
    }

    function setUp() {
        parent::setUp();

        $this->hasOne('Curso',array(
            'local'=>'codigo_sence',
            'foreign'=>'codigo_sence'
        ));
        $this->hasOne('ClaseHorario',array(
            'local'=>'id',
            'foreign'=>'clase_id'
        ));
    }

}