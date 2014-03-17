<?php

class Captcha extends Doctrine_Record {

    function setTableDefinition() {
        $this->hasColumn('id');
        $this->hasColumn('captcha_time');
        $this->hasColumn('ip_address');
        $this->hasColumn('word');
    }

    function setUp() {
        parent::setUp();
    }
    
   

}
