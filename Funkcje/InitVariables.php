<?php
		// Zmienna wyznaczająca start filmu

        $check = false;

		if (isset($_GET['start'])) 
		{
        	$_GET['start'];
            $check = true;
    	} 

    	// Zmienna wyznaczająca koniec wyświetlania filmu
    	if (isset($_GET['stop'])) 
		{
        	$stop = $_GET['stop'];
            $check = true;
    	} 

    	// Zmienna wskazująca id filmu
    	if (isset($_GET['mov_id'])) 
		{
        	$mov_id = $_GET['mov_id'];
            $check = true;
    	} 

?>