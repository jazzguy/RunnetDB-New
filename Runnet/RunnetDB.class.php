<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 2014-09-17
 * Time: 16:04
 */



class RunnetDB{

    public $_runnetDBUsers = [];
    public $JSONEncodeValues = [];
    public $jsonTest;
    public $getCombinedValues = [];
    public $combineAgainValues = [];


    private $_useValues = [];
    private $selectColumn;
    private $tableName;
    private $_i;
    private $_whereValues = [];
    private $_deleteJSONValues;
    private $_deleteJSONValuesLINK;
    private $_newCombinedValues  = [];
    private $_useWhere = [];
    private $_toUpdate;
    private $_connection = false;
    private $_dbuserhandlerPath = [];
    private $_limit = [];


    public function __construct(){

        include 'configs.php';

        $this->_dbuserhandlerPath = $config;

        define('ROOT_PATH', __DIR__);
        $this->_runnetDBUsers = $this->getDatabaseUsers();

        define("JSONPATH", $this->_dbuserhandlerPath["pathToDbuserhandler"] . $this->_runnetDBUsers["database"] . "/");
        define("JSON", ".json");



    }
    /*
     *
     * RunnetDB Connection
     *
     */

    public function connect($username, $password, $database){

            $this->keyExists("user", $this->_runnetDBUsers);
            $this->keyExists("password", $this->_runnetDBUsers);
            $this->keyExists("database", $this->_runnetDBUsers);

            $this->isTrue("user", $username);
            $this->isTrue("password", $password);
            $this->isTrue("database", $database);

            $this->_connection = true;

    }

    public function checkConnection(){
        return $this->_connection === false;
    }


    /*
     *
     * Random funktioner
     *
     */

    public function keyExists($key, $array){
        return array_key_exists($key, $array) ? true : false;
        return $this;
    }

    public function getJSON($file, $type){

        $file = file_get_contents($file);
        return json_decode($file, $type);

    }


    public function failed($msg){
        die($msg);
    }

    public function filePath($tableName, $type){
        return JSONPATH . $tableName . "/" . $tableName . "." . $type . JSON;
    }


    public function doesFileExist($file, $ifTrue, $ifFalse){
        return file_exists($file) ? $ifTrue : $ifFalse;
    }

    /*
     *
     * Databas funktioner
     *
     */

    public function isTrue($key, $value){

        return $this->_runnetDBUsers[$key] == $value ? true : die("RunnetDB : Could not connect, wrong in the configs");

    }


    public function getDatabaseUsers(){
        $getDatabaseUsersFile = file_get_contents($this->_dbuserhandlerPath["pathToDbuserhandler"] . ".databaseusers.json");
        return json_decode($getDatabaseUsersFile, true);

    }

    public function getCurrentDatabase(){
        return $this->_runnetDBUser->{"database"};
    }

    public function createDatabase(){

        if(!file_exists($this->_dbuserhandlerPath["pathToDbuserhandler"] . $this->_runnetDBUsers["database"])){

            mkdir($this->_dbuserhandlerPath["pathToDbuserhandler"] . $this->_runnetDBUsers["database"]);

            $file = fopen($this->_dbuserhandlerPath["pathToDbuserhandler"] . $this->_runnetDBUsers["database"] . "/.htaccess", 'w');
            fwrite($file, "Deny from all");
            fclose($file);

        }

    }


    public function getDatabase(){

        $folders = glob($this->_dbuserhandlerPath["pathToDbuserhandler"] . '/*' , GLOB_ONLYDIR);
        return $folders;

    }

    public function getDatabaseTables($db){

        $folders = glob($this->_dbuserhandlerPath["pathToDbuserhandler"] . $db . '/*' , GLOB_ONLYDIR);
        return $folders;

    }

    public function getDatabaseTablesColumn($db, $table){
        $getJSONColumns = file_get_contents($this->_dbuserhandlerPath["pathToDbuserhandler"] . $db . '/' . $table . '/' . $table . '.table.json');
        $decodeColumns = json_decode($getJSONColumns, true);
        return $decodeColumns;


    }

