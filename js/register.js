//When the document is loaded we call the ready function
$(document).ready(function() {
    ready()
});

function ready() {
    //The Register button
    var registerBtn = document.getElementsByClassName("buttonRegister")[0];

    //Add a listener to that button
    registerBtn.addEventListener('click', function() {

        //Get all the fields
        var firstNameField = document.getElementsByClassName("firstNameField")[0];
        var lastNameField = document.getElementsByClassName("lastNameField")[0];
        var emailField = document.getElementsByClassName("emailField")[0];
        var passwordField = document.getElementsByClassName("passwordField")[0];
        var confirmPasswordField = document.getElementsByClassName("confirmPasswordField")[0];
        var streetField = document.getElementsByClassName("streetField")[0];
        var postalFIeld = document.getElementsByClassName("postalFIeld")[0];
        var houseField = document.getElementsByClassName("houseField")[0];
        var phoneField = document.getElementsByClassName("phoneField")[0];
        
        //Get the policy accept checkox
        var acceptPolicyCheckbox = document.getElementsByClassName("acceptPolicy")[0];

        //Get the values of the fields
        var firstName = firstNameField.value;
        var lastName = lastNameField.value;
        var email = emailField.value;
        var password = passwordField.value;
        var confirmPassword = confirmPasswordField.value;
        var street = streetField.value;
        var postal = postalFIeld.value;
        var house = houseField.value;
        var phone = phoneField.value;
        
        var fieldsFilled = false;
        
        //Get the responseField, we use this field for response messages that the user needs to know
        var responseField = document.getElementsByClassName('response')[0];
        
        //Check if the required fields are filled in, which is all but the phone field
        if(!(firstName == "" && lastName == "" && email == "" && password == "" && confirmPassword == "" && street == "" && postal == "" && house == "")) {
            fieldsFilled = true;
        } else {
            responseField.innerText = "You need to fill in all the required fields!";
            //TODO change text color!
        }

        //Get the value of the policy accept checkbox
        var acceptPolicy = acceptPolicyCheckbox.checked;

        //Check if the checkbox is checked, it needs to be. 
        if(acceptPolicy && fieldsFilled) {
            //Clear the response field, we don't have an issue right now
            responseField.innerText = "";

            var canSignup = true;

            //Check if the two passwords given by the user match, if they dont inform them and set the canSignup variable to false
            if(password != confirmPassword) {
                canSignup = false;
                responseField.innerText = "The passwords do not match!"
            } else {
                //Good, we can continue

                //Check if the password meets the required confitions
                //For that we need to convert the password to a character array first
                var passwordChars = Array.from(password);

                //Initialize the variables, we do this here because of the scope
                var hasHigher = false;
                var hasNumber = false;
                var hasLower = false;
                var hasSpecial = false;
                var longEnough = false;

                //Which characters count towards what group
                var lower = "abcdefghijklmnopqrstuvwxyz"
                var higher = lower.toUpperCase();
                var number = "1234567890"
                var special = "!@#$%^&*(){}[]|;:.,<>?/~`=-_+"

                //Convert the variables above into an array
                var lowerChars = Array.from(lower);
                var higherChars = Array.from(higher);
                var numberChars = Array.from(number);
                var specialChars = Array.from(special);
                
                //Check if the password is 8 characters long or longer
                longEnough = (passwordChars.length >= 8) ? true : false;

                //Loop over every character in the password, check if it matches one of the categories
                for(var i = 0; i < passwordChars.length; i++) {
                    
                    //Loop over every lower case character, check if any matches the password character the iterator is at
                    lowerChars.forEach(function(entry) {
                        if(entry == passwordChars[i]) {
                            hasLower = true;
                        }
                    });

                    //Loop over every higher case character, check if any matches the password character the iterator is at
                    higherChars.forEach(function(entry) {
                        if(entry == passwordChars[i]) {
                            hasHigher = true;
                        }
                    });
                    
                    //Loop over every number, check if any matches the password character the iterator is at
                    numberChars.forEach(function(entry) {
                        if(entry == passwordChars[i]) {
                            hasNumber = true;
                        }
                    });

                    //Loop over every special character, check if any matches the password character the iterator is at
                    specialChars.forEach(function(entry) {
                        if(entry == password[i]) {
                            hasSpecial = true;
                        }
                    })
                }

                //Turn the streets variable into an array of characters
                var streetChars = Array.from(street);

                //Loop over all the characters. replace ' and " with blanks.
                for(var i = 0; i < streetChars.length; i++) {
                    if(streetChars[i] == '\'' || streetChars[i] == '\"') {
                        streetChars[i] = "";
                    }
                }

                street = streetChars.join("");

                //Check if all the requirments are met, if not check which isn't met
                if(hasLower && hasHigher && hasNumber && hasSpecial && longEnough) {
                    //Good! all the requirments are met. continue!
                
                    register(firstName, lastName, email, password, street, postal, house, phone);
                } else {
                    
                    //Check if it doesn't have a lower case character
                    if(!hasLower) {
                        responseField.innerText = "You need to have at least one lower case character in your password!";

                    //Check if it doesnt have a capital letter
                    } else if (!hasHigher) {
                        responseField.innerText = "You need to have at least one capital letter in your password!";

                    //Check if it doesn't have a number
                    } else if(!hasNumber) {
                        responseField.innerText = "You need to have at least one number in your password!";

                    //Check if it doesn't have a special character
                    } else if(!hasSpecial) {
                        responseField.innerText = "You need to have at least one special character in your password!";

                    //Check if it isn't long enough
                    } else if(!longEnough) {
                        responseField.innerText = "Your password needs to be at least eight characters long!";

                    }
                }   
            }

        } else {
            //Checkbox isn't checked, inform the user
            responseField.innerText = "You need to accept our terms and conditions to register!";
        }

    });
}

function register(firstName, lastName, email, password, street, postal, house, phone) {

    $.ajax({
        method: "POST",
        url: "php/user.php",
        data: {
            "goal": "newUser",
            "password": password,
            "firstName": firstName,
            "lastName": lastName,
            "email": email,
            "street": street,
            "postal": postal,
            "house": house,
            "phone": phone
        }
    }).done(function(msg) {
        //TODO, do something with callback
        console.log(msg);
    });
}