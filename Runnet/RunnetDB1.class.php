<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 2014-09-17
 * Time: 16:04
 */



class RunnetDB{

    public $_runnetDBUsers = [];

    public function __construct(){
        $getDatabaseUsersFile = $this->getDatabaseUsers();
        $this->_runnetDBUsers = json_decode($getDatabaseUsersFile);

        define("JSONPATH", "../dbuserhandler/" . $this->_runnetDBUsers->{"database"} . "/");
        define("JSON", ".json");

    }


    public function connect($username, $password, $database){

        if(array_key_exists("user", $this->_runnetDBUsers) && array_key_exists("password" , $this->_runnetDBUsers) && array_key_exists("database", $this->_runnetDBUsers)){

            $this->isTrue("user", $username);
            $this->isTrue("password", $password);
            $this->isTrue("database", $database);

        }else{
            throw new Exception($this->failed("Missing array in the user config"));
        }


    }


    public function getDatabaseUsers(){
        return file_get_contents("../dbuserhandler/.databaseusers.json");
    }

    public function isTrue($key, $value){
        $this->_runnetDBUsers->{$key} == $value ? true : die("RunnetDB:: Failed to connect. Check the configs!");
    }

    public function failed($msg){
        die($msg);
    }


    public function doesFileExist($file, $ifTrue, $ifFalse){
        return file_exists($file) ? $ifTrue : $ifFalse;
    }

    public function createDatabase(){

        if(!file_exists("../dbuserhandler/" . $this->_runnetDBUsers->{"database"})){

            mkdir("../dbuserhandler/" . $this->_runnetDBUsers->{"database"});

            $file = fopen("../dbuserhandler/" . $this->_runnetDBUsers->{"database"} . "/.htaccess", 'w');
            fwrite($file, "Deny from all");
            fclose($file);

        }

    }


    public function newTable($tableName, $columns = []){

            $this->doesFileExist(JSONPATH . $tableName . "/" . $tableName . ".table" . JSON, false, true);
            $this->doesFileExist(JSONPATH . $tableName, false, true);

            mkdir(JSONPATH . $tableName);
            $createTable = fopen(JSONPATH . $tableName . "/" . $tableName . ".table" . JSON, "w");

            $encode = json_encode($columns);
            fwrite($createTable, $encode);
            fclose($createTable);

            // creating the value file
            $createTableValue = fopen(JSONPATH . $tableName . "/" . $tableName . ".value" . JSON, "w");
            fwrite($createTableValue, "");
            fclose($createTableValue);


    }




    public function deleteTable($tableName){

        if(file_exists("../dbuserhandler/" . $this->_runnetDBUsers->{"database"} . "/" . $tableName)){
            $open = fopen("../dbuserhandler/" . $this->_runnetDBUsers->{"database"} . "/" . $tableName . "/" . $tableName . ".table.json", "w");
            fclose($open);
            unlink("../dbuserhandler/" . $this->_runnetDBUsers->{"database"} . "/" . $tableName . "/" . $tableName . ".table.json");
            rmdir("../dbuserhandler/" . $this->_runnetDBUsers->{"database"} . "/" . $tableName);

        }else{
            $this->failed("The table you're trying to delete, does not exist");
        }

    }





    public $JSONEncodeValues = [];
    public $jsonTest;
    public function insertInto($tableName, $values = []){

        if(is_array($values)){

            if(!empty($tableName)){

                $getContent = file_get_contents(JSONPATH . $tableName . "/" . $tableName . ".value" . JSON);

                $decodeContent = json_decode($getContent);

                $getColumnContent = file_get_contents(JSONPATH . $tableName . "/" . $tableName . ".table" . JSON);
                $decodeColumnContent = json_decode($getColumnContent, true);


                if(empty($getContent)){
                    /*
                     * Because no values are stored..
                     */

                    //$newValues = array_values($values);


                    $newValuesAgain = [$values];

                    $encodeValues = json_encode($newValuesAgain);

                    file_put_contents("../dbuserhandler/" . $this->_runnetDBUsers->{"database"} . "/" . $tableName . "/" . $tableName . ".value.json", $encodeValues);

                }else{

                    $newValues[] = $values;

                    $decodeValues = $decodeContent;

                    $mergeNewValuesAndDecodeValues = array_merge($decodeValues, $newValues);

                    $encodeMergeValues = json_encode($mergeNewValuesAndDecodeValues);

                    file_put_contents("../dbuserhandler/" . $this->_runnetDBUsers->{"database"} . "/" . $tableName . "/" . $tableName . ".value.json", $encodeMergeValues);


                }


            }else{
                $this->failed("You cannot leave table name empty.");
            }

        }else{
            $this->failed("Second parameter must be an array.");
        }


    }


