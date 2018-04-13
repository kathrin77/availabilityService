/* 
 * Author: Kathrin Heim
 */

$(document).ready(function() {
                
    var search_item = [];   
    
    /**
     * Ajax call
     * Until the website is complete, a "loading" icon is shown and removed after success.
     * On success, the JSON data from availabilityService is parsed and looped through.
     * The array search_item is emptied. 
     * For each item, the id, title, image id, availability, total and note are saved to a variable,
     * the array is filled with the title and note for the filter function.
     * If the gadget is available, a green tile is created, otherwise a red tile. 
     * Each tile contains an image (with title & note as alt-text), the title (call number), and the availability.
     * The html string is added to the div #items.
     */

    $.ajax({
        url: "functions/availabilityService.php",
        method: "GET",
        beforeSend: function(){
            $('#loading').append('<img src="img/load.png" alt="loading"> Wird geladen...');
        },
        success: function(data) {

            $('#loading').css('display', 'none');
            //console.log(data);
            var items = JSON.parse(data);
            //$('#items').html(data);

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
                search_item.push(''+title.toLowerCase()+', '+note.toLowerCase()); //lowercase title & note
                var id = items[i].volume;

                if (available !== 0) {//this gadget is available
                    msg += '<div class="green_tile tile '+(i-1)+'" id="'+ id + '">';
                } else {//this gadget is not available
                    msg += '<div class="red_tile tile '+(i-1)+'" id="'+ id + '">';
                }

                msg += '<p class = "title">'+ title +'</p>'+
                        '<div class ="photo"><img class="link-image" src="img/'+ img_id +
                        '" alt="'+ title +'<br>'+note+'" width="220" ></div>'+

                        '<p class = "availability"> ';

                if (available !== 0) {
                    msg += available;
                } else { //if unavailable, make number red
                    msg += '<span class="allgone">'+ available + ' </span>';
                }
                msg += ' von ' + total + '</p></div>';

            }

            $('#items').html(msg);

            init_imgclick();
        }


    });
    
    /**
     * function init_imgclick ads a click event to the images and loads a toast with the img alt text.
     * see toast.js for details.
     *
     */

    var init_imgclick = function(){
        $('.link-image').click(function(){

            var note = $(this).attr("alt");
            loadtoast(note);
        });
    };

    /**
     * function filter manages the search function.
     * The input text is lowercased, all tiles are removed.
     * The array search_item has been filled with all the titles and notes and is now looped through. 
     * If there is a match between input and array value, the according tile is displayed.
     * 
     */

    var filter = function() {
        var input = $('#filter-search').val().toLowerCase(); //Input text to lowercase


        $('.tile').css('display', 'none');

        //iterate through array search_item
        for (var index in search_item) { 

            if (search_item[index].indexOf(input) >-1) {
                $('.'+index+'').css('display', '');
            }

        }


    };

    $('#filter-search').on('input', filter);            

});

