<!DOCTYPE html>
<html lang="pl">
<head>
  <title>BHP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="Style/strona.css">

</head>
<body>

<div class="container-fluid">
<div class="row content">
   
<div id="czas"></div>
<div id="Film"></div>
<div id="test"></div>
<?php 

/*
require('./Klasy/BazaDanych/DataBase.php');
DataBase::InitializeDB();
    $aktywne_zdarzenie = DataBase::GetDataFromDatabase("SELECT id_zdarzenia FROM aktywnezdarzenie WHERE id = 1");
    $result = $aktywne_zdarzenie['result'];
    $line = $result->fetch_assoc();
    $id = stripslashes($line['id_zdarzenia']);
    echo "Id = ".$id;
    */
?>

<script>

function getTime() 
{
    return (new Date()).toLocaleTimeString();
}

var count = 0;
var licznik = 0;
var id = 0;
var play_1 = false;
var play_2 = false;

$(document).ready(function() //czeka aż dokument zostanie wczytany
{ 
    $.ajax
    ({
        type : 'get',
        url  : 'Funkcje/EventNow.php',
        // Do "data" przekazuję id zdarzenia, żeby je aktywować
        // Dodstaję callback z tabelą z bazy danych
        success:function(data)
        {
            id = data;
            console.log(data);

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
                    document.getElementById('Film').innerHTML =  "";
                    //count = data.nazwa.length;

                    setInterval(function() 
                    {
                        licznik++;

                        if (licznik > 2)
                        {
                            document.getElementById('Film').innerHTML =  "";
                            $.ajax
                            ({
                                type : 'get',
                                url  : 'Funkcje/EventNow.php',
                                // Do "data" przekazuję id zdarzenia, żeby je aktywować
                                // Dodstaję callback z tabelą z bazy danych
                                success:function(data)
                                {
                                    console.log("Id w kroku 2: " + id);
                                    console.log("data w kroku 2: " + data);
                                    if (id != data) 
                                    {
                                        id = data;
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
                                                document.getElementById('Film').innerHTML =  "";
                                                count = data.nazwa.length;


                                                var czas = getTime();
                                                for (i=0;i<count;i++)
                                                {

                                                    // Usuwam z czasów znaki specjalne, zostawiam cyfry w celu porównanie przedziaów czasu jako wartości typu int
                                                    var data_start = data.start[i].replace(/[^0-9\.]+/g, "");
                                                    var data_stop = data.stop[i].replace(/[^0-9\.]+/g, ""); 
                                                    var time_copy = czas.replace(/[^0-9\.]+/g, "");

                                                    console.log("Play 2 data start: " + data_start);
                                                    console.log(data_stop);
                                                    console.log("Play 2 time copy: " + time_copy); 
                                                    console.log("Play 2 status: " + play_2); 

                                                    // Warunek odpalający filmik gdy czas jest równoważny dacie startu
                                                    //if ( czas == data.start[i] )
                                                    // Warunek odpalający filmik z danego przedzialu czasu
                                                    if (data_start <= time_copy && data_stop > time_copy)
                                                    {
                                                        if (data_start <= time_copy && data_stop > time_copy)
                                                        {
                                                            if (play_2 == false)
                                                            {
                                                                document.getElementById('Film').innerHTML =  '<video width="800" height="600" controls autoplay loop><source src="Filmy/'+data.dir_filmu[i]+'" type="video/mp4">Your browser does not support the video tag.</video>';
                                                                play_2 = true;
                                                            }
                                                        }   
                                                        else 
                                                        {
                                                            play_2 = false;
                                                        }
                                                    }
                                                }

                                            }
                                        });
                                    }

                                    var czas = getTime();
                                    for (i=0;i<count;i++)
                                    {

                                        // Usuwam z czasów znaki specjalne, zostawiam cyfry w celu porównanie przedziaów czasu jako wartości typu int
                                        var data_start = data.start[i].replace(/[^0-9\.]+/g, "");
                                        var data_stop = data.stop[i].replace(/[^0-9\.]+/g, ""); 
                                        var time_copy = czas.replace(/[^0-9\.]+/g, "");

                                        console.log(data_start);
                                        console.log(data_stop);
                                        console.log(time_copy); 

                                        // Warunek odpalający filmik gdy czas jest równoważny dacie startu
                                        //if ( czas == data.start[i] )
                                        // Warunek odpalający filmik z danego przedzialu czasu
                                        if (data_start <= time_copy && data_stop > time_copy)
                                        {
                                            if (play_1 == false)
                                            {
                                                document.getElementById('Film').innerHTML =  '<video width="800" height="600" controls autoplay loop><source src="Filmy/'+data.dir_filmu[i]+'" type="video/mp4">Your browser does not support the video tag.</video>';
                                                play_1 = true;
                                            }
                                        }   
                                        else 
                                        {
                                            play_1 = false;
                                        }
                                    }

                                    
                                }
                            });
                            licznik = 0;
                        }


                        document.getElementById('czas').innerHTML =  czas;
                    }, 5000);
                }
            });


        }
    });        
});

</script>
</div>
</div>
</body>
</html>