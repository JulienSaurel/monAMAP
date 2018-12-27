<h1 class="titlet">Paiement</h1>
 <form <form id="paiement"> <!-- action = "?action=buy&controller=commande" > -->
<li>
Finalisez votre commande en payant la cotisation
</li>


<!--Champs pour le choix du type de carte-->
        <fieldset>
            <li>
              <input  name=type_de_carte type=radio>
              <label for=visa>VISA</label>
            </li>
            <li>
              <input name=type_de_carte type=radio>
              <label for=amex>AmEx</label>
            </li>
            <li>
              <input name=type_de_carte type=radio>
              <label for=mastercard>Mastercard</label>
            </li>
        </fieldset>

<!--Champs du choix du montant de la cotisation-->
<!--Ajouter "minimum 10€"-->
      <fieldset>
      <p>
          <label for="montant">Montant à donner (en euro) :</label> 
          <input type="number" placeholder="Ex : 5" name=montant" id="montant" required/>
      </p>
      <p>
          <label for="nom_id">N° de carte :</label>
          <input type="text" placeholder="Ex : xxxx-xxxx-xxxx-xxxx" name="nom" id="nom" required/>
      </p>
      <p>
          <label for="prenom_id">Cryptogramme :</label>
          <input type="text" placeholder="Ex : 123" name="prenom" id="prenom" required/>
      </p>
      <p>
          <label for="mail_id">Nom inscrit sur la carte :</label>
          <input type="text" placeholder="Ex : Mabrouk" name="email" id="email" required/>
      </p>
  </fieldset>
</form>
<!--Pas encore connecté-->
<a href="?action=created&controller=adherent">Fini !</a>
