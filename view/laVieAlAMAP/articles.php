<h1> Nos articles </h1>

<?php  if (isset($_SESSION['login'])) { //seuls les adhérents connectés peuvent écrire de nouveaux articles ?>
    <li>
        <a href="?action=createArt&controller=LaVieAlAMAP">Ecrivez un nouvel article</a>
    </li>
<?php }
?>
<?php
$i=1;
foreach ($tabArticles as $art) {
    // pour chaque article de la base de données, on affiche ses infos
    //var_dump($art);
    $a = ModelPersonne::select($art->get("mailPersonne"));
    $prenom = htmlspecialchars($a->get('prenomPersonne')) ?? "";
    $nom = htmlspecialchars($a->get('nomPersonne')) ?? "";
    $date = htmlspecialchars($art->get('date'));
    $titreArticle = htmlspecialchars($art->get('titreArticle'));
    $photo = htmlspecialchars($art->get('photo'));
    $idArticle = htmlspecialchars($art->get('idArticle'));
    $description = htmlspecialchars($art->get('description'));?>

    <div id="target<?php echo $i;?>" class="article">
       <?php echo "<h2>  $titreArticle <button class='bouton' id=\"sourceplus$i\" onclick='Extend(\"target$i\", $i)'>+</button> <button class='bouton' id=\"sourcemoins$i\" onclick='Reduce(\"target$i\", $i);'>-</button> </h2>       
<img class=\"imgArt\" src=\"$photo\" alt=\"$idArticle\"/><p>$description</p><p>Ecrit par : $prenom $nom, Le : $date</p>" ?>
    </div>


    <?php $i++; } ?>
