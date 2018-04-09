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
        <script type="text/javascript" src="jquery.toast.min.js"></script>
        <script type="text/javascript" src="toast.js"></script>
        <link rel="stylesheet" type="text/css" href="jquery.toast.min.css"/>
        <link rel="stylesheet" type="text/css" href="availabilityStyle.css"/> 

        <title>Availability Service</title>
    </head>
    <body>
        
        <script>
            $(document).ready(function() {
                
                var search_item = [];            
                                
                $.ajax({
                    url: "availabilityService.php",
                    method: "GET",
                    beforeSend: function(){
                        $('#loading').append('<img src="img/load.png" alt="loading"> Wird geladen...');
                    },
                    success: function(data) {
                        
                        $('#loading').css('display', 'none');
                        
                        var items = JSON.parse(data);
                        $('#items').html(data);
                        
                        var max = Object.keys(items).length;

                        var msg = '';
                        var title;
                        var note;
                        search_item = [];
                        

                        for (var i =1; i<=max; i++) {                            

                            title = items[i].callno;
                            var img_id = items[i].img_id;
                            var available = items[i].available;
                            var total = items[i].total;
                            note = items[i].note;
                            search_item.push(''+title.toLowerCase()+', '+note.toLowerCase()); //alles in Kleinbuchstaben
                            var id = items[i].volume;
                            
                            if (available !== 0) {//es hat noch
                                msg += '<div class="green_tile tile '+(i-1)+'" id="'+ id + '">';
                            } else {//es hat keine mehr
                                msg += '<div class="red_tile tile '+(i-1)+'" id="'+ id + '">';
                            }
                            
                            msg += '<p class = "title">'+ title +'</p>'+
                                    '<div class ="photo"><img class="link-image" src="img/'+ img_id +
                                    '" alt="'+ title +'<br>'+note+'" width="220" ></div>'+
                                    
                                    '<p class = "availability"> ';
                            
                            if (available !== 0) {
                                msg += available;
                            } else {
                                msg += '<span class="allgone">'+ available + ' </span>';
                            }
                            msg += ' von ' + total + '</p></div>';

                        }
                        
                        $('#items').html(msg);
                        
                        init_imgclick();
                    }
                    

                });
                
                var init_imgclick = function(){
                    $('.link-image').click(function(){
                        
                        var note = $(this).attr("alt");
                        loadtoast(note);
                    });
                };
                
                
                
                var filter = function() {
                    var input = $('#filter-search').val().toLowerCase(); //Text aus Eingabe in Kleinbuchstaben
//                    console.log(search_item);
//                    console.log(input);

                    $('.tile').css('display', 'none');
                    
                    //durch alles durchiterieren
                    for (var index in search_item) { 
                        
                        if (search_item[index].indexOf(input) >-1) {
                            $('.'+index+'').css('display', '');
                        }

                    }
                    
                    
                };
                
                $('#filter-search').on('input', filter); 
                
           
                


            });
        
        </script>

        <div class="logo">
            <a href="https://www.unisg.ch/universitaet/bibliothek"><img src="img/hsg_logo_de.jpg" width="180px" alt="HSG-Bibliothek"></a>
        </div>
        <header>Verfügbarkeit Kleinmaterialien</header>
        <nav>
            <ul id="navi">
                <li><a href="index.php"><img src="img/refresh.png" alt="Refresh"></a></li>
                <li><a href="info.php"><img src="img/info.png" alt="Info"></a></li>
            </ul>

        </nav>
        <div id="search">
            <input type="text" placeholder="Suche nach..." id="filter-search"/>
        </div>
        <div id="loading"></div>
        <div id="items"></div>
        
        <footer>
            <address>
                <a href="https://www.unisg.ch/universitaet/bibliothek" >HSG-Bibliothek</a> &bull; 
                <a href="mailto:bibliothek@unisg.ch">bibliothek@unisg.ch</a> &bull; 
                +41 71 224 22 70 &bull;
                Dufourstrasse 50 &bull; 
                CH-9000 St.Gallen
            </address>
        </footer>

    </body>
</html>
