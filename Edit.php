<?php
// Pliki źródłowe
require("Layouts/naglowek.html");
require('Classes/DataBase/DataBase.php');
require('Classes/Buttons.php');

$Edit = new Buttons('Zapisz Zmiany','edit_id','','submit','150px','40px','#ffbb33','black','','');

$edit_id = $_GET['edit_id'];

DataBase::InitializeDB();
$movie_list = DataBase::GetDataFromDatabase("SELECT zdarzenie.dir_filmu, zdarzenie.start, zdarzenie.stop, zdarzenia.nazwa, zdarzenia.id FROM zdarzenie INNER JOIN zdarzenia ON zdarzenie.id_zdarzenia = zdarzenia.id WHERE zdarzenie.id_zdarzenia = $edit_id");

$count = $movie_list['count'];
$result = $movie_list['result'];
$line = $result->fetch_assoc();

echo '<h4>Edytuj: '.stripslashes($line['nazwa']).'</h4>';
echo '<div class="col-md-5" style="margin:5px;">';
for ( $i = 0; $i < $count; $i++)
{
    echo '<form action="Edit_Confirm.php" method="GET">';
        echo '<div class="col-sm-2 col-sm-offset-0 text-center">';
            echo '<div style="height:5px;"></div>';
            echo '<b>'.stripslashes($line['dir_filmu']).'</b>';
            echo '<div style="height:5px;"></div>';
                echo '<div class="form-group">';
                    echo '<label for="godzr">Godz. rozpoczecia: </label>';
                    echo '<input type="time" name="start[]" value="'.$line['start'].'" class="form-control">';
                    echo '<label for="godzz">Godz. zakończenia: </label>';
                    echo '<input type="time" name="stop[]"  value="'.$line['stop'].'" class="form-control">';
                    echo '<input type="hidden" name="edit_id" value="'.$edit_id.'" class="form-control">';
                    echo '<input type="hidden" name="count" value="'.$count.'" class="form-control">';
                echo '</div>';
                echo '</br>';
            echo '</div>';
    $line = $result->fetch_assoc();
}
echo '</br>';
$Edit->Show_witch_value($edit_id);
echo '</form>';
echo '</br>';
echo '<a href="PanelDodawaniaZdarzen.php" class="btn btn-info btn-sm"><- Wróć</a>';
echo '</div>';

?>
<?php readfile ('Layouts/stopka.html');?>
