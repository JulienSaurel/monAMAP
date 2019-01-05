<!-- Simple header with fixed tabs. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header
            mdl-layout--fixed-tabs">
    <header class="mdl-layout__header">


        <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
            <a href="#fixed-tab-1" class="mdl-layout__tab is-active">Producteurs</a>
            <a href="#fixed-tab-2" class="mdl-layout__tab">Articles</a>
            <a href="#fixed-tab-3" class="mdl-layout__tab">Messages</a>
        </div>
    </header>
    <main class="mdl-layout__content">
        <section class="mdl-layout__tab-panel is-active" id="fixed-tab-1">
            <div class="page-content">
                    <ul class="demo-list-icon mdl-list">
                        <?php  $i=1; foreach (ModelAdherent::selectAllToValid() as $o) {
                            $id = $o->get('idAdherent');
                            $p = ModelPersonne::select($o->get('mailPersonne'));?>
                            <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">person</i>
                                <a href="?action=gotoupdate&id=<?php echo urlencode($id); ?>&type=adherent&controller=admin"><?php echo htmlspecialchars($p->get('prenomPersonne')) . " " . htmlspecialchars($p->get('nomPersonne')); ?></a>
                            </span>
                                <span class="mdl-list__item-secondary-content">
                                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-<?php echo $i;?>">
                                <input type="checkbox" id="switch-<?php echo $i;?>" class="mdl-switch__input">
                                <span class="mdl-switch__label">Valider le producteur</span>
                                </label>
                            </li>

                            <?php $i++; } ?>
                    </ul>
                <button class="mdl-button mdl-js-button mdl-button--raised">
                    Enregistrer
                </button>
            </div>
        </section>
        <section class="mdl-layout__tab-panel" id="fixed-tab-2">
            <div class="page-content">
                <ul class="demo-list-icon mdl-list">
                    <?php  $i=1; foreach (ModelArticle::selectAllToValid() as $o) {
                        $id = $o->get('idArticle');?>
                        <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">art_track</i>
                                <a href="?action=gotoupdate&id=<?php echo urlencode($id); ?>&type=article&controller=admin"><?php echo htmlspecialchars($o->get('titreArticle')); ?></a>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-<?php echo $i;?>">
                                <input type="checkbox" id="switch-<?php echo $i;?>" class="mdl-switch__input">
                                <span class="mdl-switch__label">Valider l'article</span>
                                </label>
                        </li>

                        <?php $i++; } ?>
                </ul>
                <button class="mdl-button mdl-js-button mdl-button--raised">
                    Enregistrer
                </button>
            </div>
        </section>
        <section class="mdl-layout__tab-panel" id="fixed-tab-3">
            <div class="page-content">
                <ul class="demo-list-icon mdl-list">
                    <?php  $i=1; foreach (ModelLivreDor::selectAllToValid() as $o) {
                        $id = $o->get('id_message');?>
                        <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">forum</i>
                                <a href="?action=gotoupdate&id=<?php echo urlencode($id); ?>&type=livreDor&controller=admin"><?php echo htmlspecialchars($o->get('pseudo')); ?></a>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-<?php echo $i;?>">
                                <input type="checkbox" id="switch-<?php echo $i;?>" class="mdl-switch__input">
                                <span class="mdl-switch__label">Valider le message</span>
                                </label>
                        </li>

                        <?php $i++; } ?>
                </ul>
                <button class="mdl-button mdl-js-button mdl-button--raised">
                    Enregistrer
                </button>
            </div>
        </section>
    </main>
</div>