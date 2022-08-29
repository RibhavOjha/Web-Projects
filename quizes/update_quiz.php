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
</head>
<body>
    <?php 
    $_SESSION['var'] = 1;
    $quiz_id = $_POST['update_hidden'];
    $sql = "SELECT COUNT(*) FROM questions WHERE quizes_id = '" . $quiz_id . "' ";
    $query = mysqli_query($conn, $sql) or die("Query Unsuccessful");
    $result = mysqli_fetch_array($query);
    $limit = (int)$result[0];
    $count = 1;

    $SELECT = "SELECT * FROM questions WHERE quizes_id = '" . $quiz_id . "' ";
    $query_2 = mysqli_query($conn, $SELECT) or die("Query Unsuccessful");
    
    // $result = mysqli_fetch_assoc($query);
    while ($row = mysqli_fetch_assoc($query_2)) {
        // print_r($row);
    ?>
    <?php // for($i=1; $i<=$count; $i++){ ?>
<form action="update_questions_sql.php" method = "POST">
            
            <div class= "form-groupx    ">
                <label>Question </label><label><?php echo $count;  ?></label>
                <input type = "text" name = "<?php echo $_SESSION['var']; ?>" value = "<?php echo $row['question']?>" autocomplete = "on"/>
            </div>
            <?php $_SESSION['var']++ ?>
            <div class= "form-group">
                <label>Option 1</label>
                <input type = "text" name = "<?php echo $_SESSION['var'] ?>" value = "<?php echo $row['option_1']?>" autocomplete = "on"/>
            </div>
            <?php $_SESSION['var']++ ?>
            <div class= "form-group">
                <label>Option 2</label>
                <input type = "text" name = "<?php echo $_SESSION['var'] ?>" value = "<?php echo $row['option_2']?>" autocomplete = "on"/>
            </div>
            <?php $_SESSION['var']++ ?>
            <div class= "form-group">
                <label>Option 3</label>
                <input type = "text" name = "<?php echo $_SESSION['var'] ?>" value = "<?php echo $row['option_3']?>" autocomplete = "on"/>
            </div>
            <?php $_SESSION['var']++ ?>
            <div class= "form-group">
                <label>Option 4</label>
                <input type = "text" name = "<?php echo $_SESSION['var'] ?>" value = "<?php echo $row['option_4']?>" autocomplete = "on"/>
            </div>
            <?php $_SESSION['var']++ ?>
            <div class= "form-group">
                <label>Correct Answer</label>
                <input type = "text" name = "<?php echo $_SESSION['var'] ?>" value = "<?php echo $row['correct_answer']?>" autocomplete = "on"/>
            </div>
            <?php $_SESSION['var']++ ?>
            <?php if($count == $limit){ ?>
            <div class= "form-group">  
            <input type = "submit" name = "submit" class = "btn" id = "submit" autocomplete = "off"/>
            <input formaction="update_questions_sql.php" name="update_hidden" type = "hidden" value="<?php echo $row['quizes_id'] ?>"/>
        </div>
        <?php }$count++ ?>  
            <br>  
            <?php }  //}?>        
    </form>
    
</body>
</html>