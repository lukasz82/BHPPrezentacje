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

    $last_id = DataBase::GetDataFromDatabase("SELECT id FROM zdarzenia ORDER BY id DESC LIMIT 1");
    var_dump($last_id);
    $result = $last_id['result'];
    $line = $result->fetch_assoc();
    echo '<b> Ostatnie ID '.stripslashes($line['id']).'</b>';
    echo '</br>';

    if (stripslashes($line['id'] == 0))
    {
        $new_event_name = 'Zdarzenie nr 1';
        $new_event_id = 1;
    } 
    else if (stripslashes($line['id'] > 0))
    {
        $new_event_name = 'Zdarzenie nr '.stripslashes($line['id'] + 1);
        $new_event_id = stripslashes($line['id'] + 1);
    }
    echo '</br>';

    // Rejestracja nowego zdarzenia
    DataBase::InitializeDB();
    DataBase::InsertDataToDatabase("INSERT INTO zdarzenia (nazwa) VALUES ('$new_event_name')");

    for ($i = 0; $i < $tcount; $i++)
    {
        echo 'Film nr. '.$i.': </br>';
        echo 'Start: '.$movie_duration['start'][$i].'</br>';
        echo 'Stop: '.$movie_duration['stop'][$i].'</br>';
        echo 'Id Filmu: '.$movie_duration['mov_id'][$i].'</br>';
        echo 'ścieżka: '.$movie_duration['mov_dir'][$i].'</br>';

        $start = $movie_duration['start'][$i];
        $stop = $movie_duration['stop'][$i];
        $mov_id = $movie_duration['mov_id'][$i];
        $mov_dir = $movie_duration['mov_dir'][$i];
   
        var_dump($start);
        $mysq_start = $start.':00';
        var_dump($mysq_start);
        echo '</br>';
        DataBase::InitializeDB();
        DataBase::InsertDataToDatabase("INSERT INTO zdarzenie (dir_filmu,id_zdarzenia, start, stop)
        VALUES ('$mov_dir','$new_event_id','$start','$stop')");
    }
?>
    </div>
</div>

<?php readfile ('Layouty/stopka.html');?> 