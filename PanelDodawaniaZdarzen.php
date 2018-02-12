<?php 
// Pliki źródłowe
readfile ('Layouty/naglowek.html');
require('./Klasy/BazaDanych/DataBase.php');
require('./Klasy/Buttons.php');
$Next = new Buttons('Aktywuj zdarzenie','event','','submit','150px','40px','#dcedc8','black','');
$Del = new Buttons('Usuń zdarzenie','del_id','','submit','150px','40px','#ffccb3','black','');
$time_copy = date('h:i:s', time());
?> 

</br>
<div class="col-sm-5">
    <h4><div id="czas" style="font-size: 30px;"><?php echo $time_copy; ?></div></h4>
    <h4><p id="Podglad">Aktywne zdarzenie: Zdarzenie nr </p></h4>
</div>

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
    $movie_list = DataBase::GetDataFromDatabase("SELECT zdarzenie.dir_filmu, zdarzenie.start, zdarzenie.stop, zdarzenia.nazwa, zdarzenia.id FROM zdarzenie INNER JOIN zdarzenia ON zdarzenie.id_zdarzenia = zdarzenia.id");
    
    $count = $movie_list['count'];
    //echo 'Ilość wierszy '.$count.'</br>';
    $result = $movie_list['result'];

    $line = $result->fetch_assoc();
    $actual_id = stripslashes($line['id']);
    $show_once = false;
    
    echo '<div class="col-sm-5" style="margin:5px;">';
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

        if ($show_once == false)
        {
            //echo "Aktualne Id = :".$actual_id."</br>";
            echo '&nbsp&nbsp'.stripslashes($line['nazwa']);
            echo '</br></br>';
            $show_once = true;
        }
        echo '<b>&nbsp&nbsp'.stripslashes($line['dir_filmu']).'</b>';
        echo '</br>';
        echo '&nbsp&nbsp'.stripslashes($line['start']);
        echo ' - ';
        echo '&nbsp&nbsp'.stripslashes($line['stop']);

        $actual_id_copy = $actual_id;

        echo '</br>';
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
            $show_once = false;
        }
    }
    echo '</div>';
?> 

<script>
function getTime() 
{
    return (new Date()).toLocaleTimeString();
}

$(document).ready(function() 
{ // czeka aż dokument zostanie wczytany

    // Wczytuje i pokazuje Id zdarzenia, po pierwszym uruchomieniu strony
    $.ajax
    ({
        type : 'get',
        url  : 'Funkcje/EventNow.php',
        // Do "data" przekazuję id zdarzenia, żeby je aktywować
        // Dodstaję callback z tabelą z bazy danych
        success:function(data)
        {
            console.log(data);
            document.getElementById('Podglad').innerHTML +=  data;
        }
    })   

    setInterval(function() 
    {
        var czas = getTime();
        document.getElementById('czas').innerHTML =  czas;
    }, 1000);

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
                document.getElementById('Podglad').innerHTML += "Aktywne zdarzenie: " + data.nazwa[0];
                for (i=0;i<count;i++)
                {
                    document.getElementById('Podglad').innerHTML +=  
                    '</br>' +
                    data.start[i] +
                    ' - ' +
                    data.stop[i];
                }
            }
        });
    }
    );
    //).first().click();
});
</script>

<?php readfile ('Layouty/stopka.html');?> 
