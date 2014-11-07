<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 2014-11-04
 * Time: 20:49
 */

include 'global.php';

$runnetConfig = file_get_contents('../dbuserhandler/.databaseusers.json');
$getConfig = json_decode($runnetConfig, true);

$username = $_POST["runnetdbUser"];
$password = $_POST["runnetdbPass"];

if($username == $getConfig["user"] && $password == $getConfig["password"]){

    $_SESSION["user"] = $username;
    $_SESSION["token"] = str_shuffle("abdefghijklmnopqrstuvwxyz0123456789_");

    echo "Success!";

}else{
    echo '<h4>Ops!</h4>';
    echo '<p>Wrong password or username!</p>';
}




