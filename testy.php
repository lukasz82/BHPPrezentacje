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

require('./Klasy/BazaDanych/DataBase.php');
DataBase::InitializeDB();
    $aktywne_zdarzenie = DataBase::GetDataFromDatabase("SELECT id_zdarzenia FROM aktywnezdarzenie WHERE id = 1");
    $result = $aktywne_zdarzenie['result'];
    $line = $result->fetch_assoc();
    $id = stripslashes($line['id_zdarzenia']);
    echo "Id = ".$id;
?>

<script>

function getTime() 
{
    return (new Date()).toLocaleTimeString();
}

   var id = '<?php echo $id ?>';

                //setInterval(function() 
                //{
                //    console.log(id);
                //}, 1000);
var refresh = false;
var count = 0;
var licznik = 0;
var id_copy = 0;


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
               id_copy
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

                document.getElementById('Film').innerHTML =  "";
                
                count = data.nazwa.length;
                /*
                for (i=0;i<count;i++)
                {
                    document.getElementById('test').innerHTML +=  
                    data.nazwa[i] +
                    '</br>' +
                    data.start[i] +
                    '</br>';
                }
                */
                

                setInterval(function() 
                {
                    licznik++;

                    if (licznik > 5)
                    {


                        $.ajax
                        ({
                            type : 'get',
                            url  : 'Funkcje/EventNow.php',
                            // Do "data" przekazuję id zdarzenia, żeby je aktywować
                            // Dodstaję callback z tabelą z bazy danych
                            success:function(data)
                            {
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
                                        }
                                    });
                                }
                                console.log(data);
                            }
                        });
                        licznik = 0;
                    }

                    var czas = getTime();

                    for (i=0;i<count;i++)
                    {
                        if ( czas == data.start[i] )
                        {
                            document.getElementById('Film').innerHTML =  '<video width="800" height="600" controls autoplay loop><source src="Filmy/'+data.dir_filmu[i]+'" type="video/mp4">Your browser does not support the video tag.</video>';
                        }
                    }

                    document.getElementById('czas').innerHTML =  czas;
                }, 1000);

            }
        });
        
    });




</script>


</div>
  </div>

</body>
</html>