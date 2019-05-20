<?php
    require('header.php');

    if(isset($_GET['logout'])){
        if($_GET['logout'] == true){
            echo "<script type='text/javascript'>alert('user has logged out');</script>";
        }
    }

    if(isset($_POST['login']) ){
        require('../../safe/bajor_mysqli_connect.php');
        require('sanitize.php');

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
            $query = "
                    SELECT u.user_id, u.email, u.password 
                    FROM users AS u
                    WHERE u.email = ?;
                ";


            $stmt = $dbc -> prepare($query);
            $stmt -> bind_param('s',$email);
            $stmt -> execute();
            $stmt -> store_result();
            $stmt -> bind_result($query_id,$query_email, $query_password);
            $stmt -> fetch();


            if($query_email === $email && $query_password === $password){
                $_SESSION['id'] = $query_id;
                header ("Location: posts.php?login=success");
                exit();
            }
            else{
                $error = 'This email and password pair is not valid';
                header("Location: login.php?error=".$error);
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