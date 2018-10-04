<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title> formulairePersonne </title>
    </head>
   
    <body>
      <form method="post" action="./ControllerPersonne.php">

  <fieldset>
    <legend>Mon formulaire :</legend>
    <p>
      <label for="id_id">Id</label> :
      <input type="text" placeholder="Ex : 2" name="Id" id="id_id" required/>
    </p>
    <p>
      <label for="nom_id">Nom</label> :
      <input type="text" placeholder="Ex : Sambuc" name="Nom" id="nom_id" required/>
    </p> 
    <p>
      <label for="prenom_id">Prenom</label> :
      <input type="text" placeholder="Ex : David" name="Prenom" id="prenom_id" required/>
    </p>
    <p>
      <label for="mail_id">mail</label> :
      <input type="text" placeholder="Ex : dsambuc@free.fr" name="mail" id="mail_id" required/>
    </p>
    <p>
      <input type="submit" value="Envoyer" />
    </p>
  </fieldset> 
</form>


    </body>
</html> 