function addProgressionPoint(joueur, type, talent){
    sendAjax("ajax.php",addProgressionPointRetour,'post','file=common/addprogressionpoint.php&joueur='+joueur+'&type='+type+'&talent='+talent,[]);
}

function addProgressionPointRetour(text, xml, params){
    alert(text);
}

function updNiveau(talent, joueur){
    sendAjax("ajax.php",updNiveauRetour,'post','file=common/updniveau.php&joueur='+joueur+'&talent='+talent,[]);
}

function updNiveauRetour(text, xml, params){
    alert(text);
}



function setPj(){
    document.getElementById('panel_PJ').style.display = '';
    document.getElementById('panel_PNJ').style.display = 'none';
}

function setPnj(){
    document.getElementById('panel_PJ').style.display = 'none';
    document.getElementById('panel_PNJ').style.display = '';
}

function setPjAttaquant(){
    document.getElementById('panel_attaquant_PJ').style.display = '';
    document.getElementById('panel_attaquant_PNJ').style.display = 'none';
}

function setPnjAttaquant(){
    document.getElementById('panel_attaquant_PJ').style.display = 'none';
    document.getElementById('panel_attaquant_PNJ').style.display = '';
}

function setPjDefenseur(){
    document.getElementById('panel_defenseur_PJ').style.display = '';
    document.getElementById('panel_defenseur_PNJ').style.display = 'none';
}

function setPnjDefenseur(){
    document.getElementById('panel_defenseur_PJ').style.display = 'none';
    document.getElementById('panel_defenseur_PNJ').style.display = '';
}


function calculateJet(){
    var joueur = document.getElementById('joueur').value;
    var attribut = document.getElementById('attribut').value;
    var intensite = document.getElementById('intensite').value;
    
    sendAjax("ajax.php",calculateJetRetour,'post','file=appz/gestion/panels/jettalent/ajax_calcul.php&joueur='+joueur+'&attribut='+attribut+'&intensite='+intensite,[]);
}

function calculateJetRetour(text, xml, params){
    document.getElementById('resultatCalcul').innerHTML = text;
}

function calculateJetCarac(){
    var type = 'pnj';
    if(document.getElementById('type_pj').checked){
	type = 'pj';
    }
    var joueur = document.getElementById('joueur').value;
    var pnj = document.getElementById('pnj').value;
    var attributpj = document.getElementById('attributpj').value;
    var attributpnj = document.getElementById('attributpnj').value;
    var intensite = document.getElementById('intensite').value;
    var margeadv = document.getElementById('margeadv').value;
    
    sendAjax("ajax.php",calculateJetCaracRetour,'post','file=appz/gestion/panels/jetcarac/ajax_calcul.php&joueur='+joueur+'&attributpj='+attributpj+'&intensite='+intensite+'&margeadv='+margeadv+'&attributpnj='+attributpnj+'&pnj='+pnj+'&type='+type,[]);
}

function calculateJetCaracRetour(text, xml, params){
    document.getElementById('resultatCalcul').innerHTML = text;
}


function calculateJetPerceptionEcouter(){
    var type = 'pnj';
    if(document.getElementById('target_pj').checked){
	type = 'pj';
    }
    var joueur = document.getElementById('joueur').value;
    var pnj = document.getElementById('pnj').value;
    var intensite = document.getElementById('difficulte').value;
    var diffBase = document.querySelector('input[name="difficultebase"]:checked').value;
    var mod1 = document.querySelector('input[name="mod_bruit"]:checked').value;
    var mod2 = document.querySelector('input[name="mod_bruitdefond"]:checked').value;
    var mod3 = document.querySelector('input[name="mod_terrain"]:checked').value;
    
    sendAjax("ajax.php",calculateJetPerceptionEcouterRetour,'post','file=appz/gestion/panels/perception_ecouter/ajax_calcul.php&joueur='+joueur+'&intensite='+intensite+'&diffBase='+diffBase+'&mod1='+mod1+'&mod2='+mod2+'&mod3='+mod3+'&type='+type+'&pnj='+pnj,[]);
}

function calculateJetPerceptionEcouterRetour(text, xml, params){
    document.getElementById('resultatCalcul').innerHTML = text;
}

function calculateJetPerceptionSentir(){
    var type = 'pnj';
    if(document.getElementById('target_pj').checked){
	type = 'pj';
    }
    var joueur = document.getElementById('joueur').value;
    var pnj = document.getElementById('pnj').value;
    var intensite = document.getElementById('difficulte').value;
    var diffBase = document.querySelector('input[name="difficultebase"]:checked').value;
    
    
    sendAjax("ajax.php",calculateJetPerceptionSentirRetour,'post','file=appz/gestion/panels/perception_sentir/ajax_calcul.php&joueur='+joueur+'&intensite='+intensite+'&diffBase='+diffBase+'&type='+type+'&pnj='+pnj,[]);
}

function calculateJetPerceptionSentirRetour(text, xml, params){
    document.getElementById('resultatCalcul').innerHTML = text;
}

function calculateJetPerceptionVoir(){
    var type = 'pnj';
    if(document.getElementById('target_pj').checked){
	type = 'pj';
    }
    var joueur = document.getElementById('joueur').value;
    var pnj = document.getElementById('pnj').value;
    var intensite = document.getElementById('difficulte').value;
    var diffBase = document.querySelector('input[name="difficultebase"]:checked').value;
    
    var mod1 = document.querySelector('input[name="mod1"]:checked').value;
    var mod2 = document.querySelector('input[name="mod2"]:checked').value;
    
    sendAjax("ajax.php",calculateJetPerceptionVoirRetour,'post','file=appz/gestion/panels/perception_voir/ajax_calcul.php&joueur='+joueur+'&intensite='+intensite+'&diffBase='+diffBase+'&mod1='+mod1+'&mod2='+mod2+'&type='+type+'&pnj='+pnj,[]);
}

function calculateJetPerceptionVoirRetour(text, xml, params){
    document.getElementById('resultatCalcul').innerHTML = text;
}