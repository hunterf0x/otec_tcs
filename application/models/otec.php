<?php
class Otec extends Doctrine_Record {

	function setTableDefinition() {
		$this->hasColumn('id');
		$this->hasColumn('rut');
		$this->hasColumn('nombre');
		$this->hasColumn('giro');
		$this->hasColumn('direccion');
		$this->hasColumn('telefono');
	}

	function setUp() {
        parent::setUp();
    }

}