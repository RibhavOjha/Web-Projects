<?php
$dbname = "first";
$tablename = "table";
$con = mysqli_connect("localhost", "root");
if (!$con){
    echo mysqli_connect_error();
}
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";

if (mysqli_query($con, $sql)){
    $con = mysqli_connect("localhost", "root",'', $dbname );
    $sql = "CREATE TABLE IF NOT EXISTS `$tablename`
    (`id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `option1` VARCHAR(25) NOT NULL,
    `option2` VARCHAR(25) NOT NULL,
    `option3` VARCHAR(25) NOT NULL,
    `option4` VARCHAR(25) NOT NULL
    )";

    if (!mysqli_query($con, $sql)){
        echo mysqli_error($con);
    }

}
else{
    echo mysqli_error($con);
}
?>