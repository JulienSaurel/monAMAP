/* Set the width of the side navigation to 250px */
function openNav() {

    document.getElementById("mySidenav").style.width = "450px";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
} 


function openLink(){
	document.getElementsByClassName("linkmenu").children.style.display = "block";
}

function closeLink(){
	document.getElementByClassName("linkmenu").children.style.display = "none";
}

///////////////////////////////////////////////////////////
////////////////////// JS Articles ///////////////////////
/////////////////////////////////////////////////////////
/**
 * Affiche un article en grand, si l'article est trop grand on peux scroll
 * Ferme tous les autres articles ouverts
 * @param _divId_ id de l'article
 * @param int numero de l'id
 * @constructor
 */
function Extend(_divId_, int) {

    // on crée un tableau avec tous les div
    var AllObj=document.getElementsByTagName('div')

    //on crée un tableau vide pour y stocker nos div d'articles
    var targetObj =new Array()

    //on parcours le grand tableau et on range dans le tableau vide les div d'articles en testant leur id
    for (var i=0;i<AllObj.length;i++){
        if (AllObj[i].id.substr(0,6)=="target"){targetObj.push(AllObj[i])}
    }

    //on parcours les articles et on les réduit tous sauf celui que l'on aggrandit
    for (var j=0;j<targetObj.length; j++) {
       if (targetObj[j].id != _divId_) {
           Reduce(targetObj[j].id, j+1)
       }
    }
    //on augmente la height a 50%(ancienne: 50px)
    changeSizePercent(_divId_, 50);

    //on permet le scroll
    document.getElementById(_divId_).style.overflow = "scroll";

    //on affiche le bouton pour rétrécir et on cache celui pour agrandir
    document.getElementById('sourceplus' + int).style.display='none';
    document.getElementById('sourcemoins' + int).style.display='inline';
}

/**
 * Rétrécit l'article et empeche le scroll
 * @param _divId_
 * @param int
 * @constructor
 */
function Reduce(_divId_, int) {

    //on réduit la height a 50px(ancienne: 50%)
    changeSizePx(_divId_, 50);

    //on reset le scroll puis on l'empeche et on cache ce qui dépasse
    document.getElementById(_divId_).scrollTop = 0;
    document.getElementById(_divId_).style.overflow = "hidden";

    //on cache le bouton qui réduit et on affiche celui qui aggrandit
    document.getElementById('sourcemoins' + int).style.display='none';
    document.getElementById('sourceplus' + int).style.display='inline';
}

/**
 * Set la height à _newSizey_ d'une div en pourcentage (on peut aussi rajouter la width en décommentant)
 * @param _divId_
 * @param _newSizey_
 */
function changeSizePercent (_divId_, /*_newSizex_,*/ _newSizey_){
    if ( document.getElementById(_divId_) != null ){
/*
        document.getElementById(_divId_).style.width = _newSizex_ +"%";
*/
        document.getElementById(_divId_).style.height = _newSizey_ +"%";
    }
}

/**
 * Set la height à _newSizey_ d'une div en pixels (on peut aussi rajouter la width en décommentant)
 * @param _divId_
 * @param _newSizey_
 */
function changeSizePx (_divId_, /*_newSizex_,*/ _newSizey_){
    if ( document.getElementById(_divId_) != null ){
        /*
                document.getElementById(_divId_).style.width = _newSizex_ +"px";
        */
        document.getElementById(_divId_).style.height = _newSizey_ +"px";
    }
}
///////////////////////////////////////////////////////////
////////////////////// JS Articles ///////////////////////
/////////////////////////////////////////////////////////




///////////////////////////////////////////////////////////
////////////////////// JS Cotisation  ////////////////////
/////////////////////////////////////////////////////////
/**
 * change le prix et le minimum du prix
 * @constructor
 */
function ModifySelectedElmt()
{
    //on recupere l'option du select et on change le prix affiché la valeur par défaut et le min
    var firstselect = document.getElementById('duration')
    var prixmin = document.getElementById('pricemin')
    var casetochange = document.getElementById('total');
    casetochange.value = 1.5*parseInt(firstselect.value)
    casetochange.min = casetochange.value
    prixmin.innerText = "Prix minimum: " + casetochange.value + " €"

}
///////////////////////////////////////////////////////////
////////////////////// JS Cotisation  ////////////////////
/////////////////////////////////////////////////////////
