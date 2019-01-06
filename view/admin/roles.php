<table class="mdl-data-table mdl-data-table--selectable mdl-shadow--2dp">
    <thead>
    <tr>
        <th class="mdl-data-table__cell--non-numeric">Adhérent</th>
        <th class="mdl-data-table--selectable">Producteur</th>
        <th class="mdl-data-table--selectable">Administrateur</th>
    </tr>
    </thead>
    <tbody>
    <thead>
    <tr>
        <th class="mdl-data-table__cell--non-numeric">Administrateurs Producteurs</th>
    </tr>
    </thead>
    <?php  $i=1; foreach ($tabAdminProd as $o) {
        $id = $o->get('idAdherent');
        $p = ModelPersonne::select($o->get('mailPersonne'));
        $checkedadmin = ($o->get('estAdministrateur')==1) ? 'checked':'';
        $checkedprod = ($o->get('estProducteur')==1) ? 'checked':'';
        $nom = htmlspecialchars($p->get('nomPersonne'));
        $prenom = htmlspecialchars($p->get('prenomPersonne'));?>
        <tr>
            <td class="mdl-data-table__cell--non-numeric">
                <?php echo "$nom $prenom";?>
            </td>
            <td>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="<?php echo $i; ?>">
                    <input type="checkbox" id="<?php echo $i; ?>" class="mdl-checkbox__input" <?php echo $checkedprod;?>>
                </label></td>
            <td>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="<?php echo 10000000*$i; ?>">
                    <input type="checkbox" id="<?php echo 10000000*$i; ?>" class="mdl-checkbox__input" <?php echo $checkedadmin;?>>
                </label>
            </td>
        </tr>

        <?php $i++; } ?>

    <tr>
        <th class="mdl-data-table__cell--non-numeric">Administrateurs Non Producteurs</th>
    </tr>
    </thead>
    <?php  $i=1; foreach ($tabAdminNotProd as $o) {
        $id = $o->get('idAdherent');
        $p = ModelPersonne::select($o->get('mailPersonne'));
        $checkedadmin = ($o->get('estAdministrateur')==1) ? 'checked':'';
        $checkedprod = ($o->get('estProducteur')==1) ? 'checked':'';
        $nom = htmlspecialchars($p->get('nomPersonne'));
        $prenom = htmlspecialchars($p->get('prenomPersonne'));?>
        <tr>
            <td class="mdl-data-table__cell--non-numeric">
                <?php echo "$nom $prenom";?>
            </td>
            <td>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="<?php echo $i; ?>">
                    <input type="checkbox" id="<?php echo $i; ?>" class="mdl-checkbox__input" <?php echo $checkedprod;?>>
                </label></td>
            <td>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="<?php echo 10000000*$i; ?>">
                    <input type="checkbox" id="<?php echo 10000000*$i; ?>" class="mdl-checkbox__input" <?php echo $checkedadmin;?>>
                </label>
            </td>
        </tr>

        <?php $i++; } ?>

    <tr>
        <th class="mdl-data-table__cell--non-numeric">Producteurs Non Administrateurs</th>
    </tr>
    </thead>
    <?php  $i=1; foreach ($tabProdNotAdmin as $o) {
        $id = $o->get('idAdherent');
        $p = ModelPersonne::select($o->get('mailPersonne'));
        $checkedadmin = ($o->get('estAdministrateur')==1) ? 'checked':'';
        $checkedprod = ($o->get('estProducteur')==1) ? 'checked':'';
        $nom = htmlspecialchars($p->get('nomPersonne'));
        $prenom = htmlspecialchars($p->get('prenomPersonne'));?>
        <tr>
            <td class="mdl-data-table__cell--non-numeric">
                <?php echo "$nom $prenom";?>
            </td>
            <td>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="<?php echo $i; ?>">
                    <input type="checkbox" id="<?php echo $i; ?>" class="mdl-checkbox__input" <?php echo $checkedprod;?>>
                </label></td>
            <td>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="<?php echo 10000000*$i; ?>">
                    <input type="checkbox" id="<?php echo 10000000*$i; ?>" class="mdl-checkbox__input" <?php echo $checkedadmin;?>>
                </label>
            </td>
        </tr>

        <?php $i++; } ?>

    <tr>
        <th class="mdl-data-table__cell--non-numeric">Simples Adhérents</th>
    </tr>
    </thead>
    <?php  $i=1; foreach ($tabAdherentsOnly as $o) {
        $id = $o->get('idAdherent');
        $p = ModelPersonne::select($o->get('mailPersonne'));
        $checkedadmin = ($o->get('estAdministrateur')==1) ? 'checked':'';
        $checkedprod = ($o->get('estProducteur')==1) ? 'checked':'';
        $nom = htmlspecialchars($p->get('nomPersonne'));
        $prenom = htmlspecialchars($p->get('prenomPersonne'));?>
        <tr>
            <td class="mdl-data-table__cell--non-numeric">
                <?php echo "$nom $prenom";?>
            </td>
            <td>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="<?php echo $i; ?>">
                    <input type="checkbox" id="<?php echo $i; ?>" class="mdl-checkbox__input" <?php echo $checkedprod;?>>
                </label></td>
            <td>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="<?php echo 10000000*$i; ?>">
                    <input type="checkbox" id="<?php echo 10000000*$i; ?>" class="mdl-checkbox__input" <?php echo $checkedadmin;?>>
                </label>
            </td>
        </tr>

        <?php $i++; } ?>

    </tbody>
</table>
<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
    Enregistrer
</button>