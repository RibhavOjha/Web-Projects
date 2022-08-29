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
    <title>Add Quiz</title>
    <link href='https://fonts.googleapis.com/css?family=Balsamiq Sans' rel='stylesheet'>
<style>
body {
    font-family: 'Balsamiq Sans';font-size: 22px;
}
</style>
 </head>
 <body>

    
    <form action = "add_questions.php" method = "POST">
            <div class= "form-group">
                <label>Quiz Name</label>
                </div> 
                <input type = "text" name = "quizname" autocomplete = "off" required/>
    <div class= "form-group">
        <label>How many questions do you want to include?</label>
        </div> 
        <input type = "text" name = "number_questions" autocomplete = "off" required/>
        <div class= "form-group">  
                <input type = "submit" name = "subm" class = "btn" id = "submit" value="GO" autocomplete = "off"/>
            </div>  
</form>
    
    <?php
// $count = 0;
// $limit = 1;
// $bool = false;

// do {

?>

    

<?php

if (isset($_POST['number_questions'])) {
    $number_questions = $_POST['number_questions'];
    for ($i = 1; $i <= $number_questions; $i++) {
        if($number_Questions > 20){
            echo ("<script> alert('Cannot enter more than 20 items') </script>");
            break;        // header("location:add_quiz_form.php");    
        }
        else{

?>


    <form  method = "POST">
            
            <div class= "form-group">
                <label>Question </label><label><?php echo $i ?></label>
                <input type = "text" name = "question" autocomplete = "on"/>
            </div>
            <div class= "form-group">
                <label>Option 1</label>
                <input type = "text" name = "question" autocomplete = "on"/>
            </div>
            <div class= "form-group">
                <label>Option 2</label>
                <input type = "text" name = "question" autocomplete = "on"/>
            </div>
            <div class= "form-group">
                <label>Option 3</label>
                <input type = "text" name = "question" autocomplete = "on"/>
            </div>
            <div class= "form-group">
                <label>Option 4</label>
                <input type = "text" name = "question" autocomplete = "on"/>
            </div>
            <!-- <div class= "form-group">
                <input type = "submit" name = "add" class = "btn" id = "submit" value="Add Question" />
            </div>   -->
            <br>
            
    </form>
    <?php
    }}
}?>
<?php if (isset($_POST['number_questions'])) { ?>
<div class= "form-group">  
                <input type = "submit" name = "login" class = "btn" id = "submit" autocomplete = "off"/>
            </div>  
<?php } ?>



   
    
 </body>
 </html>