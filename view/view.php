<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
    </head>
<!-- <?php require File::build_path(array("view", "menu.php")); ?> -->
    <body>
<?php

$filepath = File::build_path(array("view", $controller, "$view.php"));
require $filepath;

?>
    </body>
</html>

