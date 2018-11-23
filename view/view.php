<!DOCTYPE html>
<html>
    <head>  
        <link rel="icon" type="image/png" href="images/nature.png" />
       	<link rel="stylesheet" type="text/css" href="css/styles.css">
        <script src="script/jquery.min.js"></script>
        <script src="script/script.js"></script>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
    
    </head>
    
    	<body>
        <header>
            <img class="banniere" src="images/ban-accueil.jpg" alt="Article 1" width="135" height="135"/>
         <?php require File::build_path(array("view", "menu.php")); ?>
        </header>

            <main onclick="closeNav()">
   

<?php

$filepath = File::build_path(array("view", static::$object, "$view.php"));
require $filepath;

?>
    </main>
    </body>
    <footer>
       <?php require File::build_path(array("view","footer.php")); ?>
    </footer>
</html>

