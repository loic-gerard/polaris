// JavaScript Document

function getAjax() {
	try {
		//alert('msxml2');
		return new ActiveXObject('Msxml2.XMLHTTP');
	} catch (e) {
		try {
			//alert('microsoft');
			return new ActiveXObject('Microsoft.XMLHTTP');
		} catch (e) {
			//alert('xmlhttpreq');
			return new XMLHttpRequest();
			
		}
	}
}

/**
 * Perform AJAX call.
 *
 * @param {string} url URL of AJAX service.
 * @param {function} func Function to call when response arrives.
 * @param {string} method Request method post or get.
 * @param {Array} array Array with arguments to send.
 * ex : sendAjax("ajax.cfm", self.ajaxCallback, 'post', "arg1=value&arg2=value", [param1,param2]);
 */
function sendAjax(url, func, method, array, funcarray) {
	var x = getAjax();

	x.open(method, url, true);

	x.onreadystatechange = function() {
		if (x.readyState == 4) {
			//alert('responseXML : '+x.responseXML);
			//alert('responseTest : '+x.responseText);
			func(x.responseText, x.responseXML, funcarray);
			
			/*if (mode == "xml") {
				func(x.responseXML, funcarray);
			}
			else {
				func(x.responseText, funcarray);
			}*/
		}
	};

	if (method == 'post')
		x.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

	x.send(array);
}


/***** FONCTIONS D'AIDE *****/


/**	Extrait le message d'erreur du XML et l'affiche dans une boite d'alerte
	xml : la structure XML donnÃ©e au callback Ajax.
*/
function showAjaxError(xml) {
	alert(xml.firstChild.firstChild.nodeValue);	
}

/**	Scan toutes les divs de debug Ajax et ajoute leur contenu Ã  la fin de body
*/
function showHtmlAjaxError() {
	var divs = document.getElementsByTagName('div');
	var x = 0;
	//var dbg = document.getElementById('debug');
	//dbg.innerHTML += "<hr>";
	for (var i=0; i < divs.length; i++) {
		//dbg.innerHTML += "<p>class="+divs[i].getAttribute('class') + " ; " + "shown="+(divs[i].getAttribute('shown') != "true")+"</p>";
		if (divs[i].getAttribute('class') == "ajaxdebug" && divs[i].getAttribute('shown') != "true") {
			window.status = 'Found HTML debug';
			//dbg.innerHTML += "OK,";
			divs[i].setAttribute('shown', "true");
			appendDebug(divs[i].innerHTML);
			//x++;	
		}
	}
	//dbg.innerHTML += x+"/"+divs.length;
	//alert(x+"/"+divs.length);
}


/**	Extrait le debug du xml en fonction de l'Ã©tat d'erreur et le renvoie.
	xml : le xml retournÃ© au callback Ajax
	err : la valeur de l'attribut "erreur" du xml : var err = xml.getAttribute('erreur');
*/
function getDebug(xml, err) {
	//console.log(xml);
	
	if (err=="true"){
		var debug = xml.firstChild.nextSibling.firstChild.nodeValue;
	}
	else {
		var debug = xml.firstChild.firstChild.nodeValue;
	}
	
	return debug;
}

/**	Ajoute le contenu HTML passÃ© en paramÃ¨tre Ã  la fin du BODY (aprÃ¨s le dÃ©bug Coldfusion classique s'il existe)
*/
function appendDebug(debug) {
	var ajaxdebugzone = document.getElementById('ajaxdebugzone');
	if (ajaxdebugzone == null) {
		var ajaxdebugzone = document.createElement('div');
		document.body.appendChild(ajaxdebugzone);
	}
	ajaxdebugzone.innerHTML = ajaxdebugzone.innerHTML + debug;	
}


