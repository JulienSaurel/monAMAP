<!DOCTYPE html>
<html>
    <head>
       	<link rel="stylesheet" type="text/css" href="css/styles.css">
        <script src="script/script.js"></script>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
    
    </head>
    
    	<body>
        <header>
         <?php require File::build_path(array("view", "menu.php")); ?>
        </header>
            <main>
   

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

