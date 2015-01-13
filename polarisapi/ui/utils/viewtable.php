<?php

namespace polarisapi\ui\utils;

use polarisapi\data\View;
use \PolarisCore;

class ViewTable {
    private $view;
    private $colNames;
    private $ajout;
    private $addAttributsToEdit;
    private $addAttributsToSet;
    private $delete;
    private $edit;
    private $addFromViewTable;
    private $choice;
    private $choiceParent;
    private $detailPage;
    private $equipedField;
    
    public function __construct(View $view, $colNames = array(), $ajout = false, $addAttributsToEdit = array(), $addAttributsToSet = array(), $del = false, $edit = false, $addFromViewTable = null, $choice = false, $choiceParent = 0, $detailPage = null, $equipedField= null) {
        $this->view = $view;
        $this->colNames = $colNames;
        $this->ajout = $ajout;
        $this->addAttributsToEdit = $addAttributsToEdit;
        $this->addAttributsToSet = $addAttributsToSet;
        $this->delete = $del;
        $this->edit = $edit;
        $this->addFromViewTable = $addFromViewTable;
        $this->choice = $choice;
        $this->choiceParent = $choiceParent;
	$this->detailPage = $detailPage;
	$this->equipedField = $equipedField;
	
    }
    
    public function build(){
        $output = '';
        
        if($this->ajout || $this->addFromViewTable){
            $output .= '<div class="smallButtonsHeadTableContainer">';
            if($this->ajout){
                $addUrl = PolarisCore::getAddUrl($this->view->getEntiteType(), $this->addAttributsToEdit, $this->addAttributsToSet, $this->view->getParentEntite());
                $output .= '<a href="'.$addUrl.'" class="smallBlueButton">Ajouter</a>';
            }
            if($this->addFromViewTable){
                $addUrl = PolarisCore::getUrl(array('custompopup' => $this->addFromViewTable), true, array());
                $output .= '<a href="'.$addUrl.'" class="smallBlueButton">Ajouter à partir du référentiel</a>';
            }
            $output .= '</div>';
        }
        
        $output .= '<table>';
        $output .= '<tr class="header">';
	
	if($this->equipedField){
            $output .= '<td></td>';
        }
	
        if($this->choice){
            $output .= '<td></td>';
        }
	
        foreach ($this->colNames AS $colKey => $colName){
            $output .= '<td>'.$colName.'</td>';
        }
	if($this->detailPage){
            $output .= '<td></td>';
        }
        $output .= '<td></td>';
        $output .= '</tr>';
        foreach($this->view AS $line){
            $output .= '<tr>';
            
	    if($this->equipedField){
		$output .= '<td width="90">';
		$output .= '<div class="leftCell smallButtonsContainer">';
		if($line[$this->equipedField] == 1){
		    $choiceUrl = PolarisCore::getUrl(array('desequiper' => $line['id'], 'equiperAttribut' => $this->equipedField), true, array(''));
		    $output .= '<a href="'.$choiceUrl.'" class="smallGreenButton">Equipé</a>';
		}else{
		    $choiceUrl = PolarisCore::getUrl(array('equiper' => $line['id'], 'equiperAttribut' => $this->equipedField), true, array(''));
		    $output .= '<a href="'.$choiceUrl.'" class="smallBlueButton">Non équipé</a>';
		}
		$output .= '</div>';
		$output .= '</td>';
	    }
	    
            if($this->choice){
                $choiceUrl = PolarisCore::getUrl(array('addChoiceId' => $line['id'], 'addChoiceFrom' => $this->view->getEntiteType(), 'addChoiceTo' => $this->choice, 'addChoiceParent' => $this->choiceParent), true, array('custompopup'));
                $output .= '<td><div class="leftCell smallButtonsContainer"><a href="'.$choiceUrl.'" class="smallBlueButton">Choisir</a></div></td>';
            }
            foreach ($this->colNames AS $colKey => $colName){
                $class = '';
                $editUrl = '';
                if($this->edit){
                    $class = 'modifiable';
                    $editUrl = PolarisCore::getModifierUrl($line['id'], $colKey, true);
                }
                $output .= '<td class="'.$class.'" '.$editUrl.'>'.$line[$colKey].'</td>';
            }
	    if($this->detailPage){
		$detailUrl = PolarisCore::getUrl(array('detailId' => $line['id'], 'detailPage' => $this->detailPage), true, array());
		$output .= '<td class="normalCell"><div class="smallButtonsContainer"><a href="'.$detailUrl.'" class="smallBlueButton">Details</a></div></td>';
	    }
	    
            if($this->delete){
                $delUrl = PolarisCore::getDeleteUrl($line['id']);
                $output .= '<td class="normalCell"><div class="smallButtonsContainer"><a href="'.$delUrl.'" class="smallRedButton">Supprimer</a></div></td>';
            }else{
                $output .= '<td></td>';
            }
            $output .= '</tr>';
        }
        $output .= '</table>';
        
        return $output;
    }
}
