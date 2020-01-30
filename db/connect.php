<!--
Copyright (C) 2020 Tobias de Bruijn (TheDutchMC)
-->

<?php
$servername = "127.0.0.1:3307";
$username = "root";
$password = "";

try {
    $handle = new PDO("mysql:host=$servername;dbname=eshop", $username, $password);

    $handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e) {
    die("Oops! Something went wrong when trying to connect to the databse. Please try again later!");
    }

try {
    $stmt = $handle->prepare("SELECT * FROM items");
    $stmt->execute();

    if($stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);

        $myfile = fopen("data/data.json", "w");
        fwrite($myfile, $json);
    } else {
        echo "Database is empty!";
    }
} catch(PDOException $e) {
    die("Error: ". $e->getMessage());
}

?>