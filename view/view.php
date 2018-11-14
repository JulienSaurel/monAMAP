<!DOCTYPE html>
<html>
    <head>
       	<link rel="stylesheet" type="text/css" href="css/styles.css">
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
    
    </head>
    <header>
    	 <?php require File::build_path(array("view", "menu.php")); ?>
    </header>
    	<body>
   

<?php

$filepath = File::build_path(array("view", $controller, "$view.php"));
require $filepath;

?>
    </body>
    <footer>
       <?php require File::build_path(array("view","footer.php")); ?>
    </footer>
</html>

