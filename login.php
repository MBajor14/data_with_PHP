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
            echo 'ran else statement';

            $query = "
                    SELECT u.name, u.email, u.password 
                    FROM users AS u
                    WHERE email = ?
                ";

            $stmt = $dbc -> prepare($query);
            $stmt -> bind_param('s',$email);
            $stmt -> execute();
            $stmt -> store_result();
            $stmt -> bind_result($query_name,$query_email,$query_password);

            if(isset($query_email)){
                echo $query_email;
            }

            if($query_email === $email){
                session_start();
                $_SESSION['email'] = $query_email;
                $_SESSION['name'] = $query_name;
                header ("Location: posts.php?login=success");
                exit();
            }

        }
        $stmt -> close();
    }


    if(isset($_POST['error'])){
        echo "<div class='alert alert-warning msg' role='alert'>$error</div>";
    }


    if(isset($_POST['login'])){
        echo '
            <h3>Login ran</h3>
        ';
        if(isset($_POST['email'])){
            echo $email;
        }
        if(isset($_POST['password'])){
            echo $password;
        }
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