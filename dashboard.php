
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Dash Board</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    
    <nav>
        <ul>
            <li><h1> QUIZ MAKER</li>
            <li> <h3> Welcome to the DashBoard, <?php session_start(); echo $_SESSION['username']?></h3></li>
            <form method = 'POST'>
            <button type = "submit" formaction = "logout.php" name="logout"> Logout</a>
            </form>

        </ul>
    </nav>

    <div class="container">
        <a href = "quizes/my_quizes.php">My Quizes </a>
        <a href = "#">Add quiz </a>
    </div>


    

    
</body>
</html>