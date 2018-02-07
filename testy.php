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
   
<div id="time"></div>
<div id="Film"></div>
<div id="test"></div>

<script>

var count = 0;
var counter = 0;
let id = 0;
//let play = false;
let play = []; // Zakadam, że wszystkie elementy ustawione są na "false"
let arr_init = false; // Zmienna bool sprawdzajaca cz tablica zostaa zainicjowana

function getTime() 
{
    return (new Date()).toLocaleTimeString();
}

function getEventId()
{
    return $.ajax
    ({
        type : 'get',
        url  : 'Funkcje/EventNow.php',
        // Do "data" przekazuję id zdarzenia, żeby je aktywować
        // Dodstaję callback z tabelą z bazy danych
        success:function(data)
        {
            console.log(data);
        }
    })   
}

async function getDataFromDatabase() 
{
    console.log("id z eventa 1: " + id);
    
    if (id != await getEventId()) 
    {
        arr_init = false;
    }

    id = await getEventId();
    console.log("id z eventa 2: " + id);

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
            //document.getElementById('Film').innerHTML =  "";
            count = data.nazwa.length;

            if (arr_init == false) 
            {
                play.splice(0, play.length);
                document.getElementById('Film').innerHTML ="";
                for (i=0; i<count; i++)
                {
                    play[play.length] = false;
                }
                arr_init = true;
            }

            arr_length = play.length;
            console.log("arr[] lenght przed petla: " + arr_length); 

            var time = getTime();
            for (i=0;i<count;i++)
            {
                // Usuwam z timeów znaki specjalne, zostawiam cyfry w celu porównanie przedziaów timeu jako wartości typu int
                var data_start = data.start[i].replace(/[^0-9\.]+/g, "");
                var data_stop = data.stop[i].replace(/[^0-9\.]+/g, ""); 
                var time_copy = time.replace(/[^0-9\.]+/g, "");

                console.log("Play 2 data start: " + data_start);
                console.log(data_stop);
                console.log("Play 2 time copy: " + time_copy); 
                console.log("Play 2 status: " + play[i]); 

                // Warunek odpalający filmik z danego przedzialu czasu
                if (play[i] == false)
                {
                    if (time_copy > data_start && time_copy < data_stop)
                    {
                        document.getElementById('Film').innerHTML =  '<video width="800" height="600" controls autoplay loop><source src="Filmy/'+data.dir_filmu[i]+'" type="video/mp4">Your browser does not support the video tag.</video>';
                        //play = true;
                        play[i] = true;
                    } else { play[i] = false; }
                } else if (play[i] == true)
                {
                    if ( (time_copy < data_start && time_copy < data_stop) || (time_copy < data_start && time_copy < data_stop) )
                    {                        
                        play[i] = false;
                        console.log("jesli play == true dstart<t i dstop<t: " + play[i]); 
                    }
                } 
            }
        }
    });
}


$(document).ready(function() //czeka aż dokument zostanie wczytany
{ 
    setInterval(function() 
    {
        counter++;
        if (counter > 5)
        {
            getDataFromDatabase();
            counter = 0;
        }
        document.getElementById('time').innerHTML =  time;
    }, 1000);

});

</script>
</div>
</div>
</body>
</html>