<?php

namespace polarisapi\data\attribut;

use polarisapi\data\attribut\Attribut;
use jin\dataformat\Json;

class ComplexeAttribut extends Attribut{
    
    public function getValue($key = null){
        return $this->value[$key];
    }
    
    
}

