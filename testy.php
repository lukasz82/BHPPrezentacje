<script>
  $(document).ready(function() { // czeka aż dokument zostanie wczytany
      $("button").click( function() // odczytuje jakiekolwiek kliknięcie jakiegokolwiek przycisku
        {
            var id = $(this).attr('id'); // tworzę nową zmienną, do której przypisuję wartość id z klikniętego przycisku, this jest to po prostu $("button"), żeby nie pisac ileś razy tego samego odwołuje się do "tego" wywołanego obiektu do tablicy :), czyli this ;-]
            var number = $(this).attr('value');
            //var number_only = number.replace("res",'');
            if (id[0] == "e") // jeśli pierwsza literka stringa == e to nie robię nic w ajaxie, bo jest to przycisk końca polowania
            {
                alert('end');
            } else if (id[0] == "b") // jeśi jest to literka "b" to zaczynam zczytywac z bazy dane dotyczące tego konkretnego polowania
            {
                var n = id.replace("butt",''); // zamieniam butt na pustą wartość żeby odczytac i przekazać id polowania
                //$("#blah"+n).hide();
                $.ajax
                ({
                    type : 'get',
                    url  : '{{URL::to('HuntedAnimalsShow')}}' + '/' + n,
                    //data : {'search':$value},
                    success:function(data)
                    {
                        //var len = data.lista.length;
                        //for (i=0; i<len; i++)
                        //{
                        //
                        //}
                        console.log(data.lista.length);
                       // $("#res"+number).toggleClass('active').toggle("slow" ); // ta metoda powoduje, że pierwsze jest ukrywane a później odkrywane
                        $("#res"+number).html(data.tabela).slideToggle( "slow" );
                        //alert(n);
                    }
                });

                // alert(n);
            }

        }
      ).first().click();
});
</script>