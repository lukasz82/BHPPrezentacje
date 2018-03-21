<?php
// Pliki źródłowe
require("Layouts/naglowek.html");
require('Classes/DataBase/DataBase.php');
require('Classes/Buttons.php');
require('Classes/sessions.php');

$Edit = new Buttons('Edytuj zdarzenie','edit_id','','submit','150px','40px','#ffbb33','black','');

$edit_id = $_GET['edit_id'];
DataBase::InitializeDB();
$movie_list = DataBase::GetDataFromDatabase("SELECT zdarzenie.dir_filmu, zdarzenie.start, zdarzenie.stop, zdarzenia.nazwa, zdarzenia.id FROM zdarzenie INNER JOIN zdarzenia ON zdarzenie.id_zdarzenia = zdarzenia.id WHERE zdarzenie.id_zdarzenia = $edit_id");

$count = $movie_list['count'];
$result = $movie_list['result'];
$line = $result->fetch_assoc();
$actual_id = stripslashes($line['id']);
$show_once = false;


if(isset($_POST['stoper'])){
    for ( $i = 0; $i < $count; $i++) {
        $start = $_POST['starter'][$i];
        $stop = $_POST['stoper'][$i];
        $name = stripslashes($line['dir_filmu']);
        $sql = "UPDATE zdarzenie SET start = '$start', stop = '$stop' WHERE id_zdarzenia = $edit_id AND dir_filmu = '$name';";
        DataBase::InitializeDB();
        $update = DataBase::UpdateDataToDatabase($sql);
$line = $result->fetch_assoc();
       echo $sql;
    }
}else{
    echo 'dupa';
}


echo '<h4>Edytuj: '.stripslashes($line['nazwa']).'</h4>';
echo '<div class="col-sm-5" style="margin:5px;">';
for ( $i = 0; $i < $count; $i++)
{


    echo '<form action="" method="POST">';
    echo '<div class="col-sm-2 col-sm-offset-0 text-center">';
    echo '<div style="height:5px;"></div>';
    echo '<b>'.stripslashes($line['dir_filmu']).'</b>';
    echo '</div>';

    echo '<div class="col-sm-2 col-sm-offset-1 text-center">';
    echo '<div style="height:5px;"></div>';
    echo '<div class="form-group">';
    echo '<label for="godzr">Godz. rozpoczecia: </label>';
    echo '<input type="time" name="starter[]" value="'.$line['start'].'" class="form-control">';
    echo '<label for="godzz">Godz. zakończenia: </label>';
    echo '<input type="time" name="stoper[]"  value="'.$line['stop'].'" class="form-control">';


    echo '</div>';

    $actual_id_copy = $actual_id;

    echo '</br>';
    echo '</div>';

    $line = $result->fetch_assoc();
    $actual_id = stripslashes($line['id']);
}
$Edit->Show_witch_value($edit_id);
echo '</form>';
echo '<a href="PanelDodawaniaZdarzen.php" class="btn btn-info btn-sm"><- Wróć</a>';
echo '</div>';

?>


<?php readfile ('Layouts/stopka.html');?>
