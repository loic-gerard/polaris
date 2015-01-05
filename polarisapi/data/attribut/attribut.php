<?php

namespace polarisapi\data\attribut;

class Attribut{
    private $entiteId;
    private $attributName;
    
    public function __construct($entiteId, $attributName) {
        $this->entiteId = $entiteId;
        $this->attributName = $attributName;
    }
    
    public function getFinalValue(){
        return 'OUI';
    }
    
    public function getInitialValue(){
        
    }
}