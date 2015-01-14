<?php

namespace polarisapi\ui\categorie;

use jin\query\Query;
use jin\query\QueryResult;
use polarisapi\data\View;
use jin\lang\StringTools;

class FreeCategorie {

    private $nom;
    protected $headerContent = '';

    public function __construct($nom) {
        $this->nom = $nom;
       
    }

    public function getDesignation() {
        return $this->nom;
    }

    public function build($content) {
        $output = '';
        $output .= '<div class="categorie" id="'.$this->nom.'">';
        $output .= '<div class="nom">' . $this->getDesignation() . '</div>';
        $output .= '<div class="content">';
        $output .= $this->getHeaderContent();
        $output .= '<div class="insideContent">'.$content.'</div>';
        $output .= '</div>';



        return $output;
    }
    
    protected function getHeaderContent(){
        if($this->headerContent != ''){
            return '<div class="categorieHeader">'.$this->headerContent.'</div>';
        }
        return '';
    }

    public function setHeader($content){
        $this->headerContent = $content;
    }
}
