<?php
include 'connectToDatabase.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    session_start();
    if (!isset($_SESSION["userId"])) {
        header("Location: Frontend/login.html");   
        exit(); 
    }

    if (isset($_POST["username"])) {
    $input_username = $_POST['username'];
    }
    if (isset($_POST["email"])) {
    $input_email = $_POST["email"];
    }
    if (isset($_POST["streetname"])) {
    $input_street = $_POST["streetname"];
    }
    if (isset($_POST["plz"])) {
    $input_plz = $_POST["plz"];
    }
    if (isset($_POST["town"])) {
    $input_town = $_POST["town"];
    }
    if (isset($_POST["country"])) {
    $input_country = $_POST["country"];
    }



    /*
    try {
        $sql = "SELECT * FROM userdata";
        $query = $conn->query($sql);
        foreach ($query as $row) {
        echo "<br/>" . $row["username"] . " "  . $row["email"]. " " . $row["streetname"];
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
*/

        // the list of allowed field names
    $allowed = ["id","username","streetname","email"];

    // initialize an array with values:
    $params = [];

    // initialize a string with `fieldname` = :placeholder pairs
    $setStr = "";

    // loop over source data array
    foreach ($allowed as $key) {
        if (isset($_POST[$key]) && $key != "id")
        {
            $setStr .= "`$key` = :$key,";
            $params[$key] = $_POST[$key];
        }
    }
    $setStr = rtrim($setStr, ",");

    $params['id'] = $_SESSION["userId"];

    try {
        $conn->prepare("UPDATE userdata SET $setStr WHERE id = :id")->execute($params);
        // Response from server to JS as Text
        echo "Die Änderungen wurden gespeichert.";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
/*
    try {
        $sql = "SELECT * FROM userdata";
        $query = $conn->query($sql);
        foreach ($query as $row) {
        echo "<br/>" . $row["username"] . " "  . $row["email"]. " " . $row["streetname"];
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
*/

    $conn = null;
}
?>