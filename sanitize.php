<?php
    function sanitize($string)
    {
        $string = trim($string);
        $string = filter_var(htmlspecialchars($string, ENT_QUOTES, 'utf-8'), FILTER_SANITIZE_STRING);
        $string = stripslashes($string);
        return $string;
    }
?>
