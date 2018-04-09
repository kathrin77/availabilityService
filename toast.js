/* 
 * Toast template by Kamran Ahmed, 
 * https://github.com/kamranahmedse/jquery-toast-plugin
 * angepasst: Kathrin Heim
 */


function loadtoast(note) {
    
    $.toast({
        text: note, // Text that is to be shown in the toast
        heading: "Detail-Information", // Optional heading to be shown on the toast
        icon: 'info', // Type of toast icon
        showHideTransition: 'plain', // fade, slide or plain
        allowToastClose: true, // Boolean value true or false
        hideAfter: 6000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
        stack: 1, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
        position: 'mid-center', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values



        textAlign: 'left',  // Text alignment i.e. left, right or center
        loader: true,  // Whether to show loader or not. True by default
        loaderBg: 'darkgreen',  // Background color of the toast loader
        bgColor: 'lightgray',
        textColor: 'black'
    });
}