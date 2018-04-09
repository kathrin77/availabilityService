/* 
 * Author: Kathrin Heim
 */

$(document).ready(function() {
                
                var search_item = [];            
                                
                $.ajax({
                    url: "functions/availabilityService.php",
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

