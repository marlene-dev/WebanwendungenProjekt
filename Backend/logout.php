<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    session_start();
    session_unset();
    session_destroy();

    // Setzt den Content-Type und gibt die JSON-Antwort aus
    http_response_code(200); 
    header("Content-Type: application/json");
    echo json_encode(array("message" => "Sie wurden erfolgreich abgemeldet"));
}

?>