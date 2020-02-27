<?php

//Set the variables, from a HTTP POST request.

//What is the goal of the request
$rec_goal = $_POST['goal'];

//Db login
$servername = "127.0.0.1:3307";
$username = "root";
$passw = "";

//Connect to the database.
try {
    $handle = new PDO("mysql:host=$servername;dbname=eshop", $username, $passw);

    $handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Oops! Something went wrong when trying to connect to the databse. Please try again later!");
}

//The goal is to create a new user
if($rec_goal === 'newUser') {

    //What is the user's password
    $rec_password = $_POST['password'];

    //User's first and last name
    $rec_firstName = $_POST['firstName'];
    $rec_lastName = $_POST['lastName'];

    //What is the user's email address
    $rec_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    //What is the user's street name
    $rec_street = $_POST['street'];

    //What is the user's postal code
    $rec_postal = $_POST['postal'];

    //What is the user's house number 
    $rec_house = $_POST['house'];

    //What is the user's phone number
    $rec_phone = $_POST['phone'];

    //Query the database's table 'users' to check if the user already exists
    $pull_stmt = "SELECT email FROM users";

    //Prepare and run the statement
    $getUsers = $handle->prepare($pull_stmt);
    $getUsers->execute();

    //Fetch the data and put it in an array
    $users = $getUsers->fetchAll();

    //Initialize variable
    $userExists = false;

    //Generate a userId based on the email with a MD5 hash
    $userId = md5($rec_email);

    //Loop over the array, if the user's email the iterator is at is the same as the received email, it is already in the database.
    foreach($users as $user) {

        //Generate a MD5 hash based on the email, this will be the userid

        if($user['email'] === $rec_email) {
            echo "userAlreadyExists";
            $userExists = true;
        }
    }

    if(!$userExists) {
        //User doesn't exist in the database, create a new user

        //Generate a salt
        $salt = bin2hex(openssl_random_pseudo_bytes(256));

        //Hash the password
        $iterations = 1000;
        $hash = hash_pbkdf2("sha256", $rec_password, $salt, $iterations, 512);

        //Generate the injection statement
        $inj_stmt = "INSERT INTO users SET 
            user_id = '${userId}',
            first_name = '${rec_firstName}',
            last_name = '${rec_lastName}', 
            email = '${rec_email}',
            password = '${hash}',
            street = '${rec_street}', 
            postal_code = '${rec_postal}', 
            house_number = '${rec_house}', 
            phone_number = '${rec_phone}',
            salt = '${salt}'";

        //Prepare and execute the statement.
        $newUser = $handle->prepare($inj_stmt);
        $newUser->execute();
    }
} elseif($rec_goal === "updateUser") {

    //What is the user's password
    $rec_password = $_POST['password'];

    //User's first and last name
    $rec_firstName = $_POST['firstName'];
    $rec_lastName = $_POST['lastName'];

    //What is the user's email address
    $rec_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    //What is the user's street name
    $rec_street = $_POST['street'];

    //What is the user's postal code
    $rec_postal = $_POST['postal'];

    //What is the user's house number 
    $rec_house = $_POST['house'];

    //What is the user's phone number
    $rec_phone = $_POST['phone'];


    //Generate the userId
    $userId = md5($rec_email);

    //Generate the pull statement
    $pull_stmt = "SELECT * FROM users WHERE user_id = '${userId}'";

    //Prepare and execute  the statement
    $getUser = $handle->prepare($pull_stmt);
    $getUser->execute();

    //Fetch the data
    $user = $getUser->fetch();

    //Grab the salt from the user
    $salt = $user['salt'];
    
    //Hash the received password
    $iterations = 1000;
    $hash = hash_pbkdf2("sha256", $rec_password, $salt, $iterations, 512);
    
    //Check if the generated hash matches the stored password
    if($hash === $user['password']) {

        //Declare the variables here, because of the scope
        //$newEmail;
        $newFirstName;
        $newLastName;
        $newPassword;
        $newStreet;
        $newPostal;
        $newHouse;
        $newPhone;

        //Check if the received value is null (if it is null the user didn't fill it in, thus doesn't want to change it.).
        //If it is null, grab the current value, and use that. If it is not null, use the received value
        //Structure: $var = (condition ? true : false);
        //$newEmail = ($rec_email === null ? $user['email'] : $rec_email);
        $newFirstName = ($rec_firstName === null ? $user['first_name'] : $rec_firstName);
        $newLastName = ($rec_lastName === null ? $user['last_name'] : $rec_lastName);
        $newStreet = ($rec_street === null ? $user['street'] : $rec_street);
        $newPostal = ($rec_postal === null ? $user['postal_code'] : $rec_postal);
        $newHouse = ($rec_house === null ? $user['house_number'] : $rec_house);
        $newPhone = ($rec_phone === null ? $user['phone_number'] : $rec_phone);

        //Same as above, but for the password. Needs to be in an if statement instead of ?: since it requires more lines of code to set a value for the false condition
        if($rec_password === null) {
            $newPassword = $user['password'];
        } else {
            //Grab the salt from the user
            $salt = $user['salt'];
    
            //Hash the received password
            $iterations = 1000;
            $hash = hash_pbkdf2("sha256", $rec_password, $salt, $iterations, 512);

            //Set the password equal to the generated hash
            $newPassword = $hash;
        }

        //Prepare the injection statement
        $inj_stmt = "UPDATE users SET
            first_name = '${newFirstName}',
            last_name = '${newLastName}',
            password = '${newPassword}',
            street = '${newStreet}',
            postal_code = '${newPostal}',
            house_number = '${newHouse}',
            phone_number = '${newPhone}' WHERE user_id = '${userId}'";

        //Prepare and execute the injection statement
        $updatedUser = $handle->prepare($inj_stmt);
        $updatedUser->execute();
    } else {
        echo "Password Incorrect!";
    }

//A user wants to login
} elseif($rec_goal === "login") {
    //What is the user's password
    $rec_password = $_POST['password'];

    //What is the user's email address
    $rec_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    //Generate a userId based on the email with a MD5 hash
    $userId = md5($rec_email);


    //Check if the user exists
    $pull_stmt = "SELECT * FROM users";

    $getUser = $handle->prepare($pull_stmt);
    $getUser->execute();
    
    $users = $getUser->fetchAll();

    $userExists = false;

    foreach ($users as $user) {
        if($user['user_id'] === $userId) {
            $userExists = true;
        }
    }

    if($userExists) {
        //Get the user from the database
        $pull_stmt = "SELECT * FROM users WHERE user_id = '${userId}'";

        //Prepare and run the statement
        $getUser = $handle->prepare($pull_stmt);
        $getUser->execute();
        
        //Fetch the data and put it in an array
        $user = $getUser->fetch();

        //Set the salt from the user, aquired from the database
        $salt = $user['salt'];

        //Hash the password we received from the client
        $iterations = 1000;
        $hash = hash_pbkdf2("sha256", $rec_password, $salt, $iterations, 512);

        //Check if the newly generated hash matches what we store in the database, if so, report back to the client,
        //if the hashes don't match, the password is wrong, report this back as well.
        if($hash === $user['password']) {
            echo "loginAccepted";
        } else {
            echo "loginDenied:incorrectPassword";
        }
    } else {
        echo "loginDenied:noUser";
    }
}
?>