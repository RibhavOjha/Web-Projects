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
$sql = "SELECT * FROM quizes";
$query = mysqli_query($conn, $sql);
$count = 0;
while ($result = mysqli_fetch_assoc($query)) {
    if ($_SESSION['quiz_name'] == $result['quiz_name']) {
        $quizes_id = $result['quiz_id'];
        break;
    }
}
$var = 7;
$_SESSION['var'] = 1;
$number_questions = $_SESSION['number_questions'];
echo $number_questions;
// echo $number_questions;
if (isset($_POST['submit'])) {
    for ($i = 0; $i < $number_questions; $i++) {
        // echo("Hi");
        if (isset($_SESSION['var'])) {
            // echo("HI");
            echo $_SESSION['var'];
            $question = $_POST[trim($_SESSION['var'])];
        }
        ++$_SESSION['var'];
        if (isset($_SESSION['var'])) {
            $option_1 = $_POST[$_SESSION['var']];
        }
        ++$_SESSION['var'];
        if (isset($_SESSION['var'])) {
            $option_2 = $_POST[$_SESSION['var']];
        }
        ++$_SESSION['var'];
        if (isset($_SESSION['var'])) {
            $option_3 = $_POST[$_SESSION['var']];
        }
        ++$_SESSION['var'];
        if (isset($_SESSION['var'])) {
            $option_4 = $_POST[$_SESSION['var']];
        }
        ++$_SESSION['var'];
        if (isset($_SESSION['var'])) {

            $correct_ans = $_POST[$_SESSION['var']];
        }
        ++$_SESSION['var'];

        $user_id_q = $_SESSION['id'];
        // $quizes_id = $count + 1;


        $INSERT_QUESTION = "INSERT INTO questions (question, option_1, option_2, option_3, option_4,correct_answer, userid, quizes_id) VALUES(?,?,?,?,?,?,?,?)";
        $stmt_question = $conn->prepare($INSERT_QUESTION);
        $stmt_question->bind_param("ssssssii", $question, $option_1, $option_2, $option_3, $option_4, $correct_ans, $user_id_q, $quizes_id);
        if ($stmt_question->execute()) {
            $success = True;
        }
        if (!$success) {
            $success = false;
            break;
        }
        $count++;
    }
    if (!$success) {
        echo("<script> alert('Could not add quiz') </script>'");
    }
    else {
        ob_start();
        echo("<script> alert('Quiz added Succesfully') </script>'");
        header("location: ../dashboard.php");
        ob_end_flush(); 

    }
}
?>  
