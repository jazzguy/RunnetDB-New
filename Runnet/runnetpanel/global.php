<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 2014-11-04
 * Time: 17:10
 */

    session_start();


    require_once("../RunnetDB.class.php");
    require_once("controllers/RunnetDBPanel.php");

    $RunnetDB = new RunnetDB();
    $RunnetDBPanel = new RunnetDBPanel($RunnetDB);

