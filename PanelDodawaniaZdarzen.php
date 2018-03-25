<link rel="stylesheet" type="text/css" href="styles/pdzdarzen.css">
<?php 
// Pliki źródłowe
readfile ('Layouts/naglowek.html');
require('Classes/DataBase/DataBase.php');
require('Classes/Buttons.php');

$Next = new Buttons('Aktywuj zdarzenie','event','','submit','150px','40px','#dcedc8','black','','next');
$Del = new Buttons('Usuń zdarzenie','del_id','','submit','150px','40px','#ffccb3','black','','del');
// PAWEL
$Edit = new Buttons('Edytuj zdarzenie','edit_id','','submit','150px','40px','#ffbb33','black','','edit');
// ----
$time_copy = date('h:i:s', time());
?> 

</br>

<div class="col-sm-9">
    <h4><div id="czas" style="font-size: 30px;"><?php echo $time_copy; ?></div></h4>
    <h4><p id="Podglad">Aktywne zdarzenie: Zdarzenie nr </p></h4>
    <div id="wynik"></div>
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
    $result = $movie_list['result'];

    $line = $result->fetch_assoc();
    $actual_id = stripslashes($line['id']);
    $show_once = false;
    
    echo '<div class="col-sm-8" style="margin:5px;">';
    for ( $i = 0; $i < $count; $i++)
    {


        if ($show_once == false)
        {        
            if ($line['id'] % 2 == 0)
            {
                echo '<div class="col-sm-2" style="margin:5px; background-color: #e0e0eb;">';
            } 

            if ($line['id'] % 2 == 1)
            {
                echo '<div class="col-sm-2" style="margin:5px; background-color: #b3cce6;">';
            } 
            //echo "Aktualne Id = :".$actual_id."</br>";
            echo stripslashes($line['nazwa']);
            echo '</br></br>';
            $show_once = true;
        }
        echo '</br>';
        echo stripslashes($line['dir_filmu']);
        echo '</br>';
        echo stripslashes($line['start']);
        echo ' - ';
        echo stripslashes($line['stop']);

        $actual_id_copy = $actual_id;

        //echo '</br>';
        
        $line = $result->fetch_assoc();
        $actual_id = stripslashes($line['id']);

        if ($actual_id_copy != stripslashes($line['id']) )
        {   
            // Przekazuje do buttona id zdarzenia  
            $Next->Show_id($actual_id_copy);
            echo '<form action="PanelDodawaniaZdarzen.php" method="get">';
                $Del->Show_witch_value($actual_id_copy);
            echo '</form>';
            echo '<form action="Edit.php" method="get">';
                $Edit->Show_witch_value($actual_id_copy);
            echo '</form>';
            echo '</br>';
            $show_once = false;
            echo '</div>'; 
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
        url  : 'Functions/EventNow.php',
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
        console.log("Wartosc id =" + id);
        var value = $(this).attr('value');
        console.log("Wartosc value =" + value);
        // Przekazuję z javascriptu id klikniętego zdarzenia do zmiennej sesyjnej serwera


        document.getElementById('wynik').innerHTML =  id;

        // Zabezpieczenie, żeby nie aktywować pustego zdarzenia przy próbie edycji lub usunięcia
        if (id != "del" && id != "edit")
            {
            $.ajax
            ({
                type : 'get',
                url  : 'Functions/EventId.php',
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
                url  : 'Functions/EventsFromDatabase.php',
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
    }
    );
    //).first().click();
});
</script>

<?php readfile ('Layouts/stopka.html');?> 
