<?php

namespace polarisapi\ui\menu;

use polarisapi\data\View;
use polarisapi\ui\menu\MenuItem;

class Menu{
    private $view;
    private $itemMenuTemplate;
    private $toParseInUrl;
    private $defaultItemValue;
    private $keepUrlArgs;
    private $except;
    
    public function __construct(View $view, $itemMenuTemplate, $toParseInUrl, $defaultItemValue = null, $keepUrlArgs = true, $except = array()) {
        $this->view = $view;
        $this->itemMenuTemplate = $itemMenuTemplate;
        $this->toParseInUrl = $toParseInUrl;
        $this->defaultItemValue = $defaultItemValue;
        $this->keepUrlArgs = $keepUrlArgs;
        $this->except = $except;
    }
    
    public function build(){
        $output = '';
        foreach($this->view AS $item){
            $gItem = new MenuItem($this, $item);
            $output .= $gItem->build();
        }
        
        return $output;
    }
    
    public function getSelectedValue(){
        $sa = $this->getIdentifierUrlAttribut();
        if(isset($_GET[$sa])){
            return $_GET[$sa];
        }
        if($this->defaultItemValue){
            return $this->defaultItemValue;
        }
        return '';
    }
    
    public function getIdentifierAttribut(){
        foreach($this->toParseInUrl AS $url => $data){
            return $data;
        }
    }
    
    public function getIdentifierUrlAttribut(){
        foreach($this->toParseInUrl AS $url => $data){
            return $url;
        }
    }
    
    public function getTemplate(){
        return $this->itemMenuTemplate;
    }
    
    public function getAttributs(){
        return $this->view->getAttributs();
    }
    
    public function getToParseInUrl(){
        return $this->toParseInUrl;
    }
    
    public function getKeepUrlArgs(){
        return $this->keepUrlArgs;
    }
    
    public function getExceptionKeepUrlArgs(){
        return $this->except;
    }
}
