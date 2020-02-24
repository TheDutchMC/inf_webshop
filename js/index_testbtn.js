var btn = document.getElementsByClassName('testButton')[0];

btn.addEventListener('click', function() {

    $.ajax({
        method: "POST",
        url: "php/user.php",
        data: {
            'goal': "updateUser",
            'password': "test",
            'firstName': "fn",
            'lastName': "ln",
            'email': "test@example.com",
            'street': "1",
            'postal': "1",
            'house': "1",
            "phone": "100",
        }
    }).done(function(msg) {
        console.log("Callback \n" + msg);
    });

    console.log("Button Pressed");
});
