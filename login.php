<?php
    require('header.php');
    require_once('sanitize.php');

    $emailError = $passwordError = "";

    //check to see if any errors occur during login
    if(isset($_GET['email']) || isset($_GET['password']) || isset($_GET['error'])){
        $emailError = "Please enter correct username.";
        $passwordError = "Please enter correct password.";
    }
?>

    <form method="post" action="processLogin.php">
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
        <p class="username-error"><?php if(!empty($emailError)) echo $emailError ?></p>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password" name="password">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>

<?php
    require('footer.php');
?>