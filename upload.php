<?php 
// Pliki źródłowe
readfile ('Layouty/naglowek.html');
require('./Klasy/BazaDanych/DataBase.php');
require('./Klasy/Buttons.php');
// Inicjacje klas i konstruktorów
DataBase::InitializeDB();
//echo Baza::getValue();
$button = new Buttons('Dodaj Film','submit','','submit','150px','40px','#dcedc8','black','');
$error = '';

if(isset($_POST['submit'])){
		if($_FILES['file']['name'] != ''){
			$file_name = $_FILES['file']['name'];
			$file_tmp = $_FILES['file']['tmp_name'];
			$file_size = $_FILES['file']['size'];
			$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
			$file_path = 'Filmy/'.$file_name;
			
			
			if($file_size < 10000000){
				if($file_ext == 'mp4'){
						if(move_uploaded_file($file_tmp, $file_path)){
							$error = '<div class="alert alert-success">Plik został pomyślnie dodany!</div>';
						}else{
							$error = '<div class="alert alert-danger">Plik nie został dodany</div>';
						}
					}else{
						$error = '<div class="alert alert-danger">Nie poprawny format pliku, wybierz plik z rozszerzeniem .mp4</div>';
					}
				}else{
					$error = '<div class="alert alert-danger">Plik jest za duży, nie powinien przekraczać 10mb.</div>';
				}
			}
		}
?> 

<br>
<?php echo $error;?>
<div class="col-sm-8">
	<form method="POST" enctype="multipart/form-data">
		<div>
			<input type="file" name="file" id="file">
		</div>
		<div>
		<?php echo $button->Show();?>
		</div>
	</form>
</div>