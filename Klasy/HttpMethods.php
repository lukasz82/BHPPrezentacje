<?php
	// Funkcja inicjujaca zmienne metody GET i POST i innych, żeby nie robić śmietnika w kodzie
    public function InitVariables()
	{	
		// Zmienna wyznaczająca start filmu
		if (isset($_GET['start'])) 
		{
        	$_GET['start'];
    	} 

    	// Zmienna wyznaczająca koniec wyświetlania filmu
    	if (isset($_GET['stop'])) 
		{
        	$_GET['stop'];
    	} 

    	// Zmienna wskazująca id filmu
    	if (isset($_GET['mov_id'])) 
		{
        	$_GET['mov_id'];
    	} 
	} 
?>