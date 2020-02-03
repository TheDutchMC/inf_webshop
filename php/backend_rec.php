<?php

//Set the variables, from a HTTP POST request
$rec_goal = $_POST['goal'];
$rec_userid = $_POST['userid'];
$rec_item = $_POST['item'];
$rec_qty = $_POST['qty'];
$rec_price = $_POST['price'];

//Reply to the HTTP POST request
echo "received <br>";

//Db login
$servername = "127.0.0.1:3307";
$username = "root";
$password = "";

//Connect to the database
try {
    $handle = new PDO("mysql:host=$servername;dbname=eshop", $username, $password);

    $handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Oops! Something went wrong when trying to connect to the databse. Please try again later!");
}

//Check what the goal is of the POST request, and respond accordingly
if($rec_goal === "newUser") {

    $pull_stmt = "INSERT INTO cart (userid) VALUES ('${rec_userid}')";
    $handle->exec($pull_stmt); 

} else if($rec_goal === "addToCart") {

    
    //Statement to pull the required row from the db
    $pull_stmt = "SELECT userid, item_arr, item_qty_arr, item_price_arr FROM cart WHERE userid = '${rec_userid}'";

    //Execute the statement
    $result = $handle->query($pull_stmt);

    while($row = $result->fetch()) {

        //Put the values of the columns in the row into their variables
        $item_arr = $row['item_arr'];
        $item_qty_arr = $row['item_qty_arr'];
        $item_price_arr = $row['item_price_arr'];

        //Split the String of items, into an array
        $items = explode(",", $item_arr);

        $inDb = false;

        //Loop over every entry into the $items array
        foreach($items as $item) {

            //if the item where the iterator is currently at is equal to what the user wants to put in their cart, that means that the item is already in the cart, thus in the database
            if($item === $rec_item) {
                $inDb = true;
            }
        }

        //If the item is not in the database, put it there
        if($inDb === false) {

            //Build the new arrays, by taking the one pulled from the database, and adding the new entry, in case of quantity, this will always be one
            $new_item_arr = $item_arr . "," . $rec_item;
            $new_item_qty_arr = $item_qty_arr . "," . 1;
            $new_item_price_arr = $item_price_arr . "," . $rec_price;

            //Compose the SQL statement to update the database
            $inj_stmt = "UPDATE cart SET item_arr = '${new_item_arr}', item_qty_arr = '${new_item_qty_arr}', item_price_arr = '${new_item_price_arr}' WHERE userid = '${rec_userid}'";
            
            //Execute the statement
            $handle->exec($inj_stmt);
        }
    }

} else if($rec_goal === "updateQty") {


} else if($rec_goal === "removeFromCart") {


}
?>