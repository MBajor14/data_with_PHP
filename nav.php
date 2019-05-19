<?php
    $loggedIn = false;
    session_start();
    if(isset($_SESSION['email'])) {
        $loggedIn = true;
    }
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="posts.php">PO$T!</a>
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a href="posts.php" class="nav-link">Add Post</a>
        </li>
        <?php
            if($loggedIn){
                echo '
                        <li class="nav-item">
                            <a href="login.php" class="nav-link">Login</a>
                        </li>
                ';
            }
            else{
                echo '
                        <li class="nav-item">
                            <a href="#" class="nav-link">Logout</a>
                        </li>
                ';
            }
        ?>
    </ul>
</nav>