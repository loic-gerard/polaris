<?php

namespace polarisapi\ui\menu;

use jin\filesystem\File;
use polarisapi\ui\menu\Menu;
use jin\lang\StringTools;
use PolarisCore;
use jin\log\Debug;

class MenuItem{
    private $menu;
    private $datas;
    
    public function __construct(Menu $menu, $datas) {
        $this->menu = $menu;
        $this->datas = $datas;
    }
    
    public function build(){
        if($this->getIdValue() == $this->menu->getSelectedValue()){
            $f = new File(ROOT.'templates/menu/'.$this->menu->getTemplate().'/on.php');
        }else{
            $f = new File(ROOT.'templates/menu/'.$this->menu->getTemplate().'/off.php');
        }
        $fc = $f->getContent();
        
        $fc = StringTools::replaceAll($fc, '%HREF%', $this->getUrl());
        $attributs = $this->menu->getAttributs();
        foreach($attributs as $attribut){
            $fc = StringTools::replaceAll($fc, '%'.$attribut.'%', $this->datas[$attribut]);
        }
        
        return $fc;
    }
    
    public function getIdValue(){
        if($this->menu->getIdentifierAttribut() == '%'){
            return $this->datas['id'];
        }
        return $this->datas[$this->menu->getIdentifierAttribut()];
    }
    
    private function getUrl(){
        $toParseInUrl = $this->menu->getToParseInUrl();
        $args = array();
        foreach($toParseInUrl as $urlCode => $dataCode){
            if($dataCode == '%'){
                $args[$urlCode] = $this->datas['id'];
            }else{
                $args[$urlCode] = $this->datas[$dataCode];
            }
            
        }
        return PolarisCore::getUrl($args, $this->menu->getKeepUrlArgs(), $this->menu->getExceptionKeepUrlArgs());
    }
}