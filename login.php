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
            <!--TEMP
            <h1 class="header"> Please sign in with Google. </h1>
            <div class="g-signin2" data-onsuccess="onSignIn">button</div>
            TEMP END-->

            <div class="registerSide">
                <div class="header"> Register </div>
                <input type="text" placeholder="First Name" class="firstNameField"></input>
                <input type="text" placeholder="Last Name" class="lastNameField"></input>
                <input type="email" placeholder="Email" class="emailField"></input>
                <input type="password" placeholder="Password" class="passwordField"></input>
                <input type="password" placeholder="Confirm Password" class="confirmPasswordField"></input>
                <input type="text" placeholder="Street Name" class="streetField"></input>
                <input type="text" placeholder="Postal Code" class="postalFIeld"></input>
                <input type="text" placeholder="House Number" class="houseField"></input>
                <input type="tel" placeholder="Phone Number" class="phoneField"></input>
                <div class="policyWrapper">
                    <input type="checkbox" class="acceptPolicy">
                    <div class="policyHolder"><a class="policyLink" href="#">I agree with the terms and conditions</a></div>
                </div>
                <button class="buttonSubmit"> Register </button> 


            </div>

            <div class="loginSide">
            </div>

        </div>
    </body>
</html>


 