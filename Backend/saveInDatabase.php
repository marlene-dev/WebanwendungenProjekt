<?php
include 'connectToDatabase.php';

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    session_start();
    if (isset($_SESSION["userId"])) {
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
        // the list of allowed field names
        $allowed = ["id","username","email", "streetname", "streetnumber"];

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
            $sqlCity = "SELECT city_id FROM userdata WHERE email = :email AND password = SHA2(:password, 256)";

            $conn->prepare("UPDATE city SET $setStr WHERE id = :id")->execute($params);
            http_response_code(200);  
            $response = array("message" => "Die Änderung war erfolgreich.");
        } catch(PDOException $e) {
            http_response_code(400);  
            $response = array("message" => "Fehler bei SQL Anfrage.");
        }
        closeDatabase();
    } else {
        // Setze den HTTP-Statuscode auf 401 Unauthorized
        http_response_code(401);  
        $response = array("message" => "Zugriff verweigert. Bitte loggen Sie sich ein.");
    }
} else {
$response = array("message" => "Ungültige HTTP-Anfrage");
http_response_code(405);
}

// Setze den Content-Type und gib die JSON-Antwort aus
header("Content-Type: application/json");
echo json_encode($response);

?>