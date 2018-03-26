<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <link rel="stylesheet" type="text/css" href="availabilityStyle.css"/>        
        <title>Availability Service</title>
    </head>
    <body>
        
        <script>
            $(document).ready(function() {
                                
                $.ajax({
                    url: "availabilityService.php",
                    method: "GET",
                    success: function(data) {
                        
                        var items = JSON.parse(data);
                        $('#items').html(data);
                        
                        var max = Object.keys(items).length;

                        var msg = '';

                        for (var i =1; i<=max; i++) {                            

                            var title = items[i].callno;
                            var img_id = items[i].img_id;
                            var available = items[i].available;
                            var total = items[i].total;
                            var note = items[i].note;
                            var id = items[i].volume;
                            
                            if (available !== 0) {//es hat noch
                                msg += '<div class="green_tile" class="'+ id + '">';
                            } else {
                                msg += '<div class="red_tile" class="'+ id + '">';
                            }
                            
                            msg += '<div class ="photo"><img src="img/'+ img_id +
                                    '" alt="'+ title +'" width="220"/></div>'+
                                    '<p class = "title">'+ title +'</p>'+
                                     '<p class = "note">' + note + '</p>'+
                                     '<p class = "availability"> Verfügbar: ';
                            
                            if (available !== 0) {
                                msg += available;
                            } else {
                                msg += '<span class="allgone">'+ available + ' </span>';
                            }
                            msg += ' / Total: ' + total + '</p></div>';

                        }
                        
                        $('#items').html(msg);
                    }
                });

            });
        
        </script>
        <img class="logo" src="img/hsg_logo_de.jpg" width="180px">
        <header>Verfügbarkeit Kleinmaterialien</header>
        <div id="items"></div>
        <div id="reload"></div>

    </body>
</html>
