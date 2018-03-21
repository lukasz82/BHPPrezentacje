<?php 
require('../Classes/DataBase/DataBase.php');
$id = $_GET['id'];

DataBase::InitializeDB();
$lista_filmow = DataBase::GetDataFromDatabase("SELECT zdarzenie.dir_filmu, zdarzenie.start, zdarzenie.stop, zdarzenia.nazwa FROM zdarzenie INNER JOIN zdarzenia ON zdarzenie.id_zdarzenia = zdarzenia.id WHERE zdarzenia.id = '$id'");

  $movie_duration = array ("nazwa", "dir_filmu", "start", "stop");
  $count = $lista_filmow['count'];
  $result = $lista_filmow['result'];
  for ( $i = 0; $i < $count; $i++)
  {
    $line = $result->fetch_assoc();
    $movie_duration["nazwa"][] = stripslashes($line['nazwa']);
    $movie_duration["dir_filmu"][] = stripslashes($line['dir_filmu']);
    $movie_duration["start"][] = stripslashes($line['start']);
    $movie_duration["stop"][] = stripslashes($line['stop']); 
  }
  echo json_encode($movie_duration);
?> 
