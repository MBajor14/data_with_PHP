<?php
/*logout.php this called when the user hits the logout button.
their session is ended.*/
session_start();
session_unset();
session_destroy();
header ("Location: login.php");