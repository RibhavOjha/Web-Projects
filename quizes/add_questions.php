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
    <title>Quiz Maker</title>
    <link href='https://fonts.googleapis.com/css?family=Balsamiq Sans' rel='stylesheet'>
<style>
body {
    font-family: 'Balsamiq Sans';font-size: 22px;
}
</style>
</head>
<body>
    <div>
        <h2> Your Quiz - <?php if (isset($_POST['quizname'])){ echo $_POST['quizname'];}$var=1;?> </h2>
    </div>
    
<?php


if (isset($_POST['number_questions'])) {
    // $_SESSION['no_questions'] = $_POST['number_questions'];
    $quiz_name = $_POST['quizname'];
    $_SESSION['var'] = 1;
    $_SESSION['quiz_name'] = $quiz_name;
    $user_id = $_SESSION['id'];
    $INSERT = "INSERT INTO quizes (quiz_name, user_id) VALUES (?,?) "; 
    $stmt = $conn->prepare($INSERT);
    $stmt->bind_param("si",$quiz_name,$user_id );
    $stmt->execute();
    $number_questions = $_POST['number_questions'];
    $_SESSION['number_questions'] = $number_questions;
    for ($i = 1; $i <= $number_questions; $i++) {
        if($i > 20){
            echo ("<script> alert('Cannot enter more than 20 items') </script>");
            $i = 21;
            break;    
               
        }
        else{

?>


    <form action="add_questions_sql.php" method = "POST">
            
            <div class= "form-group">
                <label>Question </label><label><?php echo $i ?></label>
                <input type = "text" name = "<?php echo $_SESSION['var']; ?>" autocomplete = "on"/>
            </div>
            <?php $_SESSION['var']++ ?>
            <div class= "form-group">
                <label>Option 1</label>
                <input type = "text" name = "<?php echo $_SESSION['var'] ?>" autocomplete = "on"/>
            </div>
            <?php $_SESSION['var']++ ?>
            <div class= "form-group">
                <label>Option 2</label>
                <input type = "text" name = "<?php echo $_SESSION['var'] ?>" autocomplete = "on"/>
            </div>
            <?php $_SESSION['var']++ ?>
            <div class= "form-group">
                <label>Option 3</label>
                <input type = "text" name = "<?php echo $_SESSION['var'] ?>" autocomplete = "on"/>
            </div>
            <?php $_SESSION['var']++ ?>
            <div class= "form-group">
                <label>Option 4</label>
                <input type = "text" name = "<?php echo $_SESSION['var'] ?>" autocomplete = "on"/>
            </div>
            <?php $_SESSION['var']++ ?>
            <div class= "form-group">
                <label>Correct Answer</label>
                <input type = "text" name = "<?php echo $_SESSION['var'] ?>" autocomplete = "on"/>
            </div>
            <?php $_SESSION['var']++ ?>
            <?php if($number_questions == $i){ ?>
            <div class= "form-group">  
            <input type = "submit" name = "submit" class = "btn" id = "submit" autocomplete = "off"/>
        </div>
        <?php } ?>  
            <br>  
            <?php }}?>        
    </form>
    <?php
    //else finish

    //for finish
    
}//if finsish?>


</body>
</html>