<?php
// Pliki źródłowe
readfile ('Layouts/naglowek.html');
require('Classes/DataBase/DataBase.php');
require('Classes/Buttons.php');

$edit_id = $_GET['edit_id'];

if(isset( $_GET['start']) )
{
    // Pobieram ostatnie id zdarzenia (np. jeśli w zdarzeniu  nr 3 są id w bazie 4,5,6,7, to pierwsze id == 4)
    DataBase::InitializeDB();
    $first_id = DataBase::GetDataFromDatabase("SELECT id FROM zdarzenie WHERE id_zdarzenia = '$edit_id' ORDER BY id LIMIT 1");
    var_dump($first_id);
    $result = $first_id['result'];
    $line = $result->fetch_assoc();
    echo '<b> Ostatnie ID '.stripslashes($line['id']).'</b>';
    $first_id = stripslashes($line['id']);
    
    echo '</br>';
    echo '</br> wywolalem submita, zmiany zostay dodane do bazy </br>';
    
    // Count jest potrzebny do określenia ilości indeksów do updatu, np 3 indeksy, jak poniżej
    $count = $_GET['count'];
    echo "ilosc count ".$count."</br>";
    // Counter jest potrzebny do zczytania indeksu z tablicy get, indeks zawsze zaczyna się od 0, czyli jeśli tablica jest 3 elementowa to zczytuje get[0], get[1], get[2] inaczej mówiąc get[$counter == 0], get[$counter == 1]...
    $counter = 0;
    for ( $i = $first_id; $i < $first_id + $count; $i++) 
    {
        echo "i = ".$i."</br>";
        echo "counter = ".$counter."</br>";
        $start = $_GET['start'][$counter];
        $stop = $_GET['stop'][$counter];
        DataBase::InitializeDB();
        DataBase::UpdateDataToDatabase("UPDATE zdarzenie SET start = '$start', stop = '$stop' WHERE id = '$i'");
        $counter++;
    }
}

echo '<a href="PanelDodawaniaZdarzen.php" class="btn btn-info btn-sm"><- Wróć</a>';
echo '</div>';

?>


<?php readfile ('Layouts/stopka.html');?>
