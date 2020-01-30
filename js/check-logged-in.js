checkLogin();

function checkLogin() {
    if(sessionStorage.getItem('userEntity') == null) {
        window.location.href = 'login.php';
    } else {
        var userEntity = {};
        userEntity = JSON.parse(sessionStorage.getItem('userEntity'));

        console.log("User is logged in with Email: " + userEntity.email);
        setLoggedInText(userEntity);
    }
}

function setLoggedInText(userEntity) {
    document.getElementById('loggedInDiv').innerHTML = "Welcome " + userEntity.name + "!";
}