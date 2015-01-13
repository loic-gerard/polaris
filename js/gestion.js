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
    var joueur = document.getElementById('joueur').value;
    var attribut = document.getElementById('attribut').value;
    var intensite = document.getElementById('intensite').value;
    var margeadv = document.getElementById('margeadv').value;
    
    sendAjax("ajax.php",calculateJetCaracRetour,'post','file=appz/gestion/panels/jetcarac/ajax_calcul.php&joueur='+joueur+'&attribut='+attribut+'&intensite='+intensite+'&margeadv='+margeadv,[]);
}

function calculateJetCaracRetour(text, xml, params){
    document.getElementById('resultatCalcul').innerHTML = text;
}


function calculateJetPerceptionEcouter(){
    var joueur = document.getElementById('joueur').value;
    var intensite = document.getElementById('difficulte').value;
    var diffBase = document.querySelector('input[name="difficultebase"]:checked').value;
    var mod1 = document.querySelector('input[name="mod_bruit"]:checked').value;
    var mod2 = document.querySelector('input[name="mod_bruitdefond"]:checked').value;
    var mod3 = document.querySelector('input[name="mod_terrain"]:checked').value;
    
    sendAjax("ajax.php",calculateJetPerceptionEcouterRetour,'post','file=appz/gestion/panels/perception_ecouter/ajax_calcul.php&joueur='+joueur+'&intensite='+intensite+'&diffBase='+diffBase+'&mod1='+mod1+'&mod2='+mod2+'&mod3='+mod3,[]);
}

function calculateJetPerceptionEcouterRetour(text, xml, params){
    document.getElementById('resultatCalcul').innerHTML = text;
}

function calculateJetPerceptionSentir(){
    var joueur = document.getElementById('joueur').value;
    var intensite = document.getElementById('difficulte').value;
    var diffBase = document.querySelector('input[name="difficultebase"]:checked').value;
    
    
    sendAjax("ajax.php",calculateJetPerceptionSentirRetour,'post','file=appz/gestion/panels/perception_sentir/ajax_calcul.php&joueur='+joueur+'&intensite='+intensite+'&diffBase='+diffBase,[]);
}

function calculateJetPerceptionSentirRetour(text, xml, params){
    document.getElementById('resultatCalcul').innerHTML = text;
}

function calculateJetPerceptionVoir(){
    var joueur = document.getElementById('joueur').value;
    var intensite = document.getElementById('difficulte').value;
    var diffBase = document.querySelector('input[name="difficultebase"]:checked').value;
    
    var mod1 = document.querySelector('input[name="mod1"]:checked').value;
    var mod2 = document.querySelector('input[name="mod2"]:checked').value;
    
    sendAjax("ajax.php",calculateJetPerceptionVoirRetour,'post','file=appz/gestion/panels/perception_voir/ajax_calcul.php&joueur='+joueur+'&intensite='+intensite+'&diffBase='+diffBase+'&mod1='+mod1+'&mod2='+mod2,[]);
}

function calculateJetPerceptionVoirRetour(text, xml, params){
    document.getElementById('resultatCalcul').innerHTML = text;
}