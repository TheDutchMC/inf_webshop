<!--
COPYRIGHT (C) 2020 Tobias de Bruijn (TheDutchMC)

File structure:

/js_gen/ -- All JavaScript files that do not fit under any other category
/content/ -- Any media files required for the site
/css/ -- All the CSS files
/data/ -- JSON file (data.json) which stores every item sold
/db/ -- PHP file required for working with the Database
/img_store/ -- Any image that may be necessary in the store
/includes/ -- PHP pages that are used universally across the website
/jquery/ -- JQuery JavaScript Scripts
    - ajax/ -- Scripts using AJAX
/ng-cribs/scripts/ -- AngularJS
/pages/ -- PHP files that are required for specific pages, sorted into folders named after the page that requires it.

-->
<!DOCTYPE html>
<html>
    <head>
        <!-- All the required scripts and stylesheets and tags that are the same across all pages-->
        <?php include "includes/head.php" ?>

        <!-- Page specific stylesheet-->
        <link rel="stylesheet" type="text/css" href="css/index.css">
    </head>
    <body ng-app="ngCribs" ng-controller="cribsController">
        <!--Navigation Bar -->
        <?php include "includes/mainnav.php" ?>

        <div class="content-wrapper">
            <div class="label"> Welkom op de webshop van Tobias de Bruijn </div>
            <div class="section-languages">
                <br/>
                <div class="paragraph"> In deze site heb ik de volgende talen gebruikt: </div>
                <div class="ul">
                    <ul>
                        <li><div class="list-item">HTML</div></li>
                        <li><div class="list-item">CSS</div></li>
                        <li><div class="list-item">JavaScript</div></li>
                        <li><div class="list-item">PHP</div></li>
                    </ul>
                </div>
                <div class="paragraph"> Ik heb ook de volgende frameworks gebruikt: </div>
                <div class="ul">
                    <ul>
                        <li><div class="list-item">jQuery</div></li>
                        <li><div class="list-item">AngularJS</div></li>
                    </ul>
                </div>
                <div class="paragraph"> Ook gebruikt deze site een MySQL database. </br>Inloggen gaat via de Google Sign-In API</div>
            </div>
        </div>
    </body>
</html>


