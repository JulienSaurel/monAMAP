<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title> formulairePersonne </title>
    </head>
   
    <body>
      <form method="post" action="./?actionP=created"> 
 <!-- On recupere les infos avec la methode post et on redirige vers la sauvegarde dans la base de donnees -->
  <fieldset>
    <legend>Mon formulaire :</legend>
    <p>
      <label for="id_id">Id</label> :
      <input type="text" placeholder="Ex : 2" name="idPersonne" id="id_id" required/>
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
<!--           	    <input type='hidden' name='action' value='created'> 
 -->    <p>
      <input type="submit" value="Envoyer" />
    </p>
  </fieldset> 
</form>




    </body>
</html> 