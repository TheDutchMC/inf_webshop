//Copyright (C) 2020 Tobias de Bruijn (TheDutchMC)
var profile = null;
var signedIn = false;

var x = 5;

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
}

function logout() {
    sessionStorage.removeItem('userEntity');
}