    public function getJSON($file){

        $file = file_get_contents($file);
        return json_decode($file);

    }


    public $getCombinedValues = [];
    public $combineAgainValues = [];

    private $selectColumn;
    private $tableName;
    // SELECT * FROM tabellnamn
    public function prepareSelectFrom($tableName){

        $this->tableName = $tableName;
        //$this->selectColumn = $column;

        $getJSONColumns = $this->getJSON(JSONPATH . $tableName . "/" . $tableName . ".table.json");
        $newJSONColumns[] = $getJSONColumns;

        $file = JSONPATH . $tableName . "/" . $tableName . ".value" . JSON;
        $file2 = file_get_contents($file);
        $getJSONValues = json_decode($file2, true);



        $i = 0;
        foreach($getJSONValues as $key => $val){

            $combineValues[$i] = array_combine($getJSONColumns, $getJSONValues[$i]);
            $i++;

            $this->getCombinedValues = $combineValues;

        }

        //self::dump($combineValues);




    }
    // SELECT * FROM tabellnamn WHERE $column[] = $value[]
    /*
     * kolla om $column arrayn innehåller samma värde som i tabellen json
     * kolla om $value arrayn innehåller samma värde som i value json
     *
     *
     *
     */
    private $_i;

    // WHERE $column = $value
    public function where($column, $value){
        $lastTableName = $this->tableName;

            //$getJSONColumns = $this->getJSON(JSONPATH . $lastTableName . "/" . $lastTableName . ".table" . JSON);

/*
            $file = JSONPATH . $lastTableName . "/" . $lastTableName . ".value" . JSON;

            $file2 = file_get_contents($file);
            $getJSONValues = json_decode($file2, true);
*/
            //self::dump($this->getCombinedValues);
            $i = 0;

            foreach($this->getCombinedValues as $keys => $vals){

                $newArray[$i] = $this->getCombinedValues[$i][$column];
                $i++;
            }

            //self::dump($newArray);


            return in_array($value, $newArray);

          //return $this;
    }

    public function prepareDeleteFrom($tableName, $column, $value){

        $file = JSONPATH . $tableName . "/" . $tableName . ".value" . JSON;

        $file2 = file_get_contents($file);
        $getJSONValues = json_decode($file2, true);


            $i = 0;
            foreach($getJSONValues as $key => $val){

                if($val[$column] == $value){

                    unset($getJSONValues[$i]);

                    sort($getJSONValues);

                    $newJSONValues = json_encode($getJSONValues);

                    file_put_contents($file, $newJSONValues);

                }


                $i++;

            }



    }





    private $_newCombinedValues  = [];
    // ur funktion..
    public function limit($amount, $value){


        for($this->_i=$amount;$this->_i<count($this->getCombinedValues); $this->_i++){

            $newValues[$this->_i] = $this->getCombinedValues[$this->_i];
            $this->_newCombinedValues = $newValues;
            return $this->_newCombinedValues[$this->_i];
        }
        self::dump($this->_newCombinedValues);



    }



    public function showSelectFrom($value){

        return $this->_newCombinedValues[$this->_i][$value];

    }

    public function useCombinedValues($value){
        return $this->combineAgainValues[$value];
    }

    public function resetSelectFrom(){
        unset($this->combineAgainValues);
    }

    public function resetFetchAndColumns(){
        $this->selectColumn = "";
        $this->selectFetch  = "";
    }

    public static function dump($code){
        echo '<pre>';
        print_r($code);
        echo '</pre>';
    }


} // end of the class

