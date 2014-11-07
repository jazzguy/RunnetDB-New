<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 2014-11-04
 * Time: 22:21
 */


include 'global.php';

$RunnetDBPanel->onlinePage();


?>



<html>

<head>

    <title>RunnetDBPanel</title>
    <link href="/Runnet/css/panel.css" rel="stylesheet" type="text/css" />
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
            <li><a href="dashboard.php?page=database">Databases</a></li>
            <li><a href="logout.php">Logout</a></li>

        </ul>


    </div>
</div>


<div class="pageWrapper">

    <div id="databases" class="well well-lg">
        <ul class="list-group">


        <?php

            foreach($RunnetDB->getDatabase() as $key => $val){

                ?>

                <li class="list-group-item">
                    <span class="badge">

                        <?php
                        $i = 0;
                        foreach($RunnetDB->getDatabaseTables(basename($val)) as $tkey => $tval ){
                            $i++;

                        }
                        echo $i;

                        ?>

                    </span>
                    <a style="color:black;" href="dashboard.php?db=<?php echo basename($val); ?>"><?php echo basename($val); ?></a>

                </li>

                <?php

            }

        ?>



        </ul>
    </div>
    <a href="#" id="newTable" class="btn btn-default">Button</a>

    <table id="tablesInDb" class="table table-striped table-hover ">
        <thead>
        <tr>
            <th>#</th>
            <th>Table</th>
            <th>Column(s)</th>
            <th>Row(s)</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i = 1;
        foreach($RunnetDB->getDatabaseTables($_GET["db"]) as $key => $val){

            ?>

            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo basename($val); ?></td>
                <td>
                    <?php

                        $s = 0;
                        foreach($RunnetDB->getDatabaseTablesColumn($_GET["db"], basename($val)) as $ckey => $cval){
                            $s++;
                        }
                        echo $s;

                    ?>
                </td>
                <td>
                    <?php

                        $k = 0;
                        if($RunnetDB->getDatabaseTablesRows($_GET["db"], basename($val))){
                            foreach($RunnetDB->getDatabaseTablesRows($_GET["db"], basename($val)) as $rkey => $rval){
                                $k++;
                            }
                            echo $k;
                        }else{
                            echo 0;
                        }


                    ?>
                </td>
            </tr>

        <?php

            $i++;

        }

        ?>


        </tbody>
    </table>

    <?php


    ?>
</div>

</body>

</html>