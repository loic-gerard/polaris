<?php

namespace polarisapi\data\attribut;

class Attribut{
    protected $entiteId;
    protected $attributName;
    protected $value;
    
    public function __construct($entiteId, $attributName, $value) {
        $this->entiteId = $entiteId;
        $this->attributName = $attributName;
	$this->value = $value;
    }
    
    public function getFinalValue(){
        return $this->value;
    }
    
    public function getInitialValue(){
        return $this->value;
    }
}