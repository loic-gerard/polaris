<?php

namespace polarisapi\ui\categorie;

use jin\query\Query;
use jin\query\QueryResult;
use polarisapi\data\View;
use jin\lang\StringTools;

class Categorie {

    private $datas;
    public $attributs = array();
    protected $headerContent = '';
    protected $width;

    public function __construct($code, $id_entite) {

        $q = new Query();
        $q->setRequest('SELECT * FROM categorie '
                . 'WHERE tt_code=' . $q->argument($code, Query::$SQL_STRING));
        $q->execute();
        $this->datas = $q->getQueryResults();

        $q = new Query();
        $q->setRequest('SELECT * FROM attribut WHERE fk_categorie=' . $q->argument($this->getId(), Query::$SQL_NUMERIC));
        $q->execute();
        $qr = $q->getQueryResults();

        foreach ($qr AS $r) {
            $type = StringTools::firstCarToUpperCase($r['tt_type']);
            $className = 'polarisapi\data\attribut\\' . $type;
            $c = new $className($id_entite, $r['tt_code'], null);
            $this->attributs[] = $c;
        }
    }
    
    public function setWidth($w){
        $this->width = $w;
    }

    public function getId() {
        return $this->datas->getValueAt('pk_categorie');
    }

    public function getCode() {
        return $this->datas->getValueAt('tt_code');
    }

    public function getDesignation() {
        return $this->datas->getValueAt('tt_designation');
    }

    public function build() {
        $speStyle = '';
        
        $output = '';
        $output .= '<div class="categorie">';
        $output .= '<div class="nom">' . $this->getDesignation() . '</div>';
        $output .= '<div class="content">';
        $output .= $this->getHeaderContent();
        $output .= '<div class="insideContent">%content%</div>';
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
