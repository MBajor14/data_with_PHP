<?php

//connect to the database

if ($_SERVER['REQUEST_METHOD'] == 'POST')

{

    require ('../../safe/mysqli_connect.php');


//prepare a query

//set up a query making placeholders for the

//variables

//that the user put in_array

    $searchtype = $_POST['searchtype'];

    $searchterm = trim($_POST['searchterm']);

    $query= "select page_name, visit_date,

 remote_port FROM visitInfo

 WHERE $searchtype = ?";

//execute that query and print out the results

//prepare the query on the database

    $stmt = $dbc -> prepare($query);

//specify what those ? refer to in the query

    $stmt -> bind_param('s',$searchterm);

//execute the statement

    $stmt -> execute();

    $stmt -> store_result();

//which variables should hold returned results

    $stmt -> bind_result($name, $vdata, $port);



    while ($stmt->fetch()) //get the next record in result set

    {

        echo $name.' '.$vdata.' '.$port."</br>";

    }

}

?>
