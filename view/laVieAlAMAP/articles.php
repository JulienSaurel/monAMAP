<h1> Nos articles </h1>

<?php 
foreach ($tabArticles as $art) {
	$tabec = ModelPersonne::select($art["idPersonne"]);
	//var_dump($tabec->get('prenomPersonne'));
	echo "<div class=\"article\">";
	echo "<h2> ".$art['titreArticle']."</h2>";
	$image = "<img src=". $art['photo']." alt=\" article \" >"; 
	echo $image;

	echo "<p> ".$art['description']."</p><br>";
	echo "<p> Ecrit par : ".$tabec->get('prenomPersonne')." ".$tabec->get('nomPersonne')."</p>";
	echo "<p> Le : ". $art['date']."</p>";
	echo "</div>";
}
?>