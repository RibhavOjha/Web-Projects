<?php
session_start();
$hostname = "localhost";
$pass = "";
$username = "root";
$dbname = "quiz_login";
$conn = new mysqli($hostname, $username, $pass, $dbname);

if ($conn->connect_error) {
    die("Could Not Connect" . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
</head>
<body>
<h1> QUIZ </h1>
    <?php
        $sql_quizzes = "SELECT * FROM quizes";
        $result_quizzes = mysqli_query($conn, $sql_quizzes);
        while($row_quizzes=mysqli_fetch_assoc($result_quizzes)){
                $x = $row_quizzes['QUIZ 1'];
                if(isset($_POST[$row_quizzes['quiz_id']])){
                $y = $_POST[$row_quizzes['quiz_id']];
                }
                else{
                    continue;
                }
            if(trim(strval($x)) == trim(strval($y))){
                $quiz_index = $row_quizzes['quiz_id'];
                // echo $quiz_index;
                break;  
            }
        }
        
            
            
        
     ?>
    <?php

$sql = "SELECT * FROM questions";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
?>

<?php $x = 0; ?>
<?php while ($row = mysqli_fetch_assoc($result)) {
?>
<h2><?php   
            if($quiz_index == $row['quizes_id']){
            if ($row['userid'] == $_SESSION['id']) {
            for ($x = ++$x; $x<= mysqli_num_rows($result); $x++){
                echo ("Question".$x." ");
                break;
                
            }
            echo $row['question'];
        }?></h2>
        <!-- <h2><?php echo $row['questions_id'] ?></h5> -->
<input type="radio" name="<?php echo $row['questions_id'] ?>" id="option_1" value="email" />
<label for="option_1"><?php echo $row['option_1'] ?></label>
<br>
<input type="radio" name="<?php echo $row['questions_id'] ?>" id="option_2" value="email" />
<label for="option_2"><?php echo $row['option_2'] ?></label>
<br>
<input type="radio" name="<?php echo $row['questions_id'] ?>" id="option_3" value="email" />
<label for="option_3"><?php echo $row['option_3'] ?></label>
<br>
<input type="radio" name="<?php echo $row['questions_id'] ?>" id="option_4" value="email" />
<label for="option_4"><?php echo $row['option_4'] ?></label>
<br>
<?php
    }}?>
<?php
}?>
<?php 
            
?>

</body>
</html>