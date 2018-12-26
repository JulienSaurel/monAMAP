<h2> Modifiez l'article. </h2>
 <?php 
 $idart = $_GET['idArticle'];
 echo'<form method="post" action="?action=updatedArt&controller=admin&idArticle=' . $idart . '">'; ?>
  <fieldset>
        <p>
      <?php
        $titre = $idp['titreArticle'];
        //var_dump($idp);
        echo '<label for="newtitle">Modifiez le titre :</label><input type="price" id="newtitle" name="newtitle" value="' . $titre . '" required/></label>';
       ?>
    </p>
    <p>
      <?php
        $description = $idp['description'];
        echo '<label for="newdesc" >Modifiez la description :</label><input type="text" id="newdesc" name="newdesc" value="' . $description . '" required/>';
       ?>
    </p>
    <p>
      <?php
        $photo = $idp['photo'];
        echo '<label for="newpic" class="bal">Modifiez la photo :</label><input type="text" id="newpic" name="newpic" value="' . $photo . '" required/>';
       ?>
    </p>

    <p>
      <input type="submit" value="Modifier" />
    </p>

  </fieldset>

</form>