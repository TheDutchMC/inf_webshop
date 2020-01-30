<!--
Copyright (C) 2020 Tobias de Bruijn (TheDutchMC)
-->
<!DOCTYPE html>
<html>
    <head>
        <?php
        //Connect to database
        require "db/connect.php";

        //All the required scripts and stylesheets and tags that are the same across all pages
        include "includes/head.php";
        ?>

        <!--Stylesheet specifically for this page-->
        <link rel="stylesheet" type="text/css" href="css/item-display.css"></link>

        <!-- The script that handles the shopping card-->
        <script src="js/store.js" async></script>
    </head>
    <body ng-app="ngCribs" ng-controller="cribsController">
        <?php 
        //Navigation bar
        include "includes/mainnav.php";

        //Signed in or not
        include "pages/logged-in.php";

        //Item Display
        include "pages/store/item-display.php";

        //Cart
        include "includes/cart.php";

        //Popup
        include "pages/store/popup.php";
        ?>
    </body>
</html>


