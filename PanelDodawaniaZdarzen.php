<?php 
// Pliki źródłowe
readfile ('Layouty/naglowek.html');
require('./Klasy/BazaDanych/DataBase.php');
// Inicjacje klas i konstruktorów
DataBase::InitializeDB();
//echo Baza::getValue();
?> 
    <div class="col-sm-9">
    </br>
    <h4><div id="czas" style="font-size: 30px;"></div></h4>

      </br></br>
      <p>Food is my passion. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

      <?php 

        $lista_filmow = DataBase::GetDataFromDatabase("SELECT zdarzenie.dir_filmu, zdarzenie.start, zdarzenie.stop, zdarzenia.nazwa FROM zdarzenie INNER JOIN zdarzenia ON zdarzenie.id_zdarzenia = zdarzenia.id");
        $count = $lista_filmow['count'];
        $result = $lista_filmow['result'];

        for ( $i = 0; $i < $count; $i++)
        {
          $line = $result->fetch_assoc();
          echo stripslashes($line['nazwa']);
          echo ' - ';
          echo '<b>'.stripslashes($line['dir_filmu']).'</b>';
          //echo '</br>';
          echo ' - ';
          echo stripslashes($line['start']);
          echo ' - ';
          echo stripslashes($line['stop']);
          echo ' - ';
          echo '</br>';

        }

      
      ?> 
<h2>Filmy BHP</h2>
<h3> Za 6 sek zacznie się odtwarzanie </h3>

<div id="losowa"></div>

<script type="text/javascript">
var licznik = 0;


function getTime() 
{
    return (new Date()).toLocaleTimeString();
}
 
//wywołanie ma na celu eliminację opóźnienia sekundowego
document.getElementById('czas').innerHTML = getTime();

var plikDoWyswietl = '<p> Wyswietlam jakis komunikat, który był zaplanowany na jakąś godzine, następny wyświeli się za 10 sek. <p>';
var plikDoWyswietl_1 = '<p> <font color="Red"> A teraz wyświetlam film </font> <p>';
var plikDoWyswietl_2 = '<p> <font color="Red"> A teraz komunikat, Górnicy poniżej zgłosić się na badanie alkomatem </p><table border="1"><tbody><tr><td>Imię</td><td>Nazwisko</td><td>Nr.komputera</td></tr><tr><td>Jan</td><td>Nowak</td><td>1234</td></tr><tr><td>Jacek</td><td>Kała</td><td>1234</td></tr></tbody></table>';
var prezentacja = '<a href="powepoint.pptx">my link</a>';

setInterval(function() 
{
    document.getElementById('czas').innerHTML = getTime();
    
if (licznik == 5) 
{
    document.getElementById('losowa').innerHTML =  '<video width="800" height="600" controls autoplay><source src="powepoint.mp4" type="video/mp4">Your browser does not support the video tag.</video>';
}

if (licznik == 16) 
{
    document.getElementById('losowa').innerHTML =  '<img src="film.gif"loop=infinite />';
}

if (licznik == 24) 
{
    document.getElementById('losowa').innerHTML =  plikDoWyswietl_2;
}

if (licznik == 35) 
{
    document.getElementById('losowa').innerHTML =  '<img src="film2.gif"loop=infinite />';
}
    
licznik++;
     
}, 1000);
</script>
      
      
      
      
      

      <h4>Dodaj zdarzenie</h4>
      <form role="form">
        <div class="form-group">
          <textarea class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
      </form>
      <br><br>
      
<?php readfile ('Layouty/stopka.html');?> 
