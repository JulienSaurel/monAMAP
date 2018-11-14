<!DOCTYPE html>
<html>
    <head>
       	<link rel="stylesheet" type="text/css" href="css/styles.css">
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
    
    </head>
    
    	<body>
        <header>
         <?php require File::build_path(array("view", "menu.php")); ?>
        </header>
            <main>
   

<?php

$filepath = File::build_path(array("view", $controller, "$view.php"));
require $filepath;

?>
    </main>
    </body>
</html>

