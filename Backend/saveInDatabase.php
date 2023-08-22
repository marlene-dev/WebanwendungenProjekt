<?php
include 'connectToDatabase.php';

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Empfange und dekodiere die JSON-Daten
    $requestData = json_decode(file_get_contents("php://input"), true);
    if (isset($_SESSION["userId"])){

        // the list of allowed field names
        $allowed = ["id","username","email", "streetname", "streetnumber", "cityname", "plz", "profilepicture"];
        $params = [];

        // initialize a string with `fieldname` = :placeholder pairs
        $setStr = "";

        // loop over source data array
        foreach ($allowed as $key) {
            if (isset($requestData[$key]) && $key != "id")
            {
                $setStr .= "`$key` = :$key,";
                $params[$key] = $requestData[$key];
            }
        }
        $setStr = rtrim($setStr, ",");

        $params['id'] = $_SESSION["userId"];

        try {
            //UPDATE userdata in Database
            $conn->prepare("UPDATE userdata SET $setStr WHERE id = :id")->execute($params);
            //UPDATE erfolgreich
            http_response_code(200);  
            $response = array("message" => "Die Änderung war erfolgreich.");  
            
        } catch(PDOException $e) {
            http_response_code(500);  
            $response = array("message" => "Fehler bei SQL Anfrage in userData:  ". $e->getMessage());
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
