<h1> Nos articles </h1>

<?php  if (isset($_SESSION['login'])) { ?>
        <li>
          <a href="?action=createArt&controller=LaVieAlAMAP">Ecrivez un nouvel article</a>
      </li>
<?php }
?>
<?php 
//var_dump($tabArticles);
foreach ($tabArticles as $art) {
	echo '<div class="article"><h2>' . $art['titreArticle'] . '</h2><img src="' . $art['photo'] . '" alt="' . $art['idArticle'] . '"/><p>' . $art['description'] . '</p></div>'; 

	//$tabec = ModelPersonne::select($art["idPersonne"]);
	//var_dump($tabec->get('prenomPersonne'));
	// echo "<div class=\"article\">";
	// echo "<h2> ".$art['titreArticle']."</h2>";
	// $image = "<img src=". $art['photo']." alt=\" article \" >"; 
	// echo $image;

	// echo "<p> ".$art['description']."</p><br>";
	// echo "<p> Ecrit par : ".$tabec->get('prenomPersonne')." ".$tabec->get('nomPersonne')."</p>";
	// echo "<p> Le : ". $art['date']."</p>";
	// echo "</div>";
}
?>

