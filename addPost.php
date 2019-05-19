<?php
    require('header.php');

    echo '
            <form method="post" action="addPosts.php">
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
    ';

    require('footer.php');
?>