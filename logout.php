<?php
if (isset($_POST['logout'])) {
    session_start();
    session_unset();
    session_destroy();
    echo '<script>alert("Welcome to Geeks for Geeks")</script>';
    header("location:index.php");
}



?>