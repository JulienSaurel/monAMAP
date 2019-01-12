<div id="mySidenav" class="sidenav">
    <div id="closebtn" >
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><img id="logocroix" src="images/croix.png" alt="logo burger" /></a>
    </div>

    <ul id="menu">
        <li class="accueil">
            <a class="lienMenu" href="?action=homepage&controller=accueil">Accueil</a>
        </li>
        <li class="nousConnaitre">
            <a class="lienMenu" onclick="openLink()" href="?action=presentation&controller=nousConnaitre"> Nous connaitre</a>
            <ul>
                <li><a class="lienMenu" href="?action=AMAPstory&controller=nousConnaitre">l'AMAP</a></li>
                <li><a class="lienMenu" href="?action=contactus&controller=nousConnaitre">Nous contacter</a></li>
                <li><a class="lienMenu" href="?action=findus&controller=nousConnaitre">Nous trouver</a></li>
            </ul>
        </li>
        <li class="nosProduits">
            <a onclick="openLink()" class="lienMenu"  href="?action=readAllproducts&controller=nosProduits">Nos produits</a>
            <ul>
                <li><a class="lienMenu" href="?action=readAllprod&controller=nosProduits">Nos producteurs</a></li>
                <li><a class="lienMenu" href="?action=seasonsproducts&controller=nosProduits">Produits du moment</a></li>
            </ul>
        </li>
        <li class="nosContrats">
            <a onclick="openLink()" class="lienMenu" href="?action=detail&controller=nosContrats">Nos contrats</a>
            <ul>
                <li><a class="lienMenu" href="?action=detail&controller=nosContrats&type=laitier">Laitier</a></li>
                <li><a class="lienMenu" href="?action=detail&controller=nosContrats&type=carné">Viande</a></li>
                <li><a class="lienMenu" href="?action=detail&controller=nosContrats&type=végétal">Légumes</a></li>
                <li><a class="lienMenu" href="?action=detail&controller=nosContrats&type=mix">Mix</a></li>
            </ul>
        </li>
        <li class="laVieAlAMAP">
            <a onclick="openLink()" class="lienMenu" href="?action=AMAPslife&controller=laVieAlAMAP">La vie à l'AMAP</a>
            <ul>
                <li><a class="lienMenu" href="?action=readAllart&controller=laVieAlAMAP">Articles</a></li>
                <li><a class="lienMenu" href="?action=readAllmsg&controller=laVieAlAMAP">Evénements</a></li>
                <li><a class="lienMenu" href="?action=readAllevents&controller=laVieAlAMAP">Livre d'or</a></li>
            </ul>
        </li>
        <li class="nousSoutenir">
            <a onclick="openLink()" class="lienMenu " href="?action=donnate&controller=nousSoutenir">Nous soutenir</a>
        </li>
        <?php  if (!isset($_SESSION['login'])) { ?>
            <li class="SeConnecter">
                <a onclick="openLink()" class="lienMenu " href="?action=connect&controller=adherent">Se connecter</a>
            </li>
        <?php }
        else
        { ?>
            <li class="monProfil">
                <a onclick="openLink()" class="lienMenu" href="?action=profile&controller=monProfil">Mon profil</a>
                <ul>
                    <li><a class="lienMenu" href="?action=profile&controller=monProfil">Voir mon profil</a></li>
                    <li><a class="lienMenu" href="?action=gotoupdate&controller=monProfil">Modifier mon profil</a></li>
                    <li><a class="lienMenu" href="?action=updatePW&controller=monProfil">Modifier votre mot de passe</a></li>
                    <?php if(!isset($_SESSION['producteur'])){ ?>
                        <li><a class="lienMenu" href="?action=becomeprod&controller=monProfil">Devenir producteur</a></li>
                    <?php } ?>
                    <li><a class="lienMenu"href="?action=deconnect&controller=adherent">Se deconnecter</a></li>
                </ul>
            </li>
        <?php } ?>
        <?php if(isset($_SESSION['administrateur'])){ ?>
            <li class="accueil">
                <a class="lienMenu" href="?action=adminhomepage&controller=admin">Administration</a>
            </li>
        <?php } ?>
    </ul>
