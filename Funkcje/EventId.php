  <?php
require('DataBase.php');
$id = $_GET['id'];
  DataBase::InitializeDB();
  DataBase::Update("UPDATE aktywnezdarzenie SET id_zdarzenia = '$id' WHERE id=1");
echo "dodalem id".$id;
  ?>