
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
        ActualizeTitleBySelect(idhp);
    } else if(location === "news") {
        ActualizeNewsBySelect(idhp);
    } else if(location === "middle") {
        ActualizeMiddleBySelect(idhp);
    } else if(location === "bottom") {
        ActualizeBottomBySelect(idhp);
    }
}

//////////////////  TITLE  ///////////////////////////
function ActualizeTitleBySelect(idhp) {
                //// FORM ////
    //LABEL FORM;
    ActualizeValueBySelect('pagetitle', idhp, 'label1', 'label');
    ActualizeValueBySelect('welcomephrase', idhp, 'label2', 'label');
    ActualizeValueBySelect('descbannerphrase', idhp, 'label3', 'label');

    //SELECTED INDEX FORM
    ActualizeValueBySelect('photo1', idhp, '4', 'selected');
    ActualizeValueBySelect('photo2', idhp, '5', 'selected');
    ActualizeValueBySelect('photo3', idhp, '6', 'selected');

                //// PREVI ////
    //Prévisualisation TEXT
    ActualizeTextInputFromAjaxReq('pagetitlehp', idhp, 'pagetitle');
    ActualizeTextInputFromAjaxReq('welcomephrase',idhp, 'welcomephrase');
    ActualizeTextInputFromAjaxReq('descbannerphrase',idhp, 'descbannerphrase');

    //Prévisualisation IMG
    ActualizeImageInputFromAjaxReq('photo1',idhp, 'photo1');
    ActualizeImageInputFromAjaxReq('photo2',idhp, 'photo2');
    ActualizeImageInputFromAjaxReq('photo3',idhp, 'photo3');


}
//////////////////  TITLE  ///////////////////////////


/////////////////  NEWS  ///////////////////
function ActualizeNewsBySelect(idhp) {
            //// FORM ////
    //LABEL FORM;
    ActualizeValueBySelect('news', idhp, 'label101','label');
    ActualizeValueBySelect('name', idhp, 'label102','label');
    ActualizeValueBySelect('text', idhp, 'label103','label');
    ActualizeValueBySelect('namearticlelink', idhp, 'label104','label');
    ActualizeValueBySelect('maptitle', idhp, 'label107','label');
    ActualizeValueBySelect('maplink', idhp, 'label108','label');

    //SELECTED INDEX FORM
    ActualizeValueBySelect('firstarticledisplayed', idhp, '105', 'selected');
    ActualizeValueBySelect('secondarticledisplayed', idhp, '106', 'selected');

            //// PREVI ////
    //Prévisualisation TEXT
    ActualizeTextInputFromAjaxReq('namearticlelink', idhp, 'namearticlelink');
    ActualizeTextInputFromAjaxReq('maptitle',idhp, 'maptitle');
    ActualizeTextInputFromAjaxReq('news',idhp, 'news');
    ActualizeTextInputFromAjaxReq('name', idhp, 'name');
    ActualizeTextInputFromAjaxReq('text',idhp, 'text');

    //Prévisualisation IMG
    ActualizeImageInputFromAjaxReq('maplink',idhp, 'maplink');
    ActualizeImageInputFromAjaxReq('firstarticledisplayed',idhp, 'firstarticledisplayed');
    ActualizeImageInputFromAjaxReq('secondarticledisplayed',idhp, 'secondarticledisplayed');

}
/////////////////  NEWS  ///////////////////




//////////////////  MIDDLE  ///////////////////////////
function ActualizeMiddleBySelect(idhp) {
            //// FORM ////
    //LABEL FORM;
    ActualizeValueBySelect('firstparagraph', idhp, 'label20','label');
    ActualizeValueBySelect('firstparagraphlink', idhp, 'label21','label');
    ActualizeValueBySelect('firstimagetitle', idhp, 'label22','label');
    ActualizeValueBySelect('firstimagephrase', idhp, 'label24','label');
    ActualizeValueBySelect('firstimagelist', idhp, '25','textearea');

    //SELECTED INDEX FORM
    ActualizeValueBySelect('firstimage', idhp, '23', 'selected');

            //// PREVI ////
    //Prévisualisation TEXT
    ActualizeTextInputFromAjaxReq('firstparagraph', idhp, 'firstparagraph');
    ActualizeTextInputFromAjaxReq('firstparagraphlink', idhp, 'firstparagraphlink');
    ActualizeTextInputFromAjaxReq('firstimagetitle', idhp, 'firstimagetitle');
    ActualizeTextInputFromAjaxReq('firstimagephrase', idhp, 'firstimagephrase');
    ActualizeTextInputFromAjaxReq('firstimagelist', idhp, 'firstimagelist');


    //Prévisualisation IMG
    ActualizeImageInputFromAjaxReq('firstimage',idhp, 'firstimage');
}
//////////////////  MIDDLE  ///////////////////////////


