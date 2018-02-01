<?php 
require('DataBase.php');
$id = $_GET['id'];

  DataBase::InitializeDB();
  $lista_filmow = DataBase::GetDataFromDatabase("SELECT zdarzenie.dir_filmu, zdarzenie.start, zdarzenie.stop, zdarzenia.nazwa FROM zdarzenie INNER JOIN zdarzenia ON zdarzenie.id_zdarzenia = zdarzenia.id WHERE zdarzenia.id = '$id'");
   /* 
    $count = $lista_filmow['count'];
    $result = $lista_filmow['result'];

        for ( $i = 0; $i < $count; $i++)
        {
          $line = $result->fetch_assoc();
          echo stripslashes($line['nazwa']);
          echo stripslashes($line['dir_filmu']);
          echo stripslashes($line['start']);
          echo stripslashes($line['stop']);
        }
      */
       // echo $id;
    $movie_duration = array ("nazwa", "dir_filmu", "start", "stop");
    $count = $lista_filmow['count'];
    $result = $lista_filmow['result'];
    for ( $i = 0; $i < $count; $i++)
        {
          $line = $result->fetch_assoc();
          //echo stripslashes($line['nazwa']);
          //echo stripslashes($line['dir_filmu']);
          //echo stripslashes($line['start']);
          //echo stripslashes($line['stop']);
          $movie_duration["nazwa"][] = stripslashes($line['nazwa']);
          $movie_duration["dir_filmu"][] = stripslashes($line['dir_filmu']);
          $movie_duration["start"][] = stripslashes($line['start']);
          $movie_duration["stop"][] = stripslashes($line['stop']); 
        }

//$line = $lista_filmow['result']->fetch_assoc();
//  echo json_encode($line);
        echo json_encode($movie_duration);
        



?> 
