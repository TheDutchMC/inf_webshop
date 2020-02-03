//Copyright (C) 2020 Tobias de Bruijn (TheDutchMC)
var popupElement = document.getElementsByClassName('popup-wrapper')[0];

$('.popup-wrapper').hide();
$('link[rel=stylesheet][href~="css/popup.css"]').remove();

function openPopup(text) {
    var popupMessageElement = popupElement.getElementsByClassName('popup-message')[0];
    popupMessageElement.innerText = text;

    $(".popup-wrapper").fadeIn(100);
    //popupElement.style.display = 'block';
    $('body').append('<link rel="stylesheet" type="text/css" href="css/popup.css">')


    var closePopupButton = document.getElementsByClassName('close-popup-btn')[0].addEventListener('click', closePopup);
}

function closePopup() {
    $('.popup-wrapper').fadeOut(120);
    setTimeout(removeStylesheet, 120);
 
}

function removeStylesheet() {
    $('link[rel=stylesheet][href~="css/popup.css"]').remove();
}