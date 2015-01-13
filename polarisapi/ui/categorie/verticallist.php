<?php

namespace polarisapi\ui\categorie;

use polarisapi\ui\categorie\Categorie;
use polarisapi\data\attribut\Attribut;
use jin\lang\StringTools;

class VerticalList extends Categorie{
    
    public function build(){
        $content = parent::build();
        
        $inputContent = '';
        foreach($this->attributs AS $attribut){
            $inputContent .= '<div class="line">';
            $inputContent .= $attribut->renderForDisplay();
            $inputContent .= '</div>';
        }
        $inputContent .= '<div class="clear"></div>';
        $content = StringTools::replaceFirst($content, '%content%', $inputContent);
        
        return $content;
    }
}


