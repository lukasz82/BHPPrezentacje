<?php 
// Pliki źródłowe
readfile ('Layouts/naglowek.html');
require('Classes/DataBase/DataBase.php');
require('Classes/sessions.php');
require('Classes/UploadMethods.php');
require('Classes/Buttons.php');
include('Functions/InitVariables.php');

// Inicjacje klas i konstruktorów
DataBase::InitializeDB();

$Delete_Button = new Buttons('Usuń','movie_arr_id','','submit','60px','40px','#004080','white','#a3c2c2','');
$Accept_Button = new Buttons('Zatwierdź i przejdź dalej','','','submit','150px','40px','#FF4500','white','#a3c2c2','');
$Add_Mov_Button = new Buttons('Dodaj film do listy','movie_name','','submit','150px','40px','#dcedc8','black','','');

$dir = dir('Movies');
session_start();
?>

<div class="col-md-6 sidenav">
	<?php
	$count = -2; // Nie wiem dlaczego dwie petle przechodzą bez wykonania instrukcji
		while($file = $dir->read())
		{
			if($file != '.' && $file != '..')
			{ 
				echo '<div class="col-sm-3 text-center">';
					echo '<div style="height:5px; background-color: #234567;"></div><p style="background-color: #234567; color:white; margin: 0cm 0cm 0cm 0cm; padding: 0cm 0cm 0cm 0cm;" id="'.$file.'" value='.$count.' >'.$file.'</p><div style="height:5px; background-color: #234567;"></div>';
						echo '<div id = "Film'.$count.'">Movies</div>';
						echo '<form action="PanelDodawaniaFilmow.php" method="GET">
						<input type="hidden" name="mov_dir" value="'.$file.'">';
						$Add_Mov_Button->Show_witch_line_and_value($count);
						echo '</form>';
				echo '</div>';
			}
			$count++;
		}
	$dir->close();
	?>
</div>

