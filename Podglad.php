<?php 
// Pliki źródłowe
readfile ('Layouty/naglowek.html');
require('./Klasy/BazaDanych/DataBase.php');
// Inicjacje klas i konstruktorów
DataBase::InitializeDB();
?> 




<?php readfile ('Layouty/stopka.html');?> 