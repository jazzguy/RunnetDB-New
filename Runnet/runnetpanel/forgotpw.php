<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 2014-11-04
 * Time: 16:34
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
        <a id="runnetdbpanel" class="navbar-brand" href="index.php">RunnetDB Panel</a>
    </div>
    <div class="navbar-collapse collapse navbar-inverse-collapse">
        <ul class="nav navbar-nav">

            <li><a href="howtouse.php">How to use RunnetDB</a></li>
            <li><a href="#">Methods/Functions</a></li>
            <li><a href="#">Predefined Constants</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="#">Forgot Password</a></li>

        </ul>


    </div>
</div>
<div class="pageWrapper">
    <div id="wayone" class="alert alert-dismissable alert-success">

        <h4>Config file (recommended)</h4>
        <p>
            Probably easiest way to retrieve your password or username is through the config file.<br>
            If you go to the folder <strong>dbuserhandler</strong> in <strong>Runnet</strong> folder.
            There should be a JSON file called <strong>.databaseusers</strong>. Open the file using notepad.
            Stuff such as <strong>user</strong> and <strong>password</strong> will show up. Now you can easily copy what
            you've forgotten, and login!

        </p>

    </div>



    <div id="wayone" style="margin-top:20px;" class="alert alert-dismissable alert-warning">
        <h4>Un-install</h4>
        <p>
            The second way is by re-installing RunnetDB. But note that, <strong>you will lose all data</strong>.
            All databases, tables, columns, rows, values and so on, will be lost.

        </p>

    </div>


</div>



</body>

</html>