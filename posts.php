<?php

    require('header.php');
    require('../../safe/bajor_mysqli_connect.php');

    $query = "
        SELECT u.name, p.date_time, p.title, p.body 
        FROM users AS u, posts AS p 
        WHERE u.user_id=p.user_id
        LIMIT 5;
    ";

    $stmt = $dbc -> prepare($query);

    $stmt -> execute();

    $stmt -> store_result();

    $stmt -> bind_result($name,$date,$title,$body);


    echo '<ul id="post-list">';
        while($stmt -> fetch()){
            echo '
                <li class="post">
                    <div>'.$title.'</div>    
                    <div>Submitted by '.$name.' on '.$date.'</div>
                    <div class="post-body">
                        <p>'.$body.'</p>
                    </div>
                    <a href="">Comments</a>
                    
                </li>
            ';
        };
    echo '</ul>';

    require('footer.php');
?>