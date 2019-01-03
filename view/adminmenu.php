<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
    <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
            <a href="?action=adminhomepage&controller=admin"><span class="mdl-layout-title">Home</span></a>
            <div class="mdl-layout-spacer"></div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
                <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
                    <i class="material-icons">search</i>
                </label>
                <div class="mdl-textfield__expandable-holder">
                    <input class="mdl-textfield__input" type="text" id="search">
                    <label class="mdl-textfield__label" for="search">Enter your query...</label>
                </div>
            </div>
            <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
                <i class="material-icons">more_vert</i>
            </button>
            <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
                <li class="mdl-menu__item">About</li>
                <li class="mdl-menu__item">Contact</li>
                <li class="mdl-menu__item">Legal information</li>
            </ul>
        </div>
    </header>
    <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
            <img src="<?php echo ModelAdherent::select($_SESSION['login'])->get('photo');?>" class="demo-avatar">
            <div class="demo-avatar-dropdown">
                <span><?php echo $_SESSION['login']; ?></span>
            </div>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
            <a class="mdl-navigation__link" href="?action=homepage&controller=accueil"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Page d'accueil du site</a>
            <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">flag</i>Validations en attente</a>
            <a class="mdl-navigation__link" href="?action=readAll&controller=admin&type=livreDor"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">forum</i>Messages</a>
            <a class="mdl-navigation__link" href="?action=readAll&controller=admin&type=adherent"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i>Adhérents</a>
            <a class="mdl-navigation__link" href="?action=readAll&controller=admin&type=article"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">art_track</i>Articles</a>
            <a class="mdl-navigation__link" href="?action=readAll&controller=admin&type=produit"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">local_florist</i>Produits</a>
            <div class="mdl-layout-spacer"></div>
            <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">help_outline</i><span class="visuallyhidden">Help</span></a>
        </nav>
    </div>