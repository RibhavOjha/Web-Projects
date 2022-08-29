<?php
session_start();
// if (isset($_SESSION['id'])) {
//     header("location: dashboard.php");
// }
$username = "root";
$servername = "localhost";
$pass = "";
$dbname = "quiz_login";

$conn = new mysqli($servername, $username, $pass, $dbname);
if (($conn->connect_error)) {
    die("Connection Failed: " . $conn->connect_error);
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Maker</title>
    <link href='https://fonts.googleapis.com/css?family=Balsamiq Sans' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
<style>
body {
    font-family: 'Balsamiq Sans';font-size: 22px;
}
</style>
    
    
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.3/assets/owl.carousel.min.css">
</head>

<body>
    <section>
        <div class="color"></div>
        <div class="color"></div>
        <div class="color"></div>
    <div class="box">
        <div class="container">
        <div class="form">
        <h2>USER LOGIN </h2>
    
    <form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
        <div class= "form-group">
            <input type = "text" name = "username" autocomplete = "off" placeholder="Username"/>
        </div> 
        <div class= "form-group">  
            <input type = "password" name = "pass" autocomplete = "off" placeholder="Password"/>
        </div>
        <div class= "form-group">
            <input type = "submit" name = "login" class = "btn" id = "submit" autocomplete = "off"/>
        </div>  
    </form>
    <p class="forget"> Don't have an Account? <a href = "quizes/signup.php">Sign UP</p></a>
    <?php
if (isset($_POST['login'])) {
    if (!isset($_POST['username']) || $_POST['username'] == "") {

        echo '<div class = "message error"> Username Cannot be empty </div>';
    }
    elseif (!isset($_POST['pass']) || $_POST['pass'] == "") {
        echo '<div class = "message error"> Password Cannot be empty </div>';
    }
    else {
        $username = $_POST['username'];
        $password = $_POST['pass'];

        $sql = $conn->prepare("SELECT * FROM users WHERE username = ? AND pass = ? ");
        $sql->bind_param("ss", $username, $password);
        $sql->execute();
        $result = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

        if (count($result) > 0) {
            session_start();
            $_SESSION['id'] = $result[0]['id'];
            $_SESSION['email'] = $result[0]['email'];
            $_SESSION['username'] = $result[0]['username'];
            header("location:  dashboard.php");
        }
        else {
            echo "<div class = 'message error'> Incorrect Credentials </div>";
        }
    }
}

?>
    <!-- <script>$('.owl-carousel').owlCarousel({
        stagePadding: 50,
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:3
            }
        }
    })</script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.3/owl.carousel.min.js"></script>    
    </div>
    </div>
    </div>
</section>
    
</body>
</html>