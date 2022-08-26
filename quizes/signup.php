<?php
session_start();
$username = "root";
$servername = "localhost";
$pass = "";
$dbname = "quiz_login";

$conn = new mysqli($servername, $username, $pass, $dbname);
if (($conn->connect_error)) {
    die("Connection Failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <form  method = "POST">
        <div class= "form-group">
            <label>UserName</label>
            <input type = "text" name = "username" autocomplete = "off" required/>
        </div> 
        <div class= "form-group">
            <label>Email</label>
            <input type = "email" name = "email" required />
        </div> 
        <div class= "form-group">
            <label>Phone</label>
            <input type = "text" name = "phone" required/>
        </div> 
        <div class= "form-group">
            <label>Password</label>
            <input type = "password" name = "pass" autocomplete = "off" required/>
        </div>
        <div class= "form-group">
            <label>Confirm Password</label>
            <input type = "password" name = "confirm_pass" autocomplete = "off"required/>
        </div>
        <div class= "form-group">
            <input type = "submit" name = "signup" class = "btn" id = "submit" autocomplete = "off"/>
        </div>  
    </form>
    <?php

if (isset($_POST['signup'])) {

    if (!isset($_POST['username']) || $_POST['username'] == "") {

        echo '<div class = "message error"> Username Cannot be empty </div>';
    }
    elseif (!isset($_POST['pass']) || $_POST['pass'] == "") {
        echo '<div class = "message error"> Password Cannot be empty </div>';
    }
    elseif ($_POST['pass'] != $_POST['confirm_pass']) {
        echo '<div class = "message error"> Passwords Do not Match </div>';
    }

    else {
        $username = $_POST['username'];
        $password = $_POST['pass'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $user_check_query = "SELECT * FROM users WHERE username='$username'  LIMIT 1";
        $result = mysqli_query($conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) { // if user exists
            if ($user['username'] === $username) {
                echo "<script>alert('Username Already Exists')</script>";
            }
            if ($user['email'] === $email) {
                echo "<script>alert('Email Already Exists')</script>";
            }
        }
        else {
            $password_enc = md5($password);
            $INSERT = "INSERT INTO users (username, pass, email, phone)  VALUES (?,?,?,?) ";
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ssss", $username, $password_enc, $email, $phone);
            if ($stmt->execute()) {
                echo "<script>alert('You have signed up! <?php $username?>')</script>";
                header('location:../index.php');
            }


        }



    // $sql = $conn->prepare("SELECT * FROM users WHERE username = ? AND pass = ? ");
    // $sql->bind_param("ss", $username, $password);
    // $sql->execute();
    // $result = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

    // if (count($result) > 0) {
    //     session_start();
    //     $_SESSION['id'] = $result[0]['id'];
    //     $_SESSION['email'] = $result[0]['email'];
    //     $_SESSION['username'] = $result[0]['username'];
    //     header("location:  dashboard.php");
    // }
    // else {
    //     echo "<div class = 'message error'> Incorrect Credentials </div>";
    // }
    }
}


?>
    
</body>
</html>