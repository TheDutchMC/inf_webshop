//Copyright (C) 2020 Tobias de Bruijn (TheDutchMC)
var hideCart = true;

//Check if we're in the store, if not, remove the shopping card icon.
$(document).ready(function() {
    var pageURL = $(location).attr("pathname");
    
    if(pageURL != "/store.php") {
        $('.default-hidden-cart').css('visibility','hidden')
    }
});