</div>


<!-- Use any element to open the sidenav -->
<span id="openav" onclick="openNav()"> <img id="logoBurger" src="images/burger.png" alt="logo burger" /></span>



<nav id="navMenu">
    <ul id="menu">
        <li class="accueil">
            <a class="lienMenu" href="?action=homepage&controller=accueil">Accueil</a>
        </li>
        <li class="nousConnaitre">
            <a class="lienMenu" href="?action=presentation&controller=nousConnaitre">Nous connaitre</a>
            <ul>
                <li><a class="lienMenu" href="?action=AMAPstory&controller=nousConnaitre">l'AMAP</a></li>
                <li><a class="lienMenu" href="?action=contactus&controller=nousConnaitre">Nous contacter</a></li>
                <li><a class="lienMenu" href="?action=findus&controller=nousConnaitre">Nous trouver</a></li>
            </ul>
        </li>
        <li class="nosProduits">
            <a class="lienMenu" href="?action=readAllproducts&controller=nosProduits">Nos produits</a>
            <ul>
                <li><a class="lienMenu" href="?action=readAllprod&controller=nosProduits">Nos producteurs</a></li>
                <li><a class="lienMenu" href="?action=seasonsproducts&controller=nosProduits">Produits du moment</a></li>
            </ul>
        </li>
        <li class="nosContrats">
            <a class="lienMenu" href="?action=detail&controller=nosContrats">Nos contrats</a>
            <ul>
                <li><a class="lienMenu" href="?action=detail&controller=nosContrats&type=laitier">Laitier</a></li>
                <li><a class="lienMenu" href="?action=detail&controller=nosContrats&type=carné">Viande</a></li>
                <li><a class="lienMenu" href="?action=detail&controller=nosContrats&type=végétal">Légumes</a></li>
                <li><a class="lienMenu" href="?action=detail&controller=nosContrats&type=mix">Mix</a></li>
            </ul>
        </li>
        <li class="laVieAlAMAP">
            <a class="lienMenu" href="?action=AMAPslife&controller=laVieAlAMAP">La vie à l'AMAP</a>
            <ul>
                <li><a class="lienMenu" href="?action=readAllart&controller=laVieAlAMAP">Articles</a></li>
                <li><a class="lienMenu" href="?action=readAllmsg&controller=laVieAlAMAP">Evénements</a></li>
                <li><a class="lienMenu" href="?action=readAllevents&controller=laVieAlAMAP">Livre d'or</a></li>
            </ul>
        </li>
        <li class="nousSoutenir">
            <a class="lienMenu" href="?action=donnate&controller=nousSoutenir">Nous soutenir</a>
        </li>
        <?php  if (!isset($_SESSION['login'])) { ?>
            <li class="SeConnecter">
                <a onclick="openLink()" class="lienMenu " href="?action=connect&controller=adherent">Se connecter</a>
            </li>
        <?php }
        else
        { ?>
            <li class="monProfil">
                <a onclick="openLink()" class="lienMenu" href="?action=profile&controller=monProfil">Mon profil</a>
                <ul>
                    <li><a class="lienMenu" href="?action=profile&controller=monProfil">Voir mon profil</a></li>
                    <li><a class="lienMenu" href="?action=gotoupdate&controller=monProfil">Modifier mon profil</a></li>
                    <li><a class="lienMenu" href="?action=updatePW&controller=monProfil">Modifier votre mot de passe</a></li>
                    <?php if(!isset($_SESSION['producteur'])){ ?>
                        <li><a class="lienMenu" href="?action=becomeprod&controller=monProfil">Devenir producteur</a></li>
                    <?php } ?>
                    <li><a class="lienMenu" href="?action=deconnect&controller=adherent">Se deconnecter</a></li>
                </ul>
            </li>
        <?php } ?>
        <?php if(isset($_SESSION['administrateur'])){ ?>
            <li class="accueil">
                <a class="lienMenu" href="?action=adminhomepage&controller=admin">Administration</a>
            </li>
        <?php } ?>
    </ul>
</nav> 
