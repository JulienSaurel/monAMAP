<form method="post" action="?action=setrole&controller=admin">
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
                <a href="?action=gotoupdate&controller=admin&type=adherent&id=<?php echo urlencode($id); ?>"><?php echo "$nom $prenom";?></a>
            </td>
            <td>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="<?php echo "AdminProdProd?$i"; ?>">
                    <input type="checkbox" name="AdminProdProd?<?php echo $i;?>" id="<?php echo "AdminProdProd?$i"; ?>" class="mdl-checkbox__input" <?php echo $checkedprod;?>>
                </label></td>
            <td>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="<?php echo  "AdminProdAdmin?$i"; ?>">
                    <input type="checkbox" name="AdminProdAdmin?<?php echo $i;?>" id="<?php echo "AdminProdAdmin?$i"; ?>" class="mdl-checkbox__input" <?php echo $checkedadmin;?>>
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
                <a href="?action=gotoupdate&controller=admin&type=adherent&id=<?php echo urlencode($id); ?>"><?php echo "$nom $prenom";?></a>
            </td>
            <td>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="<?php echo "AdminProd?$i"; ?>">
                    <input type="checkbox" name="AdminProd?<?php echo $i;?>" id="<?php echo "AdminProd?$i"; ?>" class="mdl-checkbox__input" <?php echo $checkedprod;?>>
                </label></td>
            <td>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="<?php echo "AdminAdmin?$i"; ?>">
                    <input type="checkbox" name="AdminAdmin?<?php echo $i;?>" id="<?php echo "AdminAdmin?$i"; ?>" class="mdl-checkbox__input" <?php echo $checkedadmin;?>>
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
                <a href="?action=gotoupdate&controller=admin&type=adherent&id=<?php echo urlencode($id); ?>"><?php echo "$nom $prenom";?></a>
            </td>
            <td>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="<?php echo "ProdProd?$i"; ?>">
                    <input type="checkbox" name="ProdProd?<?php echo $i;?>" id="<?php echo "ProdProd?$i"; ?>" class="mdl-checkbox__input" <?php echo $checkedprod;?>>
                </label></td>
            <td>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="<?php echo "ProdAdmin?$i"; ?>">
                    <input type="checkbox" name="ProdAdmin?<?php echo $i;?>" id="<?php echo "ProdAdmin?$i"; ?>" class="mdl-checkbox__input" <?php echo $checkedadmin;?>>
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
                <a href="?action=gotoupdate&controller=admin&type=adherent&id=<?php echo urlencode($id); ?>"><?php echo "$nom $prenom";?></a>
            </td>
            <td>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="<?php echo "NoneProd?$i"; ?>">
                    <input type="checkbox" name="NoneProd?<?php echo $i;?>" id="<?php echo "NoneProd?$i"; ?>" class="mdl-checkbox__input" <?php echo $checkedprod;?>>
                </label></td>
            <td>
                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="<?php echo "NoneAdmin?$i"; ?>">
                    <input type="checkbox" name="NoneAdmin?<?php echo $i;?>" id="<?php echo "NoneAdmin?$i"; ?>" class="mdl-checkbox__input" <?php echo $checkedadmin;?>>
                </label>
            </td>
        </tr>

        <?php $i++; } ?>

    </tbody>
</table>
<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit">
    Enregistrer
</button>
</form>