<?php
if ($type == 'adherents')
{ ?>
    <ul class="demo-list-icon mdl-list">
        <?php foreach ($tab as $o) {
            $p = ModelPersonne::select($o->get('mailPersonne'));
            $id = $o->get('idAdherent');
            ?>
            <li class="mdl-list__item">
    <span class="mdl-list__item-primary-content">
    <i class="material-icons mdl-list__item-icon">person</i>
        <a href="?action=gotoupdate&id=<?php echo $id ?>&type=adherent&controller=admin"><?php echo $p->get('prenomPersonne')  . " " . $p->get('nomPersonne') . " "; ?></a>
</span>
                <span class="mdl-list__item-secondary-content">
    <a href="?action=delete&controller=admin&id=<?php echo $id; ?>&type=adherent&controller=admin"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">delete</i></a>
  </span>
            </li>

        <?php } ?> </ul>

<?php } elseif ($type == 'articles') { ?>
    <div class="mdl-grid demo-grid">
        <?php   foreach ($tab as $o) {
            $id = $o->get('idArticle');?>
            <!-- Wide card with share menu button -->
            <div class="demo-card-wide mdl-card mdl-shadow--2dp mdl-cell">
                <div class="mdl-card__title" style="background-image: url(<?php echo $o->get('photo') ?>)">
                    <h2 class="mdl-card__title-text"> <?php echo $o->get('titreArticle') ?>  </h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <?php echo substr($o->get('description'), 0, 40) . "..."; ?>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="?action=update&id=<?php echo $id; ?>&type=articles&controller=admin">
                        Modifier l'article
                    </a>
                </div>
                <div class="mdl-card__menu">
                    <a href="?action=delete&id=<?php echo $id; ?>&type=articles&controller=admin"><i class="material-icons">delete</i></a>
                </div>
            </div>

        <?php } ?>
    </div>
<?php } elseif ($type == 'messages') { ?>
    <div class="mdl-grid demo-grid">
        <?php   foreach ($tab as $o) {
            $id = $o->get('id_message'); ?>
            <div class="mdl-cell">
                <p><?php echo $o->get('pseudo'). " a écrit:"; ?> <br></p>
                <p><?php echo $o->get('message'); ?> <a href="?action=delete&id=<?php echo $id;?>&type=livreDor&controller=admin"><i class="material-icons">delete</i></a></p>
            </div>

        <?php } ?>
    </div>
<?php } elseif ($type == 'produits') { ?>
    <div class="mdl-grid demo-grid">
        <?php   foreach ($tab as $o) {
            $id = $o->get('idProduit');?>
            <!-- Wide card with share menu button -->
            <div class="demo-card-wide mdl-card mdl-shadow--2dp mdl-cell">
                <div class="mdl-card__title" style="background-image: url(<?php echo $o->get('image') ?>)">
                    <h2 class="mdl-card__title-text"> <?php echo $o->get('nomProduit') ?>  </h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <?php echo substr($o->get('description'), 0, 40) . "..."; ?>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                        Modifier le produit
                    </a>
                </div>
                <div class="mdl-card__menu">
                    <a href="?action=delete&id=<?php echo $id; ?>&type=produit&controller=admin"><i class="material-icons">delete</i></a>
                </div>
            </div>

        <?php } ?>
    </div>
<?php }