/** Traite le callback Ajax et renvoie true si tout s'est bien passÃ©
	Note : L'erreur n'est dÃ©tectable que si du XML a Ã©tÃ© renvoyÃ©. Si du HTML est renvoyÃ©, true sera toujours renvoyÃ©
	text, xml, params : les mÃªmes variables que celles envoyÃ©es au callback
	debugMode : par dÃ©faut Ã  false, si true le debug est activÃ© et affichÃ© sur la page
*/
function checkAjax(text, xml, params, debugMode) {
	if (debugMode == null) { debugMode == false; }
	if (text == null && (xml == null || xml.documentElement == null)) {
		alert("Erreur : la fonction n'a renvoyÃ© ni HTML, ni XML");
		return false;
	}
		
	//alert(xml);
	//alert(xml.documentElement);
	//alert(xml.firstChild);

	if (xml != null && xml.firstChild != null) {	// renvoi d'un XML
		
		//console.log("xml=", xml);
		
		if (xml.documentElement != null) {
			var xml = xml.documentElement;
		}
		
		var err = xml.getAttribute('erreur');
		var errType = xml.getAttribute('errortype');
		
		if (debugMode) { var debug = getDebug(xml,err); }
	
		if (err=="true") {
			if (errType == "-1") {	// pas une erreur custom, donc on affiche une alerte jscript
				showAjaxError(xml);
			}
			
			if (debugMode) { appendDebug(debug); }
			return false;
		}
		else {
			if (debugMode) { appendDebug(debug); }
			return true;
		}
	}
	else {	// renvoi d'un contenu HTML
		if (debugMode) { var t = setTimeout("showHtmlAjaxError()", 500); }	// scanne les divs de debug et les affiche
		return true;
	}
}

function getXML(xml) {
	if (xml != null && xml.firstChild != null) {	// renvoi d'un XML
		
		if (xml.documentElement != null) {
			var xml = xml.documentElement;
		}
		
		return xml;
		
	}
	else {	
		//throw();	// TODO
	}
}

/** Renvoie la valeur de l'attribut demandÃ© pour le XML donnÃ© (tjs sous forme de chaine).
	L'attribut doit Ãªtre un attribut de la toute premiÃ¨re balise (<res>).
	Une chaine vide est renvoyÃ©e si l'attribut n'est pas renseignÃ© ou n'existe pas.
*/
function getXMLAttribute(xml, attribute) {
	xml = getXML(xml);
	
	return xml.getAttribute(attribute);
}

function getXMLError(xml) {
	var res = new Object();
	res.erreur = "false";
	res.errortype = "-1";
	
	res.erreur = getXMLAttribute(xml, "erreur");
	res.errortype = getXMLAttribute(xml, "errortype");
	
	return res;
}

/**	Execute le code javascript des balises <script> contenues dans l'Ã©lÃ©ment "divContent"
	A appeler une fois un contenu Ajax placÃ© dans une page.
*/
function executeJavascript(divContent) {
	var AllScripts=divContent.getElementsByTagName("script")
	for (var i=0; i<AllScripts.length; i++) {
		var s=AllScripts[i];
		if (s.src && s.src!="") {
			// PrÃ©cÃ©dement asynchrone, mis en synchrone pour Ã©viter 
			//des problÃ¨mes de dÃ©pendances de scripts
			eval(getFileContent(s.src))
		}
		else {
			eval(s.innerHTML)
		}
	}
}

function getFileContent(url) {
	var Xhr=getAjax();
	Xhr.open("GET",url,false);
	Xhr.send(null);
	return Xhr.responseText;
}


/** Analyse le formulaire (element HTML) passÃ© en paramÃ¨tre et transforme les valeurs passÃ©es en une chaine de paramÃ¨tres "nom=valeur&nom2=valeur2"
*/
function getFormAsString(form) {
	var elems = form.elements;
	var args = "";
	
	for (i=0; i < elems.length; i++) {
		args = args + elems[i].name + "=" + elems[i].value + "&";
	}
	
	args = args.substring(0,args.length-1);
	
	return args;
}

/*	Analyse le formulaire (element HTML) passÃ© en paramÃ¨tre et transforme les valeurs passÃ©es en une chaine de paramÃ¨tres "nom=valeur&nom2=valeur2"
	Envoie ensuite le tout Ã  une page Ajax qui gÃ¨re l'update.
	
	ICI A TITRE D'EXEMPLE POUR UTILISER "getFormAsString()"
*/
/*function submitForm(form, pk) {
	var args = getFormAsString(form);
	
	sendAjax("/backoffice/generique/ajaxeditliste.cfm?configbase=#configbase#&modifpk="+pk, self.submitCallback, 'post', args, [pk]);
}*/