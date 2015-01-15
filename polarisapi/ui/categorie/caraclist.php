<?php

namespace polarisapi\ui\categorie;

use polarisapi\ui\categorie\Categorie;
use polarisapi\data\attribut\Attribut;
use jin\lang\StringTools;

class CaracList extends Categorie{
    public function build(){
        $content = parent::build();
        
        $inputContent = '';
        $inputContent .= '<table>';
        $inputContent .= '<tr class="header">';
        $inputContent .= '<td>Caractéristique</td>';
        $inputContent .= '<td>Initial</td>';
        $inputContent .= '<td>Max</td>';
        $inputContent .= '<td>Modificateur</td>';
        $inputContent .= '<td>Total</td>';
        $inputContent .= '</tr>';
        foreach($this->attributs AS $attribut){
            $inputContent .= $attribut->renderForDisplay();
        }
        $inputContent .= '</table>';
        $content = StringTools::replaceFirst($content, '%content%', $inputContent);
        
        return $content;
    }
}


