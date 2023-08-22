<?php
$hostname = "localhost";
$userName = "root";
$password = "";
$myDB = "mydb";

try {
$conn = new PDO("mysql:host=$hostname;dbname=$myDB", $userName, $password);
//echo "Connected successfully";
} catch(PDOException $e) {
    // Setze den HTTP-Statuscode auf 404 Connection error
    http_response_code(404);  
    echo "Connection to Database failed: " . $e->getMessage();
    exit();
}

function closeDatabase() {
    $conn = null;
}

function startSession( $userId) {
    session_start();
    $_SESSION["userId"] = $userId;
}
?>
