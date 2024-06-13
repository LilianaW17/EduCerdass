<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "cerdasedu";

$conn = mysqli_connect($servername, $db_username, $db_password, $dbname);

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    if(!$result){
        die("Query failed: " . mysqli_error($conn));
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }
}

?>