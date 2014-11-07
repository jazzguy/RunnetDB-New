<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 2014-11-03
 * Time: 21:52
 */



include 'global.php';
?>


<html>

    <head>

        <title>RunnetDBPanel</title>

        <link href="/Runnet/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="/Runnet/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/Runnet/css/panel.css" rel="stylesheet" type="text/css" />


    </head>

    <body>



    <div class="navbar navbar-inverse">
        <div class="navbar-header">
            <a id="runnetdbpanel" class="navbar-brand" href="#">RunnetDB Panel</a>
        </div>
        <div class="navbar-collapse collapse navbar-inverse-collapse">
            <ul class="nav navbar-nav">

                <li><a href="howtouse.php">How to use RunnetDB</a></li>
                <li><a href="#">Methods/Functions</a></li>
                <li><a href="#">Predefined Constants</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="forgotpw.php">Forgot Password</a></li>

            </ul>


        </div>
    </div>
    <div class="pageWrapper">
    <div id="welcome" class="alert alert-dismissable alert-warning">

        <h4>Hello</h4>
        <p>Thank you for installing RunnetDB. This is RunnetDB v0.4 BETA Panel. This panel makes everything easier for you to manage! And yes, the panel is bootstrapped. Press <a href="http://bootswatch.com/yeti/">here</a> for more about the bootstrap!<br><br>
            If you find any bugs, please report to <a href="#">RunnetDB</a><br><br> - RunnetDB Team

        </p>
    </div>

    <div class="panel panel-info" id="infoRunnet">
        <div class="panel-heading">
            <h3 class="panel-title">About RunnetDB</h3>
        </div>
        <div class="panel-body">
            <p id="infoAboutContent">RunnetDB is a JSON data engine. All data is stored in JSON files. <br>
            No stuff such as SQL injections is possible.
            Our goal is to make a very secure data engine and very easy to use. In the future, you'll not need any PHP experience to use RunnetDB!<br><br>
            RunnetDB is simple, and quick! You chose the right data engine. :)


            </p>
        </div>
    </div>

    <div id="pics" class="well well-lg">
        <img id="pic1" src="/Runnet/css/someCodes.png" />
    </div>

        <div class="panel panel-default" id="copyright">
            <div class="panel-body">
                <h6 style="margin-top:3px;text-align:center;">&copy; RunnetDB 2015 | Runnet Productions</h6>
            </div>
        </div>







    </div>




    </body>

</html>