<?php
	for ($j=$page; $j < 5; $j++) 
	{ 
		echo '<p>' . $tab[$j]->get('pseudo') . ' a écrit :<br />' . $tab[$j]->get('message') . '</p>';
	}

?>