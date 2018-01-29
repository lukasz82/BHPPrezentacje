<?php 
// Pliki źródłowe
readfile ('Layouty/naglowek.html');
require('./Klasy/BazaDanych/DataBase.php');
require('./Klasy/sessions.php');
require('./Klasy/UploadMethods.php');
include('./Funkcje/InitVariables.php');
// Inicjacje klas i konstruktorów
DataBase::InitializeDB();
$dir = dir('Filmy');
session_start();

?>

<div class="row"> 
	<div class="col-sm-8 col-sm-offset-0"></br></br>
	Nagłówek
	</br></br></br>
	<?php

		// Deklaracja obiektów klas
		$movie_name = new UploadMethods;
		$movie_arr_id = new UploadMethods;
		$movie_dir = new UploadMethods;
		$movie_array = new Sessions;
	
		// Z tej zmiennej będę odczytywał wartość z przycisku "button"
    	$movie_name->getInit('movie_name');
    	$movie_arr_id->getInit('movie_arr_id');
    	

    	if ($movie_arr_id->get('movie_arr_id') != NULL)
	    {
    		// Usuwam z tymczasowej tablicy filmy, które mi są niepotrzebne
    		//array_splice($_SESSION['tablica'], $movie_id, 1 );
    		$movie_array->drop('tab_filmow',$movie_arr_id->get('movie_arr_id'));
    		
    		//Zabieram dostęp do tablicy
    		$check = false;
	    }


	    if ($check)
		{
			// W tej tablicy zapisane są tablice 'start', 'stop' i id dodanego filmu
		    $movie_duration = array ("start"=>$_GET['start'], "stop"=>$_GET['stop'], "mov_id"=>$_GET['mov_id']);

		    // Wylistuje sobię tablice z powyzej, czyli dodane czasy trwania filmów do tablicy gównej
		    $tcount = count($_GET['start']);
		    echo 'Ilosc filmow: '.$tcount.'</br>';
		    for ($i = 0; $i < $tcount; $i++)
		    {
		    	echo 'Film nr. '.$i.': </br>';
		    	echo 'Start: '.$movie_duration['start'][$i].'</br>';
		    	echo 'Stop: '.$movie_duration['stop'][$i].'</br>';
		    	echo 'Id Filmu: '.$movie_duration['mov_id'][$i].'</br>';
		    	echo '</br>';
		    }
		}
    	
    	echo 'Check status: '. $movie_name->check_status.' </br>';

    	//if ($movie_name->check_status == true)
    	//{
			if ($movie_name->get('movie_name') != "")
	    	{
	 	 		 try
	    		 {
				    $movie_array->putArr('tab_filmow',$movie_name->get('movie_name'));
				 } 
				 catch(Exception $e)
				 {
				    echo $e->getMessage();
				 }
	    	}

			$arr_count = $movie_array->count('tab_filmow');
    		echo "</br>Ilość elementów w tablicy".$arr_count.'</br>';
    
			echo '<form action="PanelDodawaniaFilmow.php" method="GET">';
		    	for ($i = 0; $i < $arr_count; $i++)
		    	{
		    		echo '<div class="row" text-center style="background-color:#e6eeff; border: 1px solid #FFFFFF;">';

			    		echo '<div class="col-sm-1 col-sm-offset-0 text-center">'; 
			    			echo '<div style="height:5px;"></div>';
							//echo "Film nr: ".$_SESSION['tablica'][$i];
							echo "Film nr: ".$movie_array->getArr('tab_filmow',$i);
							echo '<div style="height:5px;"></div>';
			    		echo '</div>';

			    		echo '<div class="col-sm-1 col-sm-offset-0 text-center">'; 
			    			echo '<div style="height:5px;"></div>';
							echo "i = ".$i;
							echo '<div style="height:5px;"></div>';
			    		echo '</div>';

			    		echo '<div class="col-sm-2 col-sm-offset-0 text-center">'; 
			    			echo '<div style="height:5px;"></div>';
								//echo '<form action="PanelDodawaniaFilmow.php" method="get">';
			    					echo '<div class="form-group">';
										echo '<label for="godzr">Godz. rozpoczecia: </label>';
										echo '<input type="time" name="start[]" class="form-control">';
										echo '<label for="godzz">Godz. zakończenia: </label>';
										echo '<input type="time" name="stop[]"  class="form-control">';
										echo '<input type="hidden" name="mov_id[]" value="'.$movie_array->getArr('tab_filmow',$i).'" class="form-control">';
									echo '</div>';
								//echo '</form>';
							
							echo '<div style="height:5px;"></div>';
			    		echo '</div>';


			    		echo '<div class="col-sm-1 col-sm-offset-0 text-center">'; 
			    			echo '<div style="height:5px;"></div>';
							//echo '	<form action="PanelDodawaniaFilmow.php" method="get">
							echo '			<button name="movie_arr_id" value="'.$i.'" id="push<?php echo $count?>" type="submit" class="btn btn-info btn-sm" style="width:60px; height:40px; background-color: #004080; color:white; border-color: #a3c2c2;">
												Usuń
										</button>';
									//echo '</form>';
							echo '<div style="height:5px;"></div>';
			    		echo '</div>';
		    		echo '</div>';
		     	}
			
			    echo '<div class="col-sm-2 col-sm-offset-0 text-center">'; 
					echo '<div style="height:5px;"></div>';
					echo '<button name="movie_list" value="'.$add_to_database = true.'" id="array" type="submit" class="btn btn-info btn-sm" style="width:100px; height:40px; background-color: #DD3333; color:white; border-color: #a3c2c2;">
									Zatwierdź
							</button>';
						//echo '</form>';
					echo '<div style="height:5px;"></div>';
				echo '</div>';
	     	echo '</form>';

		//}

    ?>
	</br>
	</div><div class="row">
	<div class="col-sm-8 col-sm-offset-0">
		
		<?php

		$count = -2; // Nie wiem dlaczego dwie petle przechodzą bez wykonania instrukcji
  		while($file = $dir->read())
			{
				if($file != '.' && $file != '..')
				{ 
					
					echo '<div class="col-sm-3 col-sm-offset-0 text-center">';
					echo '<div style="height:5px; background-color: #234567;"></div><p style="background-color: #234567; color:white; margin: 0cm 0cm 0cm 0cm; padding: 0cm 0cm 0cm 0cm;" id="'.$file.'" value='.$count.' >'.$file.'</p><div style="height:5px; background-color: #234567;"></div>';
					echo '<div id = "Film'.$count.'">Filmy</div>';
					echo '	<form action="PanelDodawaniaFilmow.php" method="GET">
								<button name="movie_name" value="'.$count.'" id="push<?php echo $count?>" type="submit" class="btn btn-info btn-sm" style="width:150px;line-height: 2;background-color: #dcedc8; color:black;">
									Dodaj film do listy
								</button>
								<input type="hidden" name="movie_dir" value="'.$file.'">
							</form>';
					echo '</div>';
					//echo $count;
				}
				$count++;
			}
		$dir->close();
		?>
		</div>
	</div>
</div>

<script type="text/javascript">
   var count = <?php echo $count ?>;
   var x = [];
   var y = [];
   for (var i = 0; i<count; i++)
   {
    x[i] = document.getElementsByTagName("p")[i].getAttribute("id"); 
    y[i] = document.getElementsByTagName("p")[i].getAttribute("value"); 
    
    console.log(i); 
	}


//setInterval(function() 
//{
	for (var i = 0; i<count; i++)
	{
	document.getElementById('Film'+i).innerHTML =  '<video width="250" height="150" controls><source src="Filmy/'+x[i]+'" type="video/mp4">Your browser does not support the video tag.</video>';
	}
	
//}, 10000);
</script>

<?php readfile ('Layouty/stopka.html');?> 