<div class="col-md-3">
	<?php

		// Deklaracja obiektów klas
		$movie_name = new UploadMethods;
		$movie_arr_id = new UploadMethods;
		$movie_dir = new UploadMethods;
		$movie_array = new Sessions;
		$movie_array_dir = new Sessions;
			
		// Z tej zmiennej będę odczytywał wartość z przycisku "button"
		$movie_name->getInit('movie_name');
		$movie_arr_id->getInit('movie_arr_id');
		$movie_arr_id->getInit('movie_arr_dir');
		$movie_dir->getInit('mov_dir');
		//$movie_array->set('tab_filmow',0);

		if ( ($movie_arr_id->get('movie_arr_id') != NULL) )
		{
			// Usuwam z tymczasowej tablicy Movies, które mi są niepotrzebne
			//array_splice($_SESSION['tablica'], $movie_id, 1 );
			$movie_array->drop('tab_filmow',$movie_arr_id->get('movie_arr_id'));
			// Może się wydawać dziwne ale splice dziala tylko na kluczach typu int, dlatego odwoluje sie do movie_ar_id
			$movie_array_dir->drop('mov_arr_dir',$movie_arr_id->get('movie_arr_id'));
			//Zabieram dostęp do tablicy
			$check = false;
		}

		//echo 'Check status: '. $movie_name->check_status.' </br>';

		// Sprawdzam czy wystapio zdarzenie GET i dodaje do bazy danych infomracje
		if ($movie_name->get('movie_name') != "")
		{
			try
			{
				$movie_array->putArr('tab_filmow',$movie_name->get('movie_name'));
				$movie_array_dir->putArr('mov_arr_dir',$movie_name->get('mov_dir'));
			} 
			catch(Exception $e)
			{
				echo $e->getMessage();
			}
		}

		if ($check)
		{
			// W tej tablicy zapisane są tablice 'start', 'stop' i id dodanego filmu
			$movie_duration = array ("start"=>$_GET['start'], "stop"=>$_GET['stop'], "mov_id"=>$_GET['mov_id'], "mov_dir"=>$_GET['mov_dir']);
			
			//Przekazuję tablicę movie_durration do 
			if (!isset($_SESSION['movie_details'])) $_SESSION['movie_details'] = array();
			$_SESSION['movie_details'] = $movie_duration;
 			$tcount = count($_GET['start']);

			$is_ok = true;
			for ($i = 0; $i < $tcount; $i++)
			{
				$mov_start_copy = $movie_duration['start'][$i];
				$mov_stop_copy = $movie_duration['stop'][$i];

		    	for ($j = 0; $j < $tcount; $j++)
		    	{
					if ($j != $i)
		    		{
		    			// Warunki walidujące wpidane daty
						if (($mov_start_copy >= $movie_duration['start'][$j] && $mov_stop_copy <= $movie_duration['stop'][$j]) || ($mov_start_copy > $mov_stop_copy) || $mov_start_copy == "" || $mov_stop_copy == "")
		    			{
		    				$is_ok = false;
		    			}
		    		}
		    	}
				echo '</br>';
		    }
		    
		    if ($is_ok == true)
		    {
			    for ($i = 0; $i < $tcount; $i++)
			    {
			    	echo 'Film nr. '.$i.': </br>';
			    	echo 'Start: '.$movie_duration['start'][$i].'</br>';
			    	echo 'Stop: '.$movie_duration['stop'][$i].'</br>';
			    	echo 'Id Filmu: '.$movie_duration['mov_id'][$i].'</br>';
			    	echo 'ścieżka: '.$movie_duration['mov_dir'][$i].'</br>';
			    	echo '</br>';
			    }

			    echo '<form action="AddEventToDB.php" method="POST">';
				$Accept_Button->Show();
			    echo '</form>';
			} else 
			{
				echo '<font color="red">Blad przy wypelnianiu formularza, wystąpil jeden z poniższych bledow: </br> - Daty nakadają się na siebie</br> - Godzina rozpoczecia jest później niż godzina zakończenia filmu</br> - Wymagane pola są puste</br> - Wystąpil inny blad </font> </br>Proszę poprawić';
			}
		}

		$arr_count = $movie_array->count('tab_filmow');
    	//echo "</br>Ilość elementów w tablicy".$arr_count.'</br>';
    
    	echo '<div class="col-sm-3">'; 
		echo '<form action="PanelDodawaniaFilmow.php" method="GET">';
		for ($i = 0; $i < $arr_count; $i++)
		{
			echo '<input type="hidden" name="mov_dir[]" value="'.$movie_array_dir->getArr('mov_arr_dir',$i).'">';
			
		 	echo '<div class="col-sm-2 col-sm-offset-0 text-center">'; 
		    	echo '<div style="height:5px;"></div>';
					echo "Film nr: ".$movie_array->getArr('tab_filmow',$i)." o nazwie ".$movie_array_dir->getArr('mov_arr_dir',$i);
				echo '<div style="height:5px;"></div>';
		    echo '</div>';

    		echo '<div class="col-sm-2 col-sm-offset-1 text-center">'; 
    			echo '<div style="height:5px;"></div>';
					echo '<div class="form-group">';

						// -----------------------------------------------------------
						//	Wczytuje zapamiętane wartości wpisane przez użytkownika
						// -----------------------------------------------------------
						echo '<label for="godzr">Godz. rozpoczecia: </label>';
						if ($check)
						{
							echo '<input type="time" name="start[]" value="'.$movie_duration['start'][$i].'" class="form-control">';
						} else 
						{
							echo '<input type="time" name="start[]" class="form-control">';
						}
						
						echo '<label for="godzz">Godz. zakończenia: </label>';
						if ($check)
						{
							echo '<input type="time" name="stop[]" value="'.$movie_duration['stop'][$i].'" class="form-control">';
						} else 
						{
							echo '<input type="time" name="stop[]" class="form-control">';
						}
						echo '<input type="hidden" name="mov_id[]" value="'.$movie_array->getArr('tab_filmow',$i).'" class="form-control">';
						
					echo '</div>';
				echo '<div style="height:5px;"></div>';
    		echo '</div>';

	    	echo '<div class="col-sm-1 col-sm-offset-0 text-center">'; 
	    		echo '<div style="height:5px;"></div>';
					$Delete_Button->Show_witch_value($i);
				echo '<div style="height:5px;"></div>';
	    	echo '</div>';
		}
		echo '</div>';
		    echo '<div class="col-sm-2 col-sm-offset-0 text-center">'; 
				echo '<div style="height:5px;"></div>';
				echo '<button type="submit" class="btn btn-info btn-sm" style="width:100px; height:40px; background-color: #DD3333; color:white; border-color: #a3c2c2;">
						Zatwierdź
					</button>';
					//echo '</form>';
				echo '<div style="height:5px;"></div>';
			echo '</div>';
	    echo '</form>';
    ?>
	</br>
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

	for (var i = 0; i<count; i++)
	{
		document.getElementById('Film'+i).innerHTML = '<video width="250" height="150" controls><source src="Movies/'+x[i]+'" type="video/mp4">Your browser does not support the video tag.</video>';
	}
</script>

<?php readfile ('Layouts/stopka.html');?> 