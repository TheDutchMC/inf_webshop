<?php

//Set the variables, from a HTTP POST request.

//What is the goal of the request
$rec_goal = $_POST['goal'];

//What is the user's id
$rec_userid = $_POST['userid'];


//What is the id of the item we want to modify
$rec_item_id = $_POST['item_id'];

//What is the new quantity of the item
$rec_qty = $_POST['qty'];

//What is the price of the item
$rec_price = $_POST['price'];

//Db login
$servername = "127.0.0.1:3307";
$username = "root";
$password = "";

//Connect to the database.
try {
    $handle = new PDO("mysql:host=$servername;dbname=eshop", $username, $password);

    $handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Oops! Something went wrong when trying to connect to the databse. Please try again later!");
}

//Check what the goal is of the POST request, and respond accordingly.
if($rec_goal === "newUser") {

    //Get existing users


} else if($rec_goal === "addToCart") {

} else if($rec_goal === "changeQty") {

} else if($rec_goal === "removeFromCart") {

}
?>