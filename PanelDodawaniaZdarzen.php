<?php 
// Pliki źródłowe
readfile ('Layouty/naglowek.html');
require('./Klasy/BazaDanych/DataBase.php');
require('./Klasy/sessions.php');
// Inicjacje klas i konstruktorów
DataBase::InitializeDB();
session_start();
?>
<div class="row"> 
	<div class="col-sm-4 col-sm-offset-1">
		

<?php

	var_dump($_SESSION['movie_details']);
	$movie_duration = $_SESSION['movie_details'];

    // Wylistuje sobię tablice z powyzej, czyli dodane czasy trwania filmów do tablicy gównej
    $tcount = count($movie_duration['start']);
    echo 'Ilosc filmow: '.$tcount.'</br>';
    for ($i = 0; $i < $tcount; $i++)
    {
    	echo 'Film nr. '.$i.': </br>';
    	echo 'Start: '.$movie_duration['start'][$i].'</br>';
    	echo 'Stop: '.$movie_duration['stop'][$i].'</br>';
    	echo 'Id Filmu: '.$movie_duration['mov_id'][$i].'</br>';
    	echo '</br>';
    }
?>
	</div>
</div>

<?php readfile ('Layouty/stopka.html');?> 