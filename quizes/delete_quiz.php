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

// $sql_quizzes = "SELECT * FROM quizes";
// $result_quizzes = mysqli_query($conn, $sql_quizzes);
// while ($row_quizzes = mysqli_fetch_assoc($result_quizzes)) {
// echo($_POST[$row_quizzes['quiz_id']]);
$sql = "SELECT * FROM quizes ";
$result = mysqli_query($conn, $sql) or die("Query Unsuccessful");
while ($row = mysqli_fetch_assoc($result)) {
    if (isset($_POST['delete_hidden'])) {
        $quiz_id = $_POST['delete_hidden'];
        echo($quiz_id);
        echo("hi");
        break;
    }
    else {
        echo("Nope");
    }
}
// }

if (isset($quiz_id)) {
    $DELETE = "DELETE FROM questions WHERE quizes_id = '" . $quiz_id . "' ";
    if ($conn->query($DELETE) === TRUE) {

    }
    else {
        echo "Error deleting record: " . $conn->error;
    }

    $DELETE = "DELETE FROM quizes WHERE quiz_id = '" . $quiz_id . "' ";
    if ($conn->query($DELETE) === TRUE) {
        echo "Record deleted successfully";
        header("location:my_quizes.php");
    }
    else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}
?>