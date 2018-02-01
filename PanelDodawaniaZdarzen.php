<?php 
// Pliki źródłowe
readfile ('Layouty/naglowek.html');
require('./Klasy/BazaDanych/DataBase.php');
require('./Klasy/Buttons.php');
DataBase::InitializeDB();
$Next = new Buttons('Aktywuj zdarzenie','event','','submit','150px','40px','#dcedc8','black','');
?> 
    <div class="col-sm-9">
    </br>
    <h4><div id="czas" style="font-size: 30px;"></div></h4>
    
    <?php 

        $lista_filmow = DataBase::GetDataFromDatabase("SELECT zdarzenie.dir_filmu, zdarzenie.start, zdarzenie.stop, zdarzenia.nazwa, zdarzenia.id FROM zdarzenie INNER JOIN zdarzenia ON zdarzenie.id_zdarzenia = zdarzenia.id");
        $count = $lista_filmow['count'];
        $result = $lista_filmow['result'];

        // Licznik zmiany kolorków zdarzeń

        $line = $result->fetch_assoc();
        $licznik = stripslashes($line['id']);
        //echo $licznik;
        for ( $i = 0; $i < $count; $i++)
        {
            $line = $result->fetch_assoc();
            if ($licznik != stripslashes($line['id']) )
            {            
                // Przekazuje do buttona id zdarzenia   
                $Next->Show_id($licznik);
                echo '</br></br>';
                $licznik ++;
            }

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

<div id="czas"></div>

<div id="Podglad"></div>

<div id="Film"></div>

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script>

function getTime() 
{
    return (new Date()).toLocaleTimeString();
}

$(document).ready(function() { // czeka aż dokument zostanie wczytany
    $("button").click( function() // odczytuje jakiekolwiek kliknięcie jakiegokolwiek przycisku
    {
        var id = $(this).attr('id'); // tworzę nową zmienną, do której przypisuję wartość id z klikniętego przycisku, this jest to po prostu $("button"), żeby nie pisac ileś razy tego samego odwołuje się do "tego" wywołanego obiektu 
        $.ajax
        ({
            type : 'get',
            url  : 'Funkcje/EventsFromDatabase.php',
            // Do "data" przekazuję id zdarzenia, żeby je aktywować
            data : {'id':id},
            dataType : 'json',
            // Dodstaję callback z tabelą z bazy danych
            success:function(data)
            {
               console.log(data);
               // $("#res"+number).toggleClass('active').toggle("slow" ); // ta metoda powoduje, że pierwsze jest ukrywane a później odkrywane
                //$("#res"+number).html(data.tabela).slideToggle( "slow" );
                //alert(n);

                //if(data[i].city && data[i].cStatus){
                            //txt += "<tr><td>"+data[i].city+"</td><td>"+data[i].cStatus+"</td></tr>";
                        //
                document.getElementById('Podglad').innerHTML =  "";
                var count = data.nazwa.length;
                for (i=0;i<count;i++)
                {
                    document.getElementById('Podglad').innerHTML +=  
                    data.nazwa[i] +
                    '</br>' +
                    data.start[i] +
                    '</br>';

                }

                setInterval(function() 
                {
                    var czas = getTime();

                    for (i=0;i<count;i++)
                    {
                        if ( czas == data.start[i] )
                        {
                            document.getElementById('Film').innerHTML =  '<video width="800" height="600" controls autoplay><source src="Filmy/'+data.dir_filmu[i]+'" type="video/mp4">Your browser does not support the video tag.</video>';
                        }
                    }

                    document.getElementById('czas').innerHTML =  czas;
                }, 1000);

            }
        });
    }
    ).first().click();
});
</script>
      
<?php readfile ('Layouty/stopka.html');?> 
