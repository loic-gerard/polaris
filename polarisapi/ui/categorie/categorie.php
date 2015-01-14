<?php

namespace polarisapi\ui\categorie;

use jin\query\Query;
use jin\query\QueryResult;
use polarisapi\data\View;
use jin\lang\StringTools;
use jin\log\Debug;

class Categorie {

    private $datas;
    private $type;
    public $attributs = array();
    protected $headerContent = '';
    protected $width;
    protected $designation;

    public function __construct($code, $id_entite, $designation = null) {
	$this->designation = $designation;
	
	if($code){
	    $q = new Query();
	    $q->setRequest('SELECT * FROM categorie '
		    . 'WHERE tt_code=' . $q->argument($code, Query::$SQL_STRING));
	    $q->execute();
	    $this->datas = $q->getQueryResults();

	    $q = new Query();
	    $q->setRequest('SELECT * FROM attribut WHERE fk_categorie=' . $q->argument($this->getId(), Query::$SQL_NUMERIC));
	    $q->execute();
	    $qr = $q->getQueryResults();
	}else{
	    $q = new Query();
	    $q->setRequest('SELECT * FROM entite '
		    . 'WHERE pk_entite=' . $q->argument($id_entite, Query::$SQL_NUMERIC));
	    $q->execute();
	    $this->datas = $q->getQueryResults();
	    
	    $q = new Query();
	    $q->setRequest('SELECT * FROM attribut WHERE fk_entitetype=' . $q->argument($this->datas->getValueAt('fk_entitetype'), Query::$SQL_NUMERIC));
	    $q->execute();
	    $qr = $q->getQueryResults();
	    
	
	}

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
	if($this->designation){
	    return $this->designation;
	}else{
	    return $this->datas->getValueAt('tt_designation');
	}
        
    }

    public function build() {
        $speStyle = '';
        
	$code = $this->getCode();
	if($code == ''){
	    $code = $this->designation;
	}
	
        $output = '';
        $output .= '<div class="categorie" id="'.$code.'">';
        $output .= '<div class="nom">' . $this->getDesignation() . '</div>';
        $output .= '<div class="content">';
        $output .= $this->getHeaderContent();
        $output .= '<div class="insideContent">%content%</div>';
        $output .= '</div>';
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
