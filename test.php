<?php

//Default GMT
date_default_timezone_set('GMT');

//Gestion des erreurs
error_reporting(E_ALL);
ini_set("display_errors", 1);

$content = "
<page>
    <h1>Exemple d'utilisation</h1>
    <br>
    Ceci est un <b>exemple d'utilisation</b>
    de <a href='http://html2pdf.fr/'>HTML2PDF</a>.<br>
</page>";

require_once(dirname(__FILE__).'/html2pdf_v4.03/html2pdf.class.php');
$html2pdf = new HTML2PDF('P','A4','fr');
$html2pdf->WriteHTML($content);
$html2pdf->Output('exemple.pdf');