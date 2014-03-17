<?php
class Cliente extends Doctrine_Record {

	function setTableDefinition() {
		$this->hasColumn('id');
		$this->hasColumn('rut');
		$this->hasColumn('nombre');
		$this->hasColumn('giro');
		$this->hasColumn('contacto_empresa');
		$this->hasColumn('contacto_email');
		$this->hasColumn('contacto_telefono');
	}

	function setUp() {
        parent::setUp();
    }

}