    public function getDatabaseTablesRows($db, $table){

        $getJSONValues = file_get_contents($this->_dbuserhandlerPath["pathToDbuserhandler"] . $db . '/' . $table . '/' . $table . '.value.json');
        $decodeValues = json_decode($getJSONValues, true);
        return $decodeValues;

    }

    /*
     *
     * Tabell funktioner
     *
     */


    public function newTable($tableName, $columns = []){

            $this->doesFileExist(JSONPATH . $tableName . "/" . $tableName . ".table" . JSON, false, true);
            $this->doesFileExist(JSONPATH . $tableName, false, true);

            mkdir(JSONPATH . $tableName);
            $createTable = fopen(JSONPATH . $tableName . "/" . $tableName . ".table" . JSON, "w");

            $encode = json_encode($columns);
            fwrite($createTable, $encode);
            fclose($createTable);


            $createTableValue = fopen(JSONPATH . $tableName . "/" . $tableName . ".value" . JSON, "w");
            fwrite($createTableValue, "");
            fclose($createTableValue);


    }




    public function deleteTable($tableName){

        $tablePath = $this->_dbuserhandlerPath["pathToDbuserhandler"] . $this->_runnetDBUsers["database"] . "/" . $tableName;

        if(file_exists($tablePath)){
            $open = fopen($tablePath . "/" . $tableName . ".table.json", "w");
            fclose($open);
            unlink($tablePath . $tableName . ".table.json");
            rmdir($tablePath);

        }else{
            $this->failed("The table you're trying to delete, does not exist");
        }

    }

    /*
     *
     * Insert into funktioner
     *
     */

    public function useValues($useValues = []){
        $this->_useValues = $useValues;
        return $this;
    }

    public function insertInto($tableName){

        if(is_array($this->_useValues)){

            if(!empty($tableName)){


                    $getContent = $this->getJSON($this->filePath($tableName, "value"), true);
                    $decodeColumnContent = $this->getJSON($this->filePath($tableName, "table"), true);


                    if(empty($getContent)){

                    $newValuesAgain = $this->_useValues;

                    $combine[] = array_combine($decodeColumnContent, $newValuesAgain);
                    $encodeValues = json_encode($combine);

                    file_put_contents($this->_dbuserhandlerPath["pathToDbuserhandler"] . $this->_runnetDBUsers["database"] . "/" . $tableName . "/" . $tableName . ".value.json", $encodeValues);
                    return false;

                }else{

                    $decodeValues = $getContent; // tar allt från värde tabellen

                    $combine[] = array_combine($decodeColumnContent, $this->_useValues);


                    $mergeNewValuesAndDecodeValues = array_merge($decodeValues, $combine);

                    $encodeMergeValues = json_encode($mergeNewValuesAndDecodeValues);

                    file_put_contents($this->_dbuserhandlerPath["pathToDbuserhandler"] . $this->_runnetDBUsers["database"] . "/" . $tableName . "/" . $tableName . ".value.json", $encodeMergeValues);


                }


            }else{
                $this->failed("You cannot leave table name empty.");
            }

        }else{
            $this->failed("Second parameter must be an array.");
        }

        return $this;

    }


    /*
     *
     * Select funktioner
     *
     */


    public function prepareSelect($tableName){

        $this->tableName = $tableName;

        $getJSONColumns = $this->getJSON($this->filePath($tableName, "table"), true);
        $newJSONColumns[] = $getJSONColumns;

        $getJSONValues = $this->getJSON($this->filePath($tableName, "value"), true);


        if(!empty($this->_useWhere) && is_array($this->_useWhere)){

            $i = 0;
            foreach($getJSONValues as $key => $val){

                foreach($val as $vkey => $vval){

                    foreach($this->_useWhere as $wkey => $wval){

                        if($vkey == $wkey && $wval == $vval){

                            $this->_whereValues[] = $val;

                        }

                    }

                }

                $i++;
            }

        }else{
            $s = 0;
            foreach($getJSONValues as $key => $val){

                $combineValues[$s] = array_combine($getJSONColumns, $getJSONValues[$s]);
                $s++;

                $this->getCombinedValues = $combineValues;
                $this->_whereValues = $this->getCombinedValues;

            }
        }



    return $this;


    }





