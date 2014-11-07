<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 2014-11-04
 * Time: 15:50
 */


    include 'global.php';

    $RunnetDBPanel->offlinePage();

?>



<html>

<head>

    <title>RunnetDBPanel</title>

    <link href="/Runnet/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="/Runnet/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/Runnet/css/panel.css" rel="stylesheet" type="text/css" />
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="/Runnet/runnetpanel/javascripts/main.js" type="text/javascript"></script>

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
            <li><a href="forgotpw.php">Forgot Password</a></li>

        </ul>


    </div>
</div>


</div>

<div class="pageWrapper">

     <div id="errorLogin" class="alert alert-dismissable alert-danger">
         <h4>Woah!</h4>
         <p>Please, login to access this page!</p>
     </div>


    <div class="modal" style="display:block;margin-top: 131px;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">Login to access!</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <fieldset>

                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label">Username</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="runnetdbUser" placeholder="Username" name="runnetdbUser">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                                <div class="col-lg-10">
                                    <input type="password" class="form-control" id="runnetdbPass" placeholder="Password" name="runnetdbPass">

                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="forgotpw.php"> <button style="float:left;" type="button" class="btn btn-default" data-dismiss="modal">Forgot password</button></a>
                    <button type="button" id="loginButton" class="btn btn-primary">Login</button>
                </div>
            </div>
        </div>
    </div>

    <div style="display:none" id="showLogin" class="alert alert-dismissable alert-danger">


    </div>

</div>


</body>

</html>