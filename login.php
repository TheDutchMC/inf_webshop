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
    <body>
        <!--Navigation bar-->
        <?php include "includes/mainnav.php" ?>

        <div class="login-wrapper">
            <!--TEMP
            <h1 class="header"> Please sign in with Google. </h1>
            <div class="g-signin2" data-onsuccess="onSignIn">button</div>
            TEMP END-->

            <div class="registerSide">
                <div class="header"> Register </div>
                <div class="response"> </div>
                <input type="text" placeholder="First Name" class="firstNameField input"></input>
                <input type="text" placeholder="Last Name" class="lastNameField input"></input>
                <input type="email" placeholder="Email" class="emailField input"></input>
                <input type="password" placeholder="Password" class="passwordField input"></input>
                <input type="password" placeholder="Confirm Password" class="confirmPasswordField input"></input>
                <input type="text" placeholder="Street Name" class="streetField input"></input>
                <input type="text" placeholder="Postal Code" class="postalFIeld input"></input>
                <input type="text" placeholder="House Number" class="houseField input"></input>
                <input type="tel" placeholder="Phone Number" class="phoneField input"></input>
                <div class="policyWrapper">
                    <table>
                        <tr>
                            <td><input type="checkbox" class="acceptPolicy"></td>
                            <td><div class="policyHolder"><a class="policyLink" href="#">I agree with the terms and conditions</a></div></td>
                        </tr>
                    </table>
                </div>
                <button class="buttonRegister"> Register </button>
            </div>

            <div class="loginSide">
                <div class="header"> Login </div>
                <div class="responseLogin"></div>
                <input type="text" placeholder="Email" class="emailLoginField input"></input>
                <input type="password" placeholder="Password" class="passwordLoginField input"></input>
                <button class="buttonLogin"> Login </button>
            </div>
        </div>

        <!--Script required for this page-->
        <script src="js/register.js"></script>
        <script src="js/login.js"></script>
    </body>
</html>


 