    public function result(){
        return $this->_whereValues;
    }

    public function getResult(){

        $i = 0;
        foreach($this->_whereValues as $key => $val){

            return $this->_whereValues;
            $i++;
        }

    }


    /*
     *
     * Delete funktioner
     *
     */

    public function prepareDelete($tableName){

        $file = $this->filePath($tableName, "value");
        $this->_deleteJSONValuesLINK = $file;
        $getJSONValues = $this->getJSON($file, true);
        $this->_deleteJSONValues = $getJSONValues;

        return $this;
    }

    public function executeDelete(){

        if($this->_useWhere){

            $i = 0;

            foreach($this->_deleteJSONValues as $key => $val){

               foreach($this->_useWhere as $wkey => $wval){

                   foreach($val as $vkey => $vval){

                       if($vkey == $wkey && $vval == $wval){

                           unset($this->_deleteJSONValues[$i]);

                           sort($this->_deleteJSONValues);

                           $newJSONValues = json_encode($this->_deleteJSONValues);

                           file_put_contents($this->_deleteJSONValuesLINK, $newJSONValues);

                       }

                   }
                   $i++;


               }

            }

        }else{
            $i = 0;
            foreach($this->_deleteJSONValues as $key => $val){

                unset($this->_deleteJSONValues[$i++]);

                $newJSONValues = json_encode($this->_deleteJSONValues);

                file_put_contents($this->_deleteJSONValuesLINK, $newJSONValues);


            }


        }

         return $this;

    }


    /*
     *
     * Update funktioner
     *
     */



    public function update($tableName){


        $valueJSON = $this->getJSON($this->filePath($tableName, "value"), true);


         if(!empty($this->_useWhere) && !empty($this->_toUpdate)){


                $i = 0;
                foreach($valueJSON as $key => $val){

                    foreach($val as $vkey => $vval){

                        foreach($this->_useWhere as $wkey => $wval){

                            if($vkey == $wkey && $wval == $vval){

                                $this->_whereValues[] = $val;

                                $newValues[] = array_replace($val, $this->_toUpdate);


                                unset($valueJSON[$i]);
                                $addNewArray = array_merge($valueJSON, $newValues);

                                $newJSONValues = json_encode($addNewArray);

                                file_put_contents($this->filePath($tableName, "value"), $newJSONValues);

                            }


                        }


                    }


                    $i++;

                }


        }

        return $this;


    }

    public function toUpdate($columns = [], $values = []){
        if(array_count_values($columns) && array_count_values($values)){
            $this->_toUpdate = array_combine($columns, $values);
        }

    }



    public function limit($amount){

        //self::dump($this->_whereValues);
        $p = 0;
        while($p < $amount){

            $this->_limit[$p] = $this->_whereValues[$p];

            $p++;

        }

        $this->_whereValues = $this->_limit;
        return $this;

    }

    /*
     *
     * Where funktioner
     *
     */

    public function where($column = [], $value = []){

        if(array_count_values($column) && array_count_values($value)){
            $this->_useWhere = array_combine($column, $value);
        }
        return $this;

    }

    public function sortBy($type){

        if($type == "desc" || $type  == "asc"){
            $type == "asc" ? array_multisort($this->_whereValues, SORT_ASC) : array_multisort($this->_whereValues, SORT_DESC);
        }else{
            die("sortBy : You can only use desc or asc");
        }
        return $this;


    }

    public static function dump($code){
        echo '<pre>';
        print_r($code);
        echo '</pre>';
    }


} // slut på classen

