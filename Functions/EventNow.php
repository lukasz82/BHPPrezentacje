<?php 
require('../Classes/DataBase/DataBase.php');
DataBase::InitializeDB();
    $aktywne_zdarzenie = DataBase::GetDataFromDatabase("SELECT id_zdarzenia FROM aktywnezdarzenie WHERE id = 1");
    $result = $aktywne_zdarzenie['result'];
    $line = $result->fetch_assoc();
    $id = stripslashes($line['id_zdarzenia']);
    echo $id;
?>