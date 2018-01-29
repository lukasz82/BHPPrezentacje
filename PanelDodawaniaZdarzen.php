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
		<div class="form-group">
			<form action="PanelDodawaniaZdarzen.php" method="GET"> 
				<!--<input type="hidden" name="MAX_FILE_SIZE" value="10000000000" />  
				<input name="plik" type="file" id="file" /> 
				<input type="submit" value="Wyślij plik" name="submit" /> -->

				<label for="godzr">Godz. rozpoczecia: </label>
				<input type="time" name="start[]" class="form-control">
				<input type="time" name="start[]" class="form-control">
				<button type="submit" class="btn btn-info btn-sm" style="width:100px; height:40px; background-color: #DD3333; color:white; border-color: #a3c2c2;">
				Zatwierdź
				</button>

			</form> 
		</div>



		<?php
	
		// W tej tablicy będę zapisywał tymczasowy wybór filmów, który później będzie
	    // zapisywany do bazy danych
		if (isset($_GET['start'])) 
		{
        	$_GET['start'];
    	} 

			echo var_dump($_GET['start'][0]);
			echo var_dump($_GET['start'][1]);
			echo $_GET['start'];




		?>
	</div>
</div>

<?php readfile ('Layouty/stopka.html');?> 