<?php
    require('header.php');

    if(isset($_POST['addPost'])){
        require('../../safe/bajor_mysqli_connect.php');
        require('sanitize.php');

        $userID = $_SESSION['id'];

        if(isset($_POST['title'])){
            $title = $_POST['title'];
        }
        if(isset($_POST['body'])){
            $body = $_POST['body'];
        }

        $title = sanitize($title);
        $body = sanitize($body);

        if(empty($title) || empty($body))    {
            $error = 'Please fill out all the fields to add post';
            header("Location: addPost.php?error=".$error);
            exit();
        }
        else{
            $query = "
                    INSERT INTO posts(title,body,user_id)
                    VALUES (?,?,?) 
                ";


            $stmt = $dbc -> prepare($query);
            $stmt -> bind_param('ssi',$title, $body, $userID);
            $stmt -> execute();
            $stmt -> store_result();
            $stmt -> close();

            header("Location: posts.php");
        }
    }

    if(isset($_GET['error'])){
        $error = $_GET['error'];
        echo "<div class='alert alert-warning msg' role='alert'>$error</div>";
    }
?>
    <form method="post" action="addPost.php">
      <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" id="title" aria-describedby="titleHelp" placeholder="Title..." name="title">
      </div>
      <div class="form-group">
        <label for="body">Body</label>
        <input type="text" class="form-control" id="body" placeholder="Body..." name="body">
      </div>
        <button name="addPost" type="submit" class="btn btn-primary">Add Post</button>
    </form>

<?php
    require('footer.php');
?>