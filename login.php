<!--
Copyright (C) 2020 Tobias de Bruijn (TheDutchMC)
-->
<!DOCTYPE html>
<html>
    <head>
        <!-- All the required scripts and stylesheets and tags that are the same across all pages-->
        <?php include "includes/head.php" ?>

        <!--Stylesheet specifically for this page-->
        <link rel="stylesheet" type="text/css" href="css/login.css"></link>
    </head>
    <body ng-app="ngCribs" ng-controller="cribsController">
        <!--Navigation bar-->
        <?php include "includes/mainnav.php" ?>

        <div class="login-wrapper">
            <h1 class="header"> Please sign in with Google. </h1>
            <div class="g-signin2" data-onsuccess="onSignIn">button</div>
        </div>
    </body>
</html>


 