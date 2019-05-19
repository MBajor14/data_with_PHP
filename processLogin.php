<?php
    if(isset($_POST["login"]) ){
        require_once('../../safe/bajor_mysqli_connect.php');
        require_once('sanitize.php');

        $db = connectToSQL();


        $email = $_POST['email'] ? $_POST['email'] : NULL;
        $password = $_POST['password'] ? $_POST['password'] : NULL;
        $email = sanitize($email);
        $password = sanitize($password);


        if(empty($email) || empty($password))    {
            header("Location: login.php?error=emptyfields&email=".$error."&password=".$error);
            exit();
        }

        else{
            $query = "
                SELECT u.name, u.email, u.password 
                FROM users AS u
                WHERE email = ?
            ";

            $stmt = $dbc -> prepare($query);
            $stmt -> bind_param('s',$email);
            $stmt -> execute();
            $stmt -> store_result();
            $stmt -> bind_result($name,$date,$title,$body);



            //if our prepared statement executes then store results in $stmt variable
            if($row = mysqli_fetch_assoc($resultSet)){
                $passwordCheck = password_verify($password, $row['password']);
                if($passwordCheck == true){
                    session_start();
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['accountType'] = $row['accountType'];
                    if( $_SESSION['accountType'] === 'admin' ||
                        $_SESSION['accountType'] === 'employee' ||
                        $_SESSION['accountType'] === 'customer'){
                        header ("Location: kunden.php?login=success");
                        exit();
                    }
                }
            }
            else{
                header ("Location: login.php?error=invaliduser&=".$email);
                exit();
            }

        }
        $stmt -> close();
    }
?>