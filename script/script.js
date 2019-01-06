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


//JS Articles
function changeSizePercent (_divId_, /*_newSizex_,*/ _newSizey_){
    if ( document.getElementById(_divId_) != null ){
/*
        document.getElementById(_divId_).style.width = _newSizex_ +"%";
*/
        document.getElementById(_divId_).style.height = _newSizey_ +"%";
    }
}

function changeSizePx (_divId_, /*_newSizex_,*/ _newSizey_){
    if ( document.getElementById(_divId_) != null ){
        /*
                document.getElementById(_divId_).style.width = _newSizex_ +"px";
        */
        document.getElementById(_divId_).style.height = _newSizey_ +"px";
    }
}
//JS Articles