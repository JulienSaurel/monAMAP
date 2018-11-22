<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div id="closebtn" >
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><img id="logocroix" src="images/croix.png" alt="logo burger" /></a>
</div>
   <ul id="menu">
    <li class="accueil">
      <a class="lienMenu" href="?action=display&controller=accueil">Accueil</a>
    </li>
    <li class="nousConnaitre">
      <a class="lienMenu" onclick"openLink()" href="?action=display1st&controller=nousConnaitre"> Nous connaitre</a>
      <ul>
        <li><a class="lienMenu" href="?action=display2nd&controller=nousConnaitre">l'AMAP</a></li>
        <li><a class="lienMenu" href="?action=display3rd&controller=nousConnaitre">Nous contacter</a></li>
        <li><a class="lienMenu" href="?action=display4th&controller=nousConnaitre">Nous trouver</a></li>
      </ul>
    </li>
    <li class="nosProduits">
      <a onclick="openLink()" class="lienMenu"  href="?action=display&controller=nosProduits">Nos produits</a>
      <ul>
        <li><a class="lienMenu" href="?action=display1st&controller=nosProduits">Nos producteurs</a></li>
        <li><a class="lienMenu" href="?action=display2nd&controller=nosProduits">Produits du moment</a></li>
      </ul>
    </li>
    <li class="nosContrats">
      <a onclick="openLink()" class="lienMenu" href="?action=display&controller=nosContrats">Nos contrats</a>
      <ul>
        <li><a class="lienMenu" href="?action=display1st&controller=nosContrats">Laitier</a></li>
        <li><a class="lienMenu" href="?action=display2nd&controller=nosContrats">Viande</a></li>
        <li><a class="lienMenu" href="?action=display3rd&controller=nosContrats">Légumes</a></li>
        <li><a class="lienMenu" href="?action=display4th&controller=nosContrats">Mix</a></li>
      </ul>
    </li>
    <li class="laVieAlAMAP">
      <a onclick="openLink()" class="lienMenu" href="?action=display&controller=laVieAlAMAP">La vie à l'AMAP</a>
      <ul>
        <li><a class="lienMenu" href="?action=display1st&controller=laVieAlAMAP">Articles</a></li>
        <li><a class="lienMenu" href="?action=display2nd&controller=laVieAlAMAP">Evénements</a></li>
        <li><a class="lienMenu" href="?action=display3rd&controller=laVieAlAMAP">Livre d'or</a></li>
      </ul>
    </li>
    <li class="monProfil">
      <a onclick="openLink()" class="lienMenu" href="?action=display1st&controller=monProfil">Mon profil</a>
      <ul>
        <li><a class="lienMenu" href="?action=display1st&controller=monProfil">Voir mon profil</a></li>
        <li><a class="lienMenu" href="?action=display2nd&controller=monProfil">Devenir producteur</a></li>
      </ul>
    </li>
    <li class="nousSoutenir">
      <a onclick="openLink()" class="lienMenu " href="?action=display&controller=nousSoutenir">Nous soutenir</a>
    </li>
  </ul>
</div>

<!-- Use any element to open the sidenav -->
<span id="openav" onclick="openNav()"> <img id="logoBurger" src="images/burger.png" alt="logo burger" /></span>

<nav id="navMenu">
  <ul id="menu">
    <li class="accueil">
      <a class="lienMenu" href="?action=display&controller=accueil">Accueil</a>
    </li>
    <li class="nousConnaitre">
      <a class="lienMenu" href="?action=display1st&controller=nousConnaitre">Nous connaitre</a>
    	<ul>
        <li><a class="lienMenu" href="?action=display2nd&controller=nousConnaitre">l'AMAP</a></li>
        <li><a class="lienMenu" href="?action=display3rd&controller=nousConnaitre">Nous contacter</a></li>
        <li><a class="lienMenu" href="?action=display4th&controller=nousConnaitre">Nous trouver</a></li>
      </ul>
    </li>
    <li class="nosProduits">
      <a class="lienMenu" href="?action=display&controller=nosProduits">Nos produits</a>
    	<ul>
        <li><a class="lienMenu" href="?action=display1st&controller=nosProduits">Nos producteurs</a></li>
        <li><a class="lienMenu" href="?action=display2nd&controller=nosProduits">Produits du moment</a></li>
      </ul>
    </li>
    <li class="nosContrats">
      <a class="lienMenu" href="?action=display&controller=nosContrats">Nos contrats</a>
    	<ul>
        <li><a class="lienMenu" href="?action=display1st&controller=nosContrats">Laitier</a></li>
        <li><a class="lienMenu" href="?action=display2nd&controller=nosContrats">Viande</a></li>
        <li><a class="lienMenu" href="?action=display3rd&controller=nosContrats">Légumes</a></li>
    	  <li><a class="lienMenu" href="?action=display4th&controller=nosContrats">Mix</a></li>
      </ul>
    </li>
    <li class="laVieAlAMAP">
      <a class="lienMenu" href="?action=display&controller=laVieAlAMAP">La vie à l'AMAP</a>
    	<ul>
        <li><a class="lienMenu" href="?action=display1st&controller=laVieAlAMAP">Articles</a></li>
        <li><a class="lienMenu" href="?action=display2nd&controller=laVieAlAMAP">Evénements</a></li>
    	  <li><a class="lienMenu" href="?action=display3rd&controller=laVieAlAMAP">Livre d'or</a></li>
      </ul>
    </li>
    <li class="monProfil">
      <a class="lienMenu" href="?action=display1st&controller=monProfil">Mon profil</a>
    	<ul>
        <li><a class="lienMenu" href="?action=display1st&controller=monProfil">Voir mon profil</a></li>
        <li><a class="lienMenu" href="?action=display2nd&controller=monProfil">Devenir producteur</a></li>
      </ul>
    </li>
    <li class="nousSoutenir">
      <a class="lienMenu" href="?action=display&controller=nousSoutenir">Nous soutenir</a>
    </li>
  </ul>
</nav> 
