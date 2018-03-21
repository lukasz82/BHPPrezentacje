<?php
require('../Classes/DataBase/DataBase.php');
$del_id = $_GET['id'];
DataBase::InitializeDB();
DataBase::DelDataFromDatabase($del_id);
?>