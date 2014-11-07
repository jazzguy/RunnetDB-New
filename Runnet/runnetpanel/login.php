<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 2014-11-04
 * Time: 17:01
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
            <li><a href="#">Login</a></li>
            <li><a href="forgotpw.php">Forgot Password</a></li>

        </ul>


    </div>
</div>
<div class="pageWrapper">

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
                                    <input type="text" class="form-control" id="runnetdbUser" placeholder="Username">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                                <div class="col-lg-10">
                                    <input type="password" class="form-control" id="runnetdbPass" placeholder="Password">

                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="forgotpw.php"> <button style="float:left;" type="button" class="btn btn-default" data-dismiss="modal">Forgot password</button></a>
                    <button type="button" class="btn btn-primary">Login</button>
                </div>
            </div>
        </div>
    </div>



</div>


</body>

</html>