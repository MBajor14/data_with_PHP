<?php
    require('header.php');

    echo '
        <form method="post" action="posts.php">
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    ';

    require('footer.php');
?>