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
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>MY QUIZES</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
    <link href='https://fonts.googleapis.com/css?family=Balsamiq Sans' rel='stylesheet'>
    <style>
    body {
        font-family: 'Balsamiq Sans';font-size: 22px;
    }
    </style>
</head>
<body>
<?php
$user_id = $_SESSION['id'];
$sql = "SELECT * FROM quizes WHERE user_id='$user_id'";
$result = mysqli_query($conn, $sql) or die("Query Unsuccessful");
if (mysqli_num_rows($result) > 0) {
?>
    <div class="container">
    <h1> My Quizzes for <?php echo $_SESSION['username']?> </h1>
    <?php 
    
    while ($row = mysqli_fetch_assoc($result)) {
?>
<?php if($_SESSION['id']==$row['user_id']){ ?>
    <form action = "quizzes.php" method="POST">
        <input formaction = "quizzes.php" name = "<?php echo $row['quiz_id'] ?>" type = "submit" value = " <?php
            // echo ($row['quiz_id']);
            if($_SESSION['id']==$row['user_id']){  
                
            // $_SESSION['quiz_id'] = $row['quiz_id'];                        
            echo $row['quiz_name']; } ?>"/>
           
        <input formaction="delete_quiz.php" name="delete_hidden" type = "hidden" value="<?php echo $row['quiz_id'] ?>"/>
        <input formaction="update_quiz.php" name="update" type = "submit" value="Update"/>
        <input formaction="update_quiz.php" name="update_hidden" type = "hidden" value="<?php echo $row['quiz_id'] ?>"/>
        <input formaction="delete_quiz.php" name="delete" type = "submit" value="Delete"/>
        
        <!-- <a href="delete_quiz.php?userid="> Delete </a> -->
    </form>
    

    <?php
    // echo $row['quiz_id'];
    }}?>
    
    
      <?php
}else{echo("No Quizes Found");}?>

</body>
</html>