<?php

namespace polarisapi\data;

use jin\query\Query;
use jin\query\QueryResult;
use jin\lang\StringTools;

class Paliers{
    
    public static function getMaxPalier($porcent){
        $datas = self::getPalierColumn($porcent);
        
        $max = 0;
        foreach($datas['marges'] AS $d){
            if($d['marge'] < 11){
                $max = $d['marge'];
            }
        }
        
        return $max;
    }
    
    public static function getPalierColumn($porcent){
        if($porcent < 2){
            $datas['palier'] = 1;
            $datas['marges'] = array();
            $datas['marges'][] = array('marge' => 11, 'min' => 1, 'max' => 1);
            
            return $datas;
        }
        
	if($porcent > 99){
	    $porcent = 99;
	}
	
        //On récupère le palier
        $q = new Query();
        $q->setRequest('SELECT palier FROM palier WHERE marge=1 '
                . 'AND min <= '.$q->argument($porcent, Query::$SQL_NUMERIC).' '
                . 'AND max >= '.$q->argument($porcent, Query::$SQL_NUMERIC));
        $q->execute();
        $qr = $q->getQueryResults();
	
        
        $palier = $qr->getValueAt('palier');
	
        $q = new Query();
        $q->setRequest('SELECT * FROM palier WHERE palier='.$q->argument($palier, Query::$SQL_NUMERIC).' '
                . 'ORDER BY marge ASC');
        $q->execute();
        $qr = $q->getQueryResults();
        
        $datas = array();
        $datas['palier'] = $palier;
        $datas['marges'] = array();
        foreach($qr AS $r){
            $d = array();
            $d['marge'] = $r['marge'];
            $d['min'] = $r['min'];
            $d['max'] = $r['max'];
            $datas['marges'][] = $d;
        }
    
        return $datas;
    }
    
    public static function renderPalierColumn($porcent, $onclick = '', $formName = null){
        $palier = self::getPalierColumn($porcent);
        
        $output = '<table>';
        $output .= '<tr class="header">';
        if($formName){
            $output .= '<td width="10">&nbsp;</td>';
        }
        $output .= '<td>Marge</td>';
        $output .= '<td>Palier '.$palier['palier'].'</td>';
        $output .= '</tr>';
        $first = true;
        foreach($palier['marges'] AS $marge){
            $uid = uniqid();
            if($onclick){
                $output .= '<tr class="modifiable" >';

            }else{
                $output .= '<tr class="modifiable" onClick="javascript:if(document.getElementById(\'marge_'.$uid.'\').checked){ document.getElementById(\'marge_'.$uid.'\').checked = false; }else{ document.getElementById(\'marge_'.$uid.'\').checked = true; }">';

            }
            if($formName){
                $checked = '';
                if($first){
                    $first = false;
                    $checked = 'checked="checked"';
                }
                $output .= '<td width="10"><input id="marge_'.$uid.'" type="radio" '.$checked.' value="'.$marge['marge'].'" name="'.$formName.'" id="'.$formName.'_'.$marge['marge'].'"></td>';
            }
	    if($onclick){
		$url = StringTools::replaceAll($onclick, '%marge%', $marge['marge']);
		
		$output .= '<td class="modifiable" onClick="'.$url.'">'.$marge['marge'].'</td>';
	    }else{
		$output .= '<td>'.$marge['marge'].'</td>';
	    }
            
            $aff = '';
            if($marge['min'] == $marge['max']){
                $aff = $marge['min'];
            }else{
                $aff = $marge['min'].' - '.$marge['max'];
            }
            $output .= '<td>'.$aff.'</td>';
            $output .= '</tr>';
        }
        $output .= '</table>';
        
        return $output;
    }
}

