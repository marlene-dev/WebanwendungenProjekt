<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Empfange und dekodiere die JSON-Daten
    $requestData = json_decode(file_get_contents("php://input"), true);

    if (isset($requestData["email"]) && isset($requestData["password"])) {

        $input_email = $requestData["email"];
        $input_password = $requestData["password"];

        include 'connectToDatabase.php';
        try {
            // Select all Userdata
            $sqlUser = "SELECT id FROM userdata WHERE email = :email AND password = SHA2(:password, 256)";
            $stmt = $conn->prepare($sqlUser);
            $param = [
                ':email' => $input_email,
                ':password' => $input_password
            ];
            $stmt->execute($param);
            $resultUserdata = $stmt->fetch(PDO::FETCH_ASSOC);
            // Anzahl der zurückgegebenen Zeilen überprüfen
            if ($stmt->rowCount() > 0) {
                http_response_code(200);  
                $response = array("message" => "Login war erfolgreich.");
                // öffne Session für login
                startSession($result["id"]);
            } else {
                http_response_code(400);  
                $response = array("message" => "Es gibt keinen User mit diesen Login-Daten.");
            }
        } catch(PDOException $e) {
            http_response_code(400);  
            $response = array("message" => "Fehler bei SQL Abfrage");
        }  
    }else {
        http_response_code(400);  
        $response = array("message" => "Zugriff verweigert. Die Email oder das Passwort ist ungültig");
    } 
} else {
    $response = array("message" => "Ungültige HTTP-Anfrage");
    http_response_code(405);
}

// Setze den Content-Type und gib die JSON-Antwort aus
header("Content-Type: application/json");
echo json_encode($response);

?>