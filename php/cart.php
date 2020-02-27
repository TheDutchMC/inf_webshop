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
if($rec_goal === "addToCart") {

    //Pull statement to get the whole shoppingcart table from the database
    $pull_carts_stmt = "SELECT * FROM shoppingcart";

    //Prepare and execute the statement
    $getCarts = $handle->prepare($pull_carts_stmt);
    $getCarts->execute();

    //Fetch all the rows, and put them into this aray
    $carts = $getCarts->fetchAll();

    //Variable declaration- here because of scope
    $cartExists = false;
    $cartId;

    //Loop over all the carts and check if the cart of the user already exists
    foreach($carts as $cart) {
        $userId = $cart['user_id']

        //Check if the user has a cart, if so set the cartId variable to the cartId that they already have
        if($userId === $rec_userid) {
            $cartExists = true;

            //Set the cartId
            $cartId = $cart['cart_id'];
        }
    }

    //Check if the cart doesn't exist
    if(!$cartExists) {

        //Generate a 12 character cartId for the new cart
        $cartId = bin2hex(openssl_random_pseudo_bytes(6));

        //Statement to create the new cart, we set the cart id and user id, leave the item_id blank for now
        $createCart_inj_stmt = "INSERT INTO shoppingcart SET cart_id = '${cart_id}', user_id = '${$user_id}'";
        
        //Prepare and execute the statement
        $createCart = $handle->prepare($createCart_inj_stmt);
        $createCart->execute();

        //Set the cartExists variable to true
        $cartExists = true;
    }

    //Check if the cart does exist. Did not do an else on the previous statement since this needs to be run after that, not instead of
    if($cartExists) {
        //Pull the specific cart we need from the database
        $pull_cart_stmt = "SELECT * FROM shoppingcart WHERE cart_id = '${$cartId}'";

        //Prepare and execute the statement
        $getCart = $handle->prepare($pull_cart_stmt);
        $getCart->execute();

        //Fetch the specific cart, put it into an array
        $cart = $getCart->fetch();

        //Grab the items in the cart and put them into the variable
        $itemsInCart = $cart['item_id'];

        //Variable declaration- here because of scope
        $inCart = false;
        $itemsArr = [];
    
        //Check if the string is empy
        if($itemsInCart !== null || $itemsInCart !== "") 
            
            //The itemsInCart variable is a String, turn it into an array{
            $itemsArr = explode("," $itemsInCart);
            
            //Loop over every item in the array
            foreach($itemsArr as $item) {

                //Check if the item in the array the iterator is at is the same as the item id we received,
                //if so report this, and set the inCart variable accordingly
                if($item === $rec_item_id) {
                    echo "failed:alreadyInCart";
                    $inCart = true;
                }
            }
        }

        //Check if the item is not in the cart 
        if(!$inCart) {

            //Add the received item id to the array
            array_push($itemsArr, ",".$rec_item_id);
            
            //Implode the array back into a String, comma seperated
            $newCart = implode(",", $itemsArr);

            //Statement to update the item_id field of the user in the shoppingcart table
            $cart_inj_stmt = "UPDATE shoppingcart SET item_id = '${$newCart}' WHERE cart_id = '${cartId}'";

            //Prepare and execute the statement
            $updateCart = $handle->prepare($cart_inj_stmt);
            $updateCart->execute();

            //Now we need to create an entry in the cart_items table

            //Injection statement to insert into the cart_items table, we set qty to 1 because the user only added one item to their cart.
            $cartItem_inj_stmt = "INSERT INTO cart_items SET
                item_id = '${rec_item_id}', 
                cart_id = '${cartId}',
                qty = '1',
                price = '${rec_price}'";

            //Prepare and execute the statement
            $insertCartItem = $handle->prepare($cartItem_inj_stmt);
            $insertCartItem->execute();

            //Report back to the client
            echo "succes:addedToCart";
        }
    }
} else if($rec_goal === "changeQty") {

} else if($rec_goal === "removeFromCart") {

}
?>