<h1> Nos articles </h1>

<?php  if (isset($_SESSION['login'])) { //seuls les adhérents connectés peuvent écrire de nouveaux articles ?> 
        <li>
          <a href="?action=createArt&controller=LaVieAlAMAP">Ecrivez un nouvel article</a>
      </li>
<?php }
?>
<?php
foreach ($tabArticles as $art) { // pour chaque article de la base de données, on affiche ses infos
    //var_dump($art);
	$a = ModelPersonne::select($art->get("mailPersonne"));
	$prenom = $a->get('prenomPersonne');
	$nom = $a->get('nomPersonne');
	$date = $art->get('date');
	echo '<div class="article"><h2>' . $art->get('titreArticle') . '</h2><img src="' . $art->get('photo') . '" alt="' . $art->get('idArticle') . '"/><p>' . $art->get('description') . '</p><p>Ecrit par : ' . $prenom . ' ' . $nom . ', Le :' . $date . ' </p></div>';

}
?>

