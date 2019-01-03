<?php
////////////////////////////////////////
//Affichage de la liste des adhérents//
//////////////////////////////////////
if ($type == 'adherent')
{ ?>
    <div class="mdl-grid demo-grid">
        <?php foreach ($tab as $o) {
            $p = ModelPersonne::select($o->get('mailPersonne'));
            $id = $o->get('idAdherent'); ?>
            <!-- Wide card with share menu button -->
            <div class="demo-card-wide mdl-card mdl-shadow--2dp mdl-cell">
                <div class="mdl-card__title" style="background-image: url(<?php echo $o->get('photo') ?>)">
                    <h2 class="mdl-card__title-text"> <?php echo htmlspecialchars($p->get('prenomPersonne')). " " . htmlspecialchars($p->get('nomPersonne')) ?>  </h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <?php echo htmlspecialchars(substr($o->get('description'), 0, 50)) . "..."; ?>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="?action=gotoupdate&id=<?php echo urlencode($id); ?>&type=adherent&controller=admin">
                        Modifier l'adhérent
                    </a>
                </div>
                <div class="mdl-card__menu">
                    <a href="?action=delete&id=<?php echo urlencode($id); ?>&type=adherent&controller=admin"><i class="material-icons">delete</i></a>
                </div>
            </div>
            <!--<li class="mdl-list__item">
    <span class="mdl-list__item-primary-content">
    <i class="material-icons mdl-list__item-icon">person</i>
        <a href="?action=gotoupdate&id=<?php /*echo urlencode($id); */?>&type=adherent&controller=admin"><?php /*echo htmlspecialchars($p->get('prenomPersonne'))  . " " . htmlspecialchars($p->get('nomPersonne')) . " "; */?></a>
</span>
                <span class="mdl-list__item-secondary-content">
    <a href="?action=delete&controller=admin&id=<?php /*echo urlencode($id); */?>&type=adherent&controller=admin"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">delete</i></a>
  </span>
            </li>-->

        <?php } ?>
    </div>

<?php }

///////////////////////////////////////
//Affichage de la liste des articles//
/////////////////////////////////////
elseif ($type == 'article') { ?>
    <div class="mdl-grid demo-grid">
        <?php   foreach ($tab as $o) {
            $id = $o->get('idArticle');?>
            <!-- Wide card with share menu button -->
            <div class="demo-card-wide mdl-card mdl-shadow--2dp mdl-cell">
                <div class="mdl-card__title" style="background-image: url(<?php echo $o->get('photo') ?>)">
                    <h2 class="mdl-card__title-text"> <?php echo htmlspecialchars($o->get('titreArticle')) ?>  </h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <?php echo htmlspecialchars(substr($o->get('description'), 0, 40)) . "..."; ?>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="?action=gotoupdate&id=<?php echo urlencode($id); ?>&type=article&controller=admin">
                        Modifier l'article
                    </a>
                </div>
                <div class="mdl-card__menu">
                    <a href="?action=delete&id=<?php echo urlencode($id); ?>&type=article&controller=admin"><i class="material-icons">delete</i></a>
                </div>
            </div>

        <?php } ?>
    </div>
<?php }
///////////////////////////////////////
//Affichage de la liste des messages//
/////////////////////////////////////
elseif ($type == 'livreDor') { ?>
    <ul class="demo-list-icon mdl-list">
        <?php   foreach ($tab as $o) {
            $id = $o->get('id_message'); ?>
            <li class="mdl-list__item">
    <span class="mdl-list__item-primary-content">
    <i class="material-icons mdl-list__item-icon">forum</i>
        <a href="?action=gotoupdate&id=<?php echo urlencode($id); ?>&type=livreDor&controller=admin"><?php echo htmlspecialchars($o->get('pseudo'))  . " a écrit: " . htmlspecialchars($o->get('message')) . " "; ?></a>
</span>
                <span class="mdl-list__item-secondary-content">
    <a href="?action=delete&controller=admin&id=<?php echo urlencode($id); ?>&type=livreDor&controller=admin"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">delete</i></a>
  </span>
            </li>

        <?php } ?>
    </ul>
<?php }
///////////////////////////////////////
//Affichage de la liste des produits//
/////////////////////////////////////
elseif ($type == 'produit') { ?>
    <div class="mdl-grid demo-grid">
        <?php   foreach ($tab as $o) {
            $id = $o->get('nomProduit');?>
            <!-- Wide card with share menu button -->
            <div class="demo-card-wide mdl-card mdl-shadow--2dp mdl-cell">
                <div class="mdl-card__title" style="background-image: url(<?php echo $o->get('image') ?>)">
                    <h2 class="mdl-card__title-text"> <?php echo htmlspecialchars($o->get('nomProduit')) ?>  </h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <?php echo htmlspecialchars(substr($o->get('description'), 0, 40)) . "..."; ?>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="?action=gotoupdate&id=<?php echo urlencode($id); ?>&controller=admin&type=produit">
                        Modifier le produit
                    </a>
                </div>
                <div class="mdl-card__menu">
                    <a href="?action=delete&id=<?php echo urlencode($id); ?>&type=produit&controller=admin"><i class="material-icons">delete</i></a>
                </div>
            </div>

        <?php } ?>
    </div>
<?php }
