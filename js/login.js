//When the document is loaded we call the ready function
$(document).ready(function() {
    readyLogin()
});

function readyLogin() {
        //The Login button
        var loginBtn = document.getElementsByClassName("buttonLogin")[0];

        //Add a listener
        loginBtn.addEventListener('click', function() {
            //Get the fields
            var emailField = document.getElementsByClassName("emailLoginField")[0];
            var passwordField = document.getElementsByClassName("passwordLoginField")[0];

            //Get the values from the frields
            var email = emailField.value;
            var password = passwordField.value;

            var fieldsFilled = false;

            //Get the responseField, we use this field for response messages that the user needs to know
            var responseField = document.getElementsByClassName('responseLogin')[0];

            //Check if the email and password fields are filled in
            if(email != "" && password != "") {
                fieldsFilled = true;
            } else {
                responseField.innerText = "You need to fill in all the required fields!";
                console.log("fields empty");
                //TODO change text color!
            }
            if(fieldsFilled) {
                $.ajax({
                    method: "POST",
                    url: "php/user.php",
                    data: {
                        "goal": "login",
                        "password": password,
                        "email": email
                    }
                }).done(function(msg) {
                    if(msg == "loginAccepted") {
                        //TODO: after login, probably redirect to user dashboard
                    } else if(msg == "loginDenied:incorrectPassword") {
                        //Password is wrong
                        
                        responseField.innerText = "Password is incorrect!";
                    } else {
                        console.log(msg);
                    }
                });
            }
        })
}