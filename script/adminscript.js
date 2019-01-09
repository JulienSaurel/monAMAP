
///////////////////////////////////////////////////////////
////////////////////// JS Prévisualisation ///////////////
/////////////////////////////////////////////////////////


/**
 * Met a jour les images d'articles en tps réel
 * @param _divId_
 * @param sourceId
 */
function ActualizeSelectedImage(_divId_, sourceId) {
    var source = document.getElementById(sourceId);
    var value = source.value;
    var toact = document.getElementById(_divId_);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.status === 200 && request.readyState === 4) {
            toact.src = request.responseText;
        }
    };

    request.open('GET', '?action=getArticleImage&controller=admin&id='+ value);
    request.send('');
}

function ActualizeSelectedPage(location, ididhp) {
    idhp = document.getElementById(ididhp).value;
    if (location === "title") {
        //alert(idhp);
        ActualizeTitleBySelect(idhp);
    } else if(location === "news") {
        ActualizeNewsBySelect(idhp);
    } else if(location === "middle") {
        ActualizeMiddleBySelect(idhp);
    } else if(location === "bottom") {
        ActualizeBottomBySelect(idhp);
    }
}


function ActualizeTitleBySelect(idhp) {
    //alert(idhp);
    ActualizeValueBySelect('pagetitle', idhp, 'label1', 'label');
    ActualizeValueBySelect('welcomephrase', idhp, 'label2', 'label');
    ActualizeValueBySelect('descbannerphrase', idhp, 'label3', 'label');


    ActualizeTextInputFromAjaxReq('pagetitlehp', idhp, 'pagetitle');
    ActualizeTextInputFromAjaxReq('welcomephrase',idhp, 'welcomephrase');
    ActualizeTextInputFromAjaxReq('descbannerphrase',idhp, 'descbannerphrase');

}

function ActualizeNewsBySelect(idhp) {
    ActualizeValueBySelect('news', idhp, 'label101','label');
    ActualizeValueBySelect('name', idhp, 'label102','label');
    ActualizeValueBySelect('text', idhp, 'label103','label');//compliqué
    ActualizeValueBySelect('namearticlelink', idhp, 'label104','label');
    ActualizeValueBySelect('maptitle', idhp, 'label107','label');
    ActualizeValueBySelect('maplink', idhp, 'label108','label');


    ActualizeTextInputFromAjaxReq('namearticlelink', idhp, 'namearticlelink');
    ActualizeTextInputFromAjaxReq('maptitle',idhp, 'maptitle');
    ActualizeImageInputFromAjaxReq('maplink',idhp, 'maplink');

}

function ActualizeMiddleBySelect(idhp) {
    ActualizeValueBySelect('firstparagraph', idhp, 'label20','label');
    ActualizeValueBySelect('firstparagraphlink', idhp, 'label21','label');
    ActualizeValueBySelect('firstimagetitle', idhp, 'label22','label');
    ActualizeValueBySelect('firstimagephrase', idhp, 'label24','label');
    //ActualizeValueBySelect('firstparagraph', idhp, 'label20','label');//compliqué

    ActualizeTextInputFromAjaxReq('firstparagraph', idhp, 'firstimageparagraph');
    ActualizeTextInputFromAjaxReq('firstparagraphlink', idhp, 'firstparagraphlink');
    ActualizeTextInputFromAjaxReq('firstimagetitle', idhp, 'firstimagetitle');
    ActualizeTextInputFromAjaxReq('firstimagephrase', idhp, 'firstimagephrase');

}

function ActualizeBottomBySelect(idhp) {
    ActualizeValueBySelect('secondimagetitle', idhp, 'label1001', 'label');
    ActualizeValueBySelect('secondimageparagraph', idhp, 'label1003', 'label');


    ActualizeTextInputFromAjaxReq('secondimagetitle', idhp, 'secondimagetitle');
    ActualizeTextInputFromAjaxReq('secondimageparagraph', idhp, 'secondimageparagraph');
}


function ActualizeValueBySelect(attr, idhp, idtochange, type) {
    var toact = document.getElementById(idtochange);
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.status === 200 && request.readyState === 4) {
            if (type === "textinput") {
                toact.value = request.responseText;
            } else if (type === "textearea") {
                toact.innerText = request.responseText;
            } else if (type === "label") {
                toact.textContent = request.responseText;
            } else if (type === "selected") {
                //issou
                alert("");
            }
        }
    };
    if (attr === "news") {
        request.open('GET', '?action=getnewsnameortext&controller=admin&id='+ idhp + '&offset=0');
    } else if (attr === "name") {
        request.open('GET', '?action=getnewsnameortext&controller=admin&id='+ idhp + '&offset=2');
    } else if (attr === "text") {
        request.open('GET', '?action=getnewsnameortext&controller=admin&id='+ idhp + '&offset=3');
    } else {
        request.open('GET', '?action=gethomepageatribute&controller=admin&id=' + idhp + '&attr=' + attr);
    }
    request.send('');
}



function ActualizeTextInputFromAjaxReq(_divId_, idhp, attr) {
    var toact = document.getElementById(_divId_);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.status === 200 && request.readyState === 4) {
            var response = request.responseText.replace(/^\s+|\s+$/g,'');
            toact.innerText = response;
        }
    };

    request.open('GET', '?action=gethomepageatribute&controller=admin&id='+ idhp + '&attr=' + attr);
    request.send('');
}

function ActualizeImageInputFromAjaxReq(_divId_, idhp, attr) {
    var toact = document.getElementById(_divId_);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.status === 200 && request.readyState === 4) {
            var response = request.responseText.replace(/^\s+|\s+$/g,'');
            toact.src = response;
        }
    };

    request.open('GET', '?action=gethomepageatribute&controller=admin&id='+ idhp + '&attr=' + attr);
    request.send('');
}



/**
 * Actualise une image de divId a partir de la valeur de sourceId
 * @param _divId_
 * @param sourceId
 */
function ActualizeImage(_divId_, sourceId) {
    var source = document.getElementById(sourceId);
    var value = source.value;
    var toact = document.getElementById(_divId_);
    if (value.indexOf("./images/")=== -1) {
        toact.src = "./images/" + value;
    } else {
        toact.src = value;
    }
}

/**
 * Appelle ActualizeTextInput ou getDefaultValue en fonction de si le texte est null ou non
 * @param _divId_
 * @param sourceId
 */
function launchActualizeTextInput(_divId_, sourceId) {
    var source = document.getElementById(sourceId);
    var value = source.value;
    if (value !== "") {
        ActualizeTextInput(_divId_, value);
    } else {
        getDefaultValue(_divId_, sourceId);
    }
}

/**
 * Actualise en directe la valeur d'une chaine de caractere
 * @param _divId_
 * @param value
 */
function ActualizeTextInput(_divId_, value) {
    var toact = document.getElementById(_divId_);
    toact.innerText = value;
}


/**
 * Remet la valeur par défaut d'une id
 * @param _divId_
 * @param sourceId
 */
function getDefaultValue(_divId_, sourceId) {
    var togetvalueback = document.getElementById(_divId_);
    var labelname = "label" + sourceId;
    togetvalueback.innerText = document.getElementById(labelname).innerText;
}


///////////////////////////////////////////////////////////
////////////////////// JS Prévisualisation ///////////////
/////////////////////////////////////////////////////////