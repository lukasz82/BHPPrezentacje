<?php 
// Pliki źródłowe
readfile ('Layouty/naglowek.html');
require('./Klasy/BazaDanych/DataBase.php');
require('./Klasy/Buttons.php');
$Next = new Buttons('Aktywuj zdarzenie','event','','submit','150px','40px','#dcedc8','black','');
$Del = new Buttons('Usuń zdarzenie','del_id','','submit','150px','40px','#ffccb3','black','');
?> 
    <div class="col-sm-9">
    </br>
    <h4><div id="czas" style="font-size: 30px;"></div></h4>

<?php

    if (isset($_GET['del_id']))
    {       
        $id = $_GET['del_id'];
        try 
        {
            DataBase::InitializeDB();
            DataBase::DelDataFromDatabase($id);
        } 
        catch (Exception $e)
        {
            echo $e;
        }
    }

    DataBase::InitializeDB();
    $lista_filmow = DataBase::GetDataFromDatabase("SELECT zdarzenie.dir_filmu, zdarzenie.start, zdarzenie.stop, zdarzenia.nazwa, zdarzenia.id FROM zdarzenie INNER JOIN zdarzenia ON zdarzenie.id_zdarzenia = zdarzenia.id");
    
    $count = $lista_filmow['count'];
    echo 'Ilość wierszy '.$count.'</br>';
    $result = $lista_filmow['result'];

    $line = $result->fetch_assoc();
    $actual_id = stripslashes($line['id']);
    echo 'Aktualne id '.$actual_id.'</br>';
    echo '</br></br> ZACZYNAMY PĘTELKĘ</br></br>';
    
    echo '<div class="col-sm-6">';
    for ( $i = 0; $i < $count; $i++)
    {
        if ($line['id'] % 2 == 0)
        {
            echo '<div style="background-color: #e0e0eb;">';
        } 

        if ($line['id'] % 2 == 1)
        {
            echo '<div style="background-color: #b3cce6;">';
        } 

        echo "Aktualne Id = :".$actual_id."</br>";
        echo stripslashes($line['nazwa']);
        echo '</br>';
        echo '<b>'.stripslashes($line['dir_filmu']).'</b>';
        echo '</br>';
        echo stripslashes($line['start']);
        echo ' - ';
        echo stripslashes($line['stop']);

        $actual_id_copy = $actual_id;

        echo '</br></br>';
        echo '</div>';
        $line = $result->fetch_assoc();
        $actual_id = stripslashes($line['id']);

        if ($actual_id_copy != stripslashes($line['id']) )
        {            
            // Przekazuje do buttona id zdarzenia  
            $Next->Show_id($actual_id_copy);
            echo '<form action="PanelDodawaniaZdarzen.php" method="get">';
                $Del->Show_witch_value($actual_id_copy);
            echo '</form>';
            echo '</br></br>';
        }
    }
    echo '</div>';
    
?> 

<div id="czas"></div>
<div id="sesja">Aktywne Zdarzenie: </div>
<div id="Podglad"></div>
<div id="Film"></div>

<script>
function getTime() 
{
    return (new Date()).toLocaleTimeString();
}

$(document).ready(function() { // czeka aż dokument zostanie wczytany
    $("button").click( function() // odczytuje jakiekolwiek kliknięcie jakiegokolwiek przycisku
    {
        var id = $(this).attr('id'); // tworzę nową zmienną, do której przypisuję wartość id z klikniętego przycisku, this jest to po prostu $("button"), żeby nie pisac ileś razy tego samego odwołuje się do "tego" wywołanego obiektu 

        // Przekazuję z javascriptu id klikniętego zdarzenia do zmiennej sesyjnej serwera
        $.ajax
        ({
            type : 'get',
            url  : 'Funkcje/EventId.php',
            // Do "data" przekazuję id zdarzenia, żeby je aktywować
            data : {'id':id},
            // Dodstaję callback z tabelą z bazy danych
            success:function(data)
            {
               console.log(data);
            }
        });

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
                    /*
                    for (i=0;i<count;i++)
                    {
                        if ( czas == data.start[i] )
                        {
                            document.getElementById('Film').innerHTML =  '<video width="800" height="600" controls autoplay loop><source src="Filmy/'+data.dir_filmu[i]+'" type="video/mp4">Your browser does not support the video tag.</video>';
                        }
                    }
                    */
                    document.getElementById('czas').innerHTML =  czas;
                }, 1000);
            }
        });
    }
    ).first().click();
});
</script>
      
<?php readfile ('Layouty/stopka.html');?> 