//////////////////  BOTTOM  ///////////////////////////
function ActualizeBottomBySelect(idhp) {
            //// FORM ////
    //LABEL FORM;
    ActualizeValueBySelect('secondimagetitle', idhp, 'label1001', 'label');
    ActualizeValueBySelect('secondimageparagraph', idhp, 'label1003', 'label');

    //SELECTED INDEX FORM
    ActualizeValueBySelect('secondimage', idhp, '1002', 'selected');//TODO

            //// PREVI ////
    //Prévisualisation TEXT
    ActualizeTextInputFromAjaxReq('secondimagetitle', idhp, 'secondimagetitle');
    ActualizeTextInputFromAjaxReq('secondimageparagraph', idhp, 'secondimageparagraph');

    //Prévisualisation IMG
    ActualizeImageInputFromAjaxReq('secondimage',idhp, 'secondimage');

}
//////////////////  BOTTOM  ///////////////////////////

function ActualizeValueBySelect(attr, idhp, idtochange, type) {
    var toact = document.getElementById(idtochange);
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.status === 200 && request.readyState === 4) {
            if (type === "textinput") {
                toact.value = request.responseText;
            } else if (type === "textearea") {
                toact.value = request.responseText.replace(/^\s+|\s+$/g,'');
            } else if (type === "label") {
                toact.textContent = request.responseText;
            } else if (type === "selected") {
                for (var i=0; i<toact.options.length; i++){
                    if (toact.options.item(i).text.replace(/^\s+|\s+$/g,'') === request.responseText.replace(/^\s+|\s+$/g,'')) {
                        toact.options.item(i).selected = "selected";
                    } else {
                        toact.options.item(i).selected = "";
                    }
                }
            }
        }
    };
    if (attr === "news") {
        request.open('GET', '?action=getnewsnameortext&controller=admin&id='+ idhp + '&offset=0');
    } else if (attr === "name") {
        request.open('GET', '?action=getnewsnameortext&controller=admin&id='+ idhp + '&offset=2');
    } else if (attr === "text") {
        request.open('GET', '?action=getnewsnameortext&controller=admin&id='+ idhp + '&offset=3');
    } else if (attr === "photo1") {
        request.open('GET', '?action=getbanner&controller=admin&id='+ idhp + '&index=0');
    } else if (attr === "photo2") {
        request.open('GET', '?action=getbanner&controller=admin&id='+ idhp + '&index=1');
    } else if (attr === "photo3") {
        request.open('GET', '?action=getbanner&controller=admin&id='+ idhp + '&index=2');
    } else if (attr === "firstarticledisplayed" || attr === "secondarticledisplayed") {
        request.open('GET', '?action=getArticleTitleByHpId&controller=admin&id=' + idhp + '&attr=' + attr);//TODO
    } else if (attr === "firstimage" || attr === "secondimage") {
        request.open('GET', '?action=gethomepageatribute&controller=admin&id=' + idhp + '&attr=' + attr + '&img=y');
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
            toact.innerText = request.responseText.replace(/^\s+|\s+$/g,'');
        }
    };

    if (attr === "news") {
        request.open('GET', '?action=getnewsnameortext&controller=admin&id='+ idhp + '&offset=0');
    } else if(attr === "name") {
        request.open('GET', '?action=getnewsnameortext&controller=admin&id='+ idhp + '&offset=2');
    } else if(attr === "text") {
        request.open('GET', '?action=getnewsnameortext&controller=admin&id='+ idhp + '&offset=3');
    } else {
        request.open('GET', '?action=gethomepageatribute&controller=admin&id=' + idhp + '&attr=' + attr);
    }
    request.send('');
}

function ActualizeImageInputFromAjaxReq(_divId_, idhp, attr) {
    var toact = document.getElementById(_divId_);

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (request.status === 200 && request.readyState === 4) {
            toact.src = request.responseText.replace(/^\s+|\s+$/g,'');
        }
    };

    if (attr === "photo1" || attr === "photo2" || attr === "photo3") {
        let index = attr.substring(attr.length - 1) - 1;
        let url = '?action=getbanner&controller=admin&id=' + idhp + '&index=' + index + '&previ=y';
        request.open('GET', url);
    } else if (attr === "firstarticledisplayed" || attr === "secondarticledisplayed") {
        request.open('GET', '?action=getArticlePhotoByHpId&controller=admin&id=' + idhp + '&attr=' + attr);
    } else {
        request.open('GET', '?action=gethomepageatribute&controller=admin&id=' + idhp + '&attr=' + attr);
    }
    request.send('');
}



/**
 * Actualise une image de divId a partir de la valeur de sourceId
 * @param _divId_
 * @param sourceId
 */
function ActualizeImage(_divId_, sourceId) {
    let source = document.getElementById(sourceId);
    let value = source.value;
    let toact = document.getElementById(_divId_);
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
 * *@param idhp
*/
function launchActualizeListInput(_divId_,ididhp,sourceId) {
    let source = document.getElementById(sourceId);
    let value = source.value;
    if (value !== "") {
        ActualizeTextInput(_divId_, value);
    } else {
        //Actualise by AJAX;
        let idhp = document.getElementById(ididhp).value;
        ActualizeTextInputFromAjaxReq('firstimagelist', idhp, 'firstimagelist');

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