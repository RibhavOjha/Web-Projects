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




$quiz_id = trim($_POST['update_hidden']);

// $quiz_id = " . $quiz_id . ";
$_SESSION['var'] = 1;
$x = 0;
// $number_questions = $_SESSION['number_questions'];

// $sql = "SELECT * FROM questions WHERE quizes_id = '" . $quiz_id . "' ";
$sql = "SELECT * FROM questions ";
$query = mysqli_query($conn, $sql) or die("Query Unsuccessful");
// $result = mysqli_fetch_array($query);
// $limit = (int)$result[0];
// echo $limit;
$success = False;
// echo $number_questions;
// echo $number_questions;
if (isset($_POST['submit'])) {
    while ($row = mysqli_fetch_assoc($query)) {
        if ($quiz_id == $row['quizes_id']) {
            // echo("Hi");
            if (isset($_POST[$_SESSION['var']])) {
                // echo("HI");
                echo("QUESTION ");
                echo $_POST[$_SESSION['var']];
                echo "  ";
                $question = $_POST[trim($_SESSION['var'])];
            // echo("QUESTION: ");
            // echo $question;
            }
            ++$_SESSION['var'];
            if (isset($_POST[$_SESSION['var']])) {
                $option_1 = $_POST[$_SESSION['var']];
            // echo("OPYION1: ");
            // echo $option_1;
            }
            ++$_SESSION['var'];
            if (isset($_POST[$_SESSION['var']])) {
                $option_2 = $_POST[$_SESSION['var']];
            // echo("option2: ");
            // echo $option_2;
            }
            ++$_SESSION['var'];
            if (isset($_POST[$_SESSION['var']])) {
                $option_3 = $_POST[$_SESSION['var']];
            // echo("option3: ");
            // echo $option_3;

            }
            ++$_SESSION['var'];
            if (isset($_POST[$_SESSION['var']])) {
                $option_4 = $_POST[$_SESSION['var']];
            // echo("option4: ");
            // echo $option_4;
            }
            ++$_SESSION['var'];
            if (isset($_POST[$_SESSION['var']])) {

                $correct_ans = $_POST[$_SESSION['var']];
            // echo("Correct answer: ");
            // echo $correct_ans;
            }
            ++$_SESSION['var'];

            $user_id_q = $_SESSION['id'];
            $user_id_q = " . $user_id_q . ";
            $questions_id = $row['questions_id'];
            // echo("LOOP  ");
            // echo("QUESTION ID: ");
            // echo $questions_id;
            // echo("  ");
            // echo("Quiz ID: ");
            // echo $quiz_id . "\r\n";

            $UPDATE_QUESTION = "UPDATE questions SET question = ?, option_1=?, option_2=?, option_3=?, option_4=?,correct_answer=? WHERE quizes_id = '$quiz_id' AND questions_id = ' $questions_id' ";
            $stmt_question = $conn->prepare($UPDATE_QUESTION);
            $stmt_question->bind_param("ssssss", $question, $option_1, $option_2, $option_3, $option_4, $correct_ans);
            if ($stmt_question->execute()) {
                // echo("asd");
                // print_r($stmt_question);
                // echo("  %%%%  ");
                // // print_r($stmt_question->bind_param("ssssssi", $question, $option_1, $option_2, $option_3, $option_4, $correct_ans, $quizes_id));
                // // echo($x);
                // // $x = $x+1;
                // echo("Success");
                $success = True;
            }
            else {
                $success = False;
                break;
            }

        }
    }
    if ($success == False) {
        echo("<script> alert('Could not Update quiz') </script>'");
        echo("BAD");
    }
    else {
        // ob_start();
        // echo("<script> alert('Quiz updated Succesfully') </script>'");
        header("location:../dashboard.php");
        echo("final");
    // ob_end_flush(); 

    }
}
?>