/* Set the width of the side navigation to 250px */
function openNav() {

    document.getElementById("mySidenav").style.width = "350px";
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

