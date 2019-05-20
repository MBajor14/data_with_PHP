<?php

    require('header.php');
    require('../../safe/bajor_mysqli_connect.php');


    if(isset($_GET['page'])){
        $startPosition = ($_GET['page'] -1) * 5;
        $page = $_GET['page'];
    }
    else{
        $startPosition = 0;
        $page = 1;
    }

    $query = "
        SELECT u.name, p.date_time, p.title, p.body
        FROM users AS u, posts AS p 
        WHERE u.user_id=p.user_id
        ORDER BY p.date_time DESC
        LIMIT ?,5;
    ";

    $stmt = $dbc -> prepare($query);
    $stmt -> bind_param('i',$startPosition);
    $stmt -> execute();
    $stmt -> store_result();
    $stmt -> bind_result($name,$date,$title,$body);
    $itemsReturned = $stmt -> num_rows;


    echo '<ul id="post-list">';
        while($stmt -> fetch()){
            echo '
                <li class="post">
                    <h4 class="post_title">'.$title.'</h4>    
                    <div>Submitted by '.$name.' on '.$date.'</div>
                    <div class="post-body">
                        <p>'.$body.'</p>
                    </div>
                    <a href="">Comments</a>
                    
                </li>
            ';
        };
    echo '</ul>';

    $nextPage = $page + 1;
    $previousPage = $page - 1;

    echo '<div class="page-jump">';
    if($page > 1){
        echo '
                <div>
                    <i class="fas fa-long-arrow-alt-left"></i>
                    <a href="posts.php?page='.$previousPage.'">Last 5</a>
                </div>
        ';
    }
    if($itemsReturned === 5){
        echo '
                <div>
                    <a href="posts.php?page='.$nextPage.'">Next 5</a>
                    <i class="fas fa-long-arrow-alt-right"></i>
                </div>
        ';
    }
    echo '</div>';

    require('footer.php');

    $stmt -> close(); // close database connection
?>