<?php
include 'connectToDatabase.php';

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Empfange und dekodiere die JSON-Daten
    $requestData = json_decode(file_get_contents("php://input"), true);
    if (isset($requestData["userId"])) {
        if (isset($requestData["username"])) {
        $input_username = $requestData['username'];
        }
        if (isset($requestData["email"])) {
        $input_email = $requestData["email"];
        }
        if (isset($requestData["streetname"])) {
        $input_street = $requestData["streetname"];
        }
        if (isset($requestData["number"])) {
            $input_street = $requestData["number"];
        }
        if (isset($requestData["plz"])) {
        $input_plz = $requestData["plz"];
        }
        if (isset($requestData["town"])) {
        $input_town = $requestData["town"];
        }
        // the list of allowed field names
        $allowed = ["id","username","email", "streetname", "streetnumber"];

        // initialize an array with values:
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
            // update City in Database
            $userId = $_SESSION["userId"];
            $sqlCity = "SELECT city_id FROM city WHERE town = $input_town AND plz = $input_plz";
            $stmt = $conn->query($sqlCity);
            
            // Anzahl der zurückgegebenen Zeilen überprüfen
            if ($stmt->rowCount() > 0) {
                $rightCity = $stmt->fetch(PDO::FETCH_ASSOC);
                $newCityId = $rightCity["city_Id"];
            } else {
                $conn->prepare("INSERT INTO city (cityname, plz) VALUES ($input_town, $input_plz");
            }
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