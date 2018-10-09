<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title> formulaireAdherent </title>
    </head>
   
    <body>
      <form method="post" action="./routeur.php?action=created"> 

  <fieldset>
    <legend>Mon formulaire :</legend>
    <p>
      <label for="id_id">Id</label> :
      <input type="text" placeholder="Ex : 2" name="idAdherent" id="id_id" required/>
    </p>
    <p>
      <label for="nom_id">Nom</label> :
      <input type="text" placeholder="Ex : Sambuc" name="nomPersonne" id="nom_id" required/>
    </p> 
    <p>
      <label for="prenom_id">Prenom</label> :
      <input type="text" placeholder="Ex : David" name="prenomPersonne" id="prenom_id" required/>
    </p>
    <p>
      <label for="mail_id">Mail</label> :
      <input type="text" placeholder="Ex : dsambuc@free.fr" name="mailPersonne" id="mail_id" required/>
    </p>
  <p>
      <input type="submit" value="Envoyer" />
    </p>
  </fieldset> 
</form>




    </body>
</html> 