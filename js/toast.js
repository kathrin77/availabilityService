/* 
 * Toast template by Kamran Ahmed, 
 * https://github.com/kamranahmedse/jquery-toast-plugin
 * adapted by: Kathrin Heim
 * Loads a toast message with the passed note.
 */


function loadtoast(note) {
    
    $.toast({
        text: note, // Text that is to be shown in the toast
        heading: "Detail-Information", // Optional heading to be shown on the toast
        icon: 'info', // Type of toast icon
        showHideTransition: 'plain', // fade, slide or plain
        allowToastClose: true, // Boolean value true or false
        hideAfter: 6000, // number representing the miliseconds as time after which toast needs to be hidden
        stack: 1, // number representing the maximum number of toasts to be shown at a time
        position: 'mid-center', // position of toast

        textAlign: 'left',  // Text alignment 
        loader: true,  // Whether to show loader or not. True by default
        loaderBg: 'darkgreen',  // Background color of the toast loader
        bgColor: 'lightgray',
        textColor: 'black'
    });
}