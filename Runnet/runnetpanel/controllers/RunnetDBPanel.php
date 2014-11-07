<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 2014-11-04
 * Time: 17:06
 */



class RunnetDBPanel {

    private $RunnetDB;

    private static $keywordValidations = [
        "letters" => "@[a-zA-Z]@",
        "numbers" => "@[0-9]@",
        "numbersLetters" => "@[a-zA-Z0-9]@",
        "other" => "@[a-zA-Z0-9_.,!:;()/&%#'=]@"
    ];

    public $userSession;
    public $userToken;

    public function __construct($runnetDB){
        $this->RunnetDB = $runnetDB;

        if(isset($_SESSION["user"]) && isset($_SESSION["token"])){

            $this->userSession = $_SESSION["user"];
            $this->userToken = $_SESSION["token"];

        }


    }


    public static function valid($type, $var){
        if(array_key_exists($type, self::$keywordValidations)){
            return preg_match(self::$keywordValidations[$type], $var) ? true : false;
        }
    }

    public static function isEmpty($var){
        return empty($var) ? true : false;
    }

    public function offlinePage(){

        if($this->userSession && $this->userToken){

            header("Location:dashboard.php");
            exit;

        }

    }

    public function onlinePage(){

        if(!$this->userSession && !$this->userToken){
            header("Location:index.php");
            exit;
        }


    }



} 