<?php
    require('header.php');


    if(isset($_POST['login']) ){
        require_once('../../safe/bajor_mysqli_connect.php');
        require_once('sanitize.php');

        if(isset($_POST['email']))
            $email = $_POST['email'];
        if(isset($_POST['password']))
            $password = $_POST['password'];

        $email = sanitize($email);
        $password = sanitize($password);

        if(empty($email) || empty($password))    {
            $error = 'Please fill out all the fields in the login form';
            header("Location: login.php?error=".$error);
            exit();
        }

        else{
            $query_email = 'empty';
            if(isset($_POST['login'])){
                echo '
                    <h3>Login ran</h3>
                ';
                if(isset($_POST['email'])){
                    echo '<h5>'.$email.'</h5>';
                }
                if(isset($_POST['password'])){
                    echo '<h5>'.$password.'</h5>';
                }
            }

            $query = '
                    SELECT *
                    FROM users
                    WHERE email = "kenny@email.com";
                ';

            $stmt = $dbc -> prepare($query);
//            $stmt -> bind_param('s',$email);
            $stmt -> execute();
            $stmt -> store_result();
            $result = $stmt -> get_result();


            if($row = $result -> fetch_assoc()){
                session_start();
                echo '<h5>$row[\'email\']</h5>';
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['name'];
                header ("Location: posts.php?login=success");
                exit();
            }

        }
        $stmt -> close();
    }


    if(isset($_GET['error'])){
        $error = $_GET['error'];
        echo "<div class='alert alert-warning msg' role='alert'>$error</div>";
    }

    ?>

    <form method="post" action="login.php">
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password" name="password">
      </div>
      <button name="login" type="submit" class="btn btn-primary">Submit</button>
    </form>

<?php
    require('footer.php');
?>