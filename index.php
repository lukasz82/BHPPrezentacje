<?php 
// Pliki źródłowe
readfile ('Layouty/naglowek.html');
require('./Klasy/BazaDanych/DataBase.php');
// Inicjacje klas i konstruktorów
DataBase::InitializeDB();
?> 
<div class ="row">
   <div class="col-sm-8">
    </br>
    <h4><div id="czas" style="font-size: 30px;"></div></h4>

      </br></br>
      
<h2>Filmy BHP</h2></br>
<h3>Aplikacja jest przeznaczona do zarządzania zdarzeniami takimi jak filmy i komunikaty ustalane za pomocą wcześniej zaplanowanych harmonogramów.</h3></br>
<h4> Z aplikacji mogą korzystać dzialy BHP, Szkoly oraz jednostki przeprowadzajace szkolenia.</br>
</h4>
</div>
</div>

<?php readfile ('Layouty/stopka.html');?> 
    