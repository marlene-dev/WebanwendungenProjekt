<?php

$hostname = "localhost";
$userName = "root";
$password = "";
$myDB = "mydb";

try {
$conn = new PDO("mysql:host=$hostname;dbname=$myDB", $userName, $password);
//echo "Connected successfully";
} catch(PDOException $e) {
echo "Connection failed: " . $e->getMessage();
}

function closeDatabase() {
    $conn = null;
}

function startSession( $userId) {
    session_start();
    $_SERVER["userId"] = $userId;
}

function destroySession () {
    session_destroy();
}

?>