<h1 class="titlet">Paiement</h1>
<form method="post" id="paiement" action="?action=extendSubscription&controller=adherent&id=<?php echo$idUrl;?>">
    <!--Champs pour le choix du type de carte-->
    <fieldset>
        <legend>Type de Carte:</legend>
        <select name="cardtype" id="cardtype" required>
            <option selected>VISA</option>
            <option>AmEx</option>
            <option>Mastercard</option>
        </select>
    </fieldset>

    <!--Champs du choix du montant de la cotisation-->
    <!--Ajouter "minimum 20€"-->
    <fieldset>
        <legend>Paiement:</legend>
        <p>
            <label for="duration">Durée de l'adhésion:</label>
            <select onchange="RefreshSubscriptionPrice()" name="duration" id="duration" required>
                <option value="6">6 mois</option>
                <option value="12" selected>1 an</option>
                <option value="24">2 ans</option>
            </select>
            <label id="pricemin">Prix Minimum: 18 €</label>
        </p>


        <p>
            <label for="montant">Montant:</label>
            <input type="number" min="18" value="18" name="total" id="total" required/>
        </p>

        <p>
            <label for="mail_id">Nom du titulaire de la carte :</label>
            <input type="text" placeholder="Ex : Mabrouk" name="email" id="email" required/>
        </p>

        <p>
            <label for="nom_id">N° de carte :</label>
            <input type="text" placeholder="Ex : xxxx-xxxx-xxxx-xxxx" name="nom" id="nom" required/>
        </p>

        <p>
            <label for="prenom_id">Cryptogramme Visuel:</label>
            <input type="text" placeholder="Ex : 123" name="prenom" id="prenom" required/>
        </p>
        <p>
            <input type="submit" value="Finaliser mon adhésion">
        </p>
    </fieldset>
</form>
