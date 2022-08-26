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
</head>
<body>
    <?php
$sql = "SELECT * FROM quizes ";
$result = mysqli_query($conn, $sql) or die("Query Unsuccessful");
if (mysqli_num_rows($result) > 0) {
?>
    <h1> My Quizzes for <?php echo $_SESSION['username']?> </h1>
    <?php 
    
    while ($row = mysqli_fetch_assoc($result)) {
?>
    <form action = "quizzes.php" method="POST">
        <input formaction = "quizzes.php" name = "<?php echo $row['quiz_id'] ?>" type = "submit" value = " <?php
            // echo ($row['quiz_id']);
            if($_SESSION['id']==$row['user_id']){  
            // $_SESSION['quiz_id'] = $row['quiz_id'];                        
            echo $row['QUIZ 1'];} ?>"/>        
    </form>

    <?php
    }?>
    
    
      <?php
}?>

</body>
</html>