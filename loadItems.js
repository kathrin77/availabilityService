/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function loadItems() {
    
    $.getJSON('data/test.json').done(function(data){
        
        var items = data.items;
        var total = data.itemtotal;

        var msg = '';

        for (var i =0; i<total; i++) {
            
            var callno = items[i].callno.slice(1);
            var volume = items[i].volume;
            var groupid = items[i].groupid;
            var note = items[i].note;
            var available = items[i].available;
            
            
//            var cluster = d3.nest()
//                    .key(function(e) { return e.groupid; })
//                    .rollup(function(v) {return {
//                            count:v.length,
//                            available: d3.sum(v, function (d) {return d.available; })
//                    };})
//                    .entries(items);

            msg+= '<div id="all" class="'+ items[i].groupid + '">' 
                    + items[i].groupid + ' - ' 
                    + items[i].volume + ' - ' 

                    +'<img src="img/'+items[i].volume+'.jpg" alt="'+items[i].volume+'" height="60" width="60" /> '
                    + items[i].callno.slice(1) + ' - '
                    + items[i].note + ' - ';

            //not available
            if (!items[i].available) {
                msg+= 
                    + items[i].available + ': '
                    //+ items[i].due + ': '
                    +' not available </div>';
            } else { //available
                msg+='</div>';
            }


        };        
            
        $('#items').html(msg); 
        
//        var max = $('all').last();
//        $('aside').append(max);
        for (var i = 0; i<32; i++) {
            
//            var cluster = $('.'+(i+1)+'').map(function(index){
//                var nrTotal = this.length;
//                var nrOnloan = this.text()
//            });

            var nrTotal = $('.'+(i+1)+'').length;
            var nrOnloan = $('.'+(i+1)+':contains("not available")').length;
            

    //        var thisArticle = $("div").filter(i);

            $("#cluster").append("<div id="+(i+1)+">"+
                    "There are "+nrTotal+" in Total "+
                    "and "+nrOnloan+" not available from Article "+(i+1)+"</div>");

        }
                
    }).fail(function() {
        $('aside').append('Availability Service currently unable to load.');
    }).always(function(){
        var reload = '<br>Last updated: '+realTime()+'<a id="refresh" href="#">';
        reload += '<img src="img/refresh.png" alt="Refresh" /></a>';
        $('#reload').html(reload);
        $('#refresh').on('click',function(e){
            e.preventDefault();
            loadItems();
        });
    });
    

}

function realTime() {
        var d = new Date();
        var hrs = d.getHours();
        var mins = d.getMinutes();
        var realTime = ' '+hrs+':'+mins+'<br>';
        return realTime;
}

//function getAllItems(data) {
//    
//
//    var items = data.items;
//    var total = data.itemtotal;
//
//    var msg = '';
//
//    for (var i =0; i<total; i++) {
//
//        msg+= '<div id="all" class="'+ items[i].groupid + '">' 
//                + items[i].groupid + ' - ' 
//                + items[i].volume + ' - ' 
//
//                //+'<img src="img/'+items[i].volume+'.jpg" alt="'+items[i].volume+'" height="60" width="60" /> '
//                + items[i].callno.slice(1) + ' - '
//                + items[i].note + ' - ';
//
//        //not available
//        if (!items[i].available) {
//            msg+= 
//                + items[i].available + ': '
//                //+ items[i].due + ': '
//                +' not available </div>';
//        } else { //available
//            msg+='</div>';
//        }
//
//
//    }
//    
//    return msg;
//}

//function cluster() {
//        //var max = $('all').last();
//    for (var i = 0; i<32; i++) {
//        
//        var nr = $('.'+(i+1)+'').length;
//        
////        var thisArticle = $("div").filter(i);
////        var nr = thisArticle.length;
//        $("#cluster").append("<div id="+(i+1)+">There are "+nr+" in Total from Article "+(i+1)+"</div>");
//        
//    }
//}


