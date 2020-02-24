//Copyright (C) 2020 Tobias de Bruijn (TheDutchMC)
var profile = null;
var signedIn = false;

function onSignIn(googleUser) {
    profile = googleUser.getBasicProfile();
    signedIn = true;
    console.log('ID: ' + profile.getId());
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail());
    
    var userEntity = {};
    userEntity.id = profile.getId();
    userEntity.name = profile.getName();
    userEntity.email = profile.getEmail();

    sessionStorage.setItem('userEntity', JSON.stringify(userEntity));

    var goal = "newUser";

    $.ajax({
        method: "POST",
        url: "php/backend_rec.php",
        data: {
            'goal': goal,
            'userid': userEntity.id
        }
    }).done(function(msg) {
        console.log("Callback \n" + msg);
    });

 //   window.location.replace('http://inf.thedutchmc.nl/store.php');
}

function logout() {
    sessionStorage.removeItem('userEntity');
}