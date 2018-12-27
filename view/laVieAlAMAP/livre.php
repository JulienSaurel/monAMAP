<?php
for ($j=0; $j < sizeof($tab); $j++)
{
    echo '<p>' . $tab[$j]->get('pseudo') . ' a écrit :<br />' . $tab[$j]->get('message') . '</p>';
}

for($i=0; $i<$nombrepages; $i++)
{
    echo " <a href=\"?action=liremessage&controller=LaVieAlAMAP&page={$i}\"> $i </a>";
}

?>