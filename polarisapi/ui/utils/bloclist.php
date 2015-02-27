<?php

namespace polarisapi\ui\utils;

use polarisapi\data\View;
use \PolarisCore;
use jin\filesystem\File;
use jin\lang\StringTools;

class BlocList {

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
    private $template;

    public function __construct($template, View $view, $colNames = array(), $ajout = false, $addAttributsToEdit = array(), $addAttributsToSet = array(), $del = false, $edit = false, $addFromViewTable = null, $choice = false, $choiceParent = 0, $detailPage = null, $equipedField = null) {
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
        $this->template = $template;
    }

    public function build() {
        $output = '';

        if ($this->ajout || $this->addFromViewTable) {
            $output .= '<div class="smallButtonsHeadTableContainer">';
            if ($this->ajout) {
                $addUrl = PolarisCore::getAddUrl($this->view->getEntiteType(), $this->addAttributsToEdit, $this->addAttributsToSet, $this->view->getParentEntite());
                $output .= '<a href="' . $addUrl . '" class="smallBlueButton">Ajouter</a>';
            }
            if ($this->addFromViewTable) {
                $addUrl = PolarisCore::getUrl(array('custompopup' => $this->addFromViewTable), true, array());
                $output .= '<a href="' . $addUrl . '" class="smallBlueButton">Ajouter à partir du référentiel</a>';
            }
            $output .= '</div>';
        }

        foreach ($this->view AS $line) {
            $output .= '<div class="bloclist">';
            
            
            $f = new File($this->template);
            $fc = $f->getContent();
            
            foreach ($this->colNames AS $colKey => $colName) {
                if($this->edit){
                    $editUrl = PolarisCore::getModifierUrl($line['id'], $colKey, true);
                    $fc = StringTools::replaceAll($fc, '%'.$colKey.'%', '<a class="modifiable" '.$editUrl.'>'.$line[$colKey].'</a>');
                    $fc = StringTools::replaceAll($fc, '%LABEL_'.$colKey.'%', '<a class="modifiable" '.$editUrl.'>'.$colName.'</a>');
                }else{
                    $fc = StringTools::replaceAll($fc, '%'.$colKey.'%', $line[$colKey]);
                    $fc = StringTools::replaceAll($fc, '%LABEL_'.$colKey.'%', $colName);
                }

            }
            
            $output .= $fc;

            $output .= '<div class="bloclistac">';
            if ($this->equipedField) {
                $output .= '<div class="leftCell smallButtonsContainer">';
                if ($line[$this->equipedField] == 1) {
                    $choiceUrl = PolarisCore::getUrl(array('desequiper' => $line['id'], 'equiperAttribut' => $this->equipedField), true, array(''));
                    $output .= '<a href="' . $choiceUrl . '" class="smallGreenButton">Equipé</a>';
                } else {
                    $choiceUrl = PolarisCore::getUrl(array('equiper' => $line['id'], 'equiperAttribut' => $this->equipedField), true, array(''));
                    $output .= '<a href="' . $choiceUrl . '" class="smallBlueButton">Non équipé</a>';
                }
                $output .= '</div>';
            }

            if ($this->choice) {
                $choiceUrl = PolarisCore::getUrl(array('addChoiceId' => $line['id'], 'addChoiceFrom' => $this->view->getEntiteType(), 'addChoiceTo' => $this->choice, 'addChoiceParent' => $this->choiceParent), true, array('custompopup'));
                $output .= '<div class="leftCell smallButtonsContainer"><a href="' . $choiceUrl . '" class="smallBlueButton">Choisir</a></div>';
            }

            if ($this->detailPage) {
                $detailUrl = PolarisCore::getUrl(array('detailId' => $line['id'], 'detailPage' => $this->detailPage), true, array());
                $output .= '<div class="smallButtonsContainer"><a href="' . $detailUrl . '" class="smallBlueButton">Details</a></div>';
            }

            if ($this->delete) {
                $delUrl = PolarisCore::getDeleteUrl($line['id']);
                $output .= '<div class="smallButtonsContainer"><a href="' . $delUrl . '" class="smallRedButton">Supprimer</a></div>';
            }
            $output .= '</div>';
            
            $output .= '</div>';
        }


        return $output;
    }

}
