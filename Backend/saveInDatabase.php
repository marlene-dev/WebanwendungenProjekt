<?php
include 'connectToDatabase.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

 /*   session_start();
    if (!isset($_SESSION["userId"])) {
        // Setze den HTTP-Statuscode auf 401 Unauthorized
        http_response_code(401);  
        // Zeige eine Fehlermeldung oder eine Erklärung an den Benutzer
        echo "Zugriff verweigert. Bitte loggen Sie sich ein.";
        exit(); 
    }
*/
    if (isset($_POST["username"])) {
    $input_username = $_POST['username'];
    }
    if (isset($_POST["email"])) {
    $input_email = $_POST["email"];
    }
    if (isset($_POST["streetname"])) {
    $input_street = $_POST["streetname"];
    }
    if (isset($_POST["number"])) {
        $input_street = $_POST["number"];
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

        // the list of allowed field names
    $allowed = ["id","username","email", "streetname", "streetnumber"];  //, "plz", "town", "country"

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

    $params['id'] = "1"; //$_SESSION["userId"];

    try {
        $conn->prepare("UPDATE userdata SET $setStr WHERE id = :id")->execute($params);
        // Response from server to JS as Text
        echo "Die Änderungen wurden gespeichert.";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}
?>