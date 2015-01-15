<?php

namespace polarisapi\ui\categorie;

use polarisapi\ui\categorie\Categorie;
use polarisapi\data\attribut\Attribut;
use jin\lang\StringTools;

class TalentList extends Categorie{
    public function build(){
        $content = parent::build();
        
        $inputContent = '';
        $inputContent .= '<table>';
        $inputContent .= '<tr class="header">';
        $inputContent .= '<td width="50%">Talent</td>';
        $inputContent .= '<td width="10%">Niv</td>';
        $inputContent .= '<td width="10%">Exp</td>';
        $inputContent .= '<td width="10%">Bonus</td>';
        $inputContent .= '<td width="10%">Mod</td>';
        $inputContent .= '<td width="10%">Total</td>';
        $inputContent .= '</tr>';
        foreach($this->attributs AS $attribut){
            $inputContent .= $attribut->renderForDisplay();
        }
        $inputContent .= '</table>';
        $content = StringTools::replaceFirst($content, '%content%', $inputContent);
        
        return $content;
    }
}


