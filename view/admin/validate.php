<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header
            mdl-layout--fixed-tabs">
    <header class="mdl-layout__header">


        <div class="mdl-layout__tab-bar mdl-js-ripple-effect" id="toextend">
            <a href="#fixed-tab-1" class="mdl-layout__tab is-active"><span class="mdl-badge" data-badge="<?php echo ModelAdherent::countToValid() ?>">Producteurs</span></a>
            <a href="#fixed-tab-2" class="mdl-layout__tab"><span class="mdl-badge" data-badge="<?php echo ModelArticle::countToValid() ?>">Articles</span></a>
            <a href="#fixed-tab-3" class="mdl-layout__tab"><span class="mdl-badge" data-badge="<?php echo ModelLivreDor::countToValid() ?>">Messages</span></a>
        </div>
    </header>
    <main class="mdl-layout__content">
        <section class="mdl-layout__tab-panel is-active" id="fixed-tab-1">
            <div class="page-content">
                <form method="post" action="?action=validatedAll&controller=admin&type=adherent">
                    <fieldset>
                    <ul class="demo-list-icon mdl-list">
                        <?php  $i=1; foreach ($tabAdherents as $o) {
                            $type = 'adherent';
                            $id = $o->get('idAdherent');
                            $p = ModelPersonne::select($o->get('mailPersonne'));?>
                            <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">person</i>
                                <a href="?action=gotoupdate&id=<?php echo urlencode($id); ?>&type=adherent&controller=admin"><?php echo htmlspecialchars($p->get('prenomPersonne')) . " " . htmlspecialchars($p->get('nomPersonne')); ?></a>
                            </span>
                                <span class="mdl-list__item-secondary-content">
                                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="<?php echo "$type-$i";?>">
                                <input type="checkbox" id="<?php echo "$type-$i";?>" name="<?php echo $id ?>" class="mdl-switch__input">
                                <span class="mdl-switch__label">Valider le producteur</span>
                                </label>
                                </span>
                            </li>

                            <?php $i++; } ?>
                    </ul>
                <button class="mdl-button mdl-js-button mdl-button--raised" type="submit">
                    Valider
                </button>
                    </fieldset>
                </form>
            </div>
        </section>
        <section class="mdl-layout__tab-panel" id="fixed-tab-2">
            <div class="page-content">
                <form method="post" action="?action=validatedAll&controller=admin&type=article">
                    <fieldset>
                <ul class="demo-list-icon mdl-list">
                    <?php  $i=1; foreach ($tabArticles as $o) {
                        $type = 'article';
                        $id = $o->get('idArticle');?>
                        <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">art_track</i>
                                <a href="?action=gotoupdate&id=<?php echo urlencode($id); ?>&type=article&controller=admin"><?php echo htmlspecialchars($o->get('titreArticle')); ?></a>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="<?php echo "$type-$i";?>">
                                <input type="checkbox" id="<?php echo "$type-$i";?>" name="<?php echo $id ?>" class="mdl-switch__input">
                                <span class="mdl-switch__label">Valider l'article</span>
                                </label>
                            </span>
                        </li>

                        <?php $i++; } ?>
                </ul>
                <button class="mdl-button mdl-js-button mdl-button--raised" type="submit">
                    Valider
                </button>
                </fieldset>
                </form>
            </div>
        </section>
        <section class="mdl-layout__tab-panel" id="fixed-tab-3">
            <div class="page-content">
                    <form method="post" action="?action=validatedAll&controller=admin&type=livreDor">
                        <fieldset>
                            <ul class="demo-list-icon mdl-list">
                    <?php  $i=1; foreach ($tablivreDor as $o) {
                        $type = 'livreDor';
                        $id = $o->get('id_message');?>
                        <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">forum</i>
                                <a href="?action=gotoupdate&id=<?php echo urlencode($id); ?>&type=livreDor&controller=admin"><?php echo htmlspecialchars($o->get('pseudo')); ?></a>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="<?php echo "$type-$i";?>">
                                <input type="checkbox" id="<?php echo "$type-$i";?>" name="<?php echo $id ?>" class="mdl-switch__input">
                                <span class="mdl-switch__label">Valider le message</span>
                                </label>
                            </span>
                        </li>

                        <?php $i++; } ?>
                </ul>
                <button class="mdl-button mdl-js-button mdl-button--raised" type="submit">
                    Valider
                </button>
                </fieldset>
                </form>
            </div>
        </section>
    </main>
</div>