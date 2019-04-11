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


    echo '<ul id="post-list">';
        while($stmt -> fetch()){
            echo '
                <li class="post">
                    <div class="post-left">
                        <h3>'.$title.'</h3>
                        <h3>'.$name.'</h3>
                        <h3>'.$date.'</h3>
                    </div>
                    <div class="post-right">
                        <p>'.$body.'</p>
                    </div>
                </li>
            ';
        }
    echo '</ul>';


//    while($stmt -> fetch()){
//        echo $name.' '.$date.' '.$title.' '.$body.'<br/>';
//    }
?>