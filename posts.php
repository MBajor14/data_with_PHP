<?php

    require('../../safe/bajor_mysqli_connect.php');

    $query = "
        SELECT u.name, p.date_time, p.title, p.body 
        FROM users AS u, posts AS p 
        WHERE u.user_id=p.user_id;
    ";

    $stmt = $dbc -> prepare($query);

    $stmt -> execute();

    $stmt -> store_result();

    $stmt -> bind_result($name,$date,$title,$body);

    while($stmt -> fetch()){
        echo $name.' '.$date.' '.$title.' '.$body;
    }
?>