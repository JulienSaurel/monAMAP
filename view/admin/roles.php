<ul class="demo-list-icon mdl-list">
    <?php  $i=1; foreach (ModelAdherent::selectAll() as $o) {
        $id = $o->get('idAdherent');
        $p = ModelPersonne::select($o->get('mailPersonne'));?>
        <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">people</i>
                                <a href="?action=read&id=<?php echo urlencode($id); ?>&type=adherent&controller=admin"><?php echo htmlspecialchars($p->get('prenomPersonne')) . " " . htmlspecialchars($p->get('nomPersonne')); ?></a>
                            </span>
            <span class="mdl-list__item-secondary-content">
                                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-<?php echo $i;?>">
                                <input type="checkbox" id="switch-<?php echo $i;?>" class="mdl-switch__input">
                                <span class="mdl-switch__label">Administrateur</span>
                                </label>
                            </span>
            <span class="mdl-list__item-secondary-content">
                                <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="switch-<?php echo 1000000-$i;?>">
                                <input type="checkbox" id="switch-<?php echo 1000000-$i;?>" class="mdl-switch__input">
                                <span class="mdl-switch__label">Producteur</span>
                                </label>
                            </span>

        </li>

        <?php $i++; } ?>
</ul>