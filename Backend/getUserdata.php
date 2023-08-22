<?php
include 'connectToDatabase.php';

session_start();
if (isset($_SESSION["userId"])){
  $userId = $_SESSION["userId"];
  try {
      // Select all Userdata
      $sqlUser = "SELECT * FROM userdata WHERE id = $userId";
      $stmtUser = $conn->query($sqlUser);
      $resultUserdata = $stmtUser->fetch(PDO::FETCH_ASSOC);

      // // Select City with ID from Userdata
      // $sqlCity = "SELECT * FROM city WHERE city_id = $resultUserdata[city_id]";
      // $stmtCity = $conn->query($sqlCity);
      // $resultCity = $stmtCity->fetch(PDO::FETCH_ASSOC);

      $arrayData = ["username" => $resultUserdata["username"], 
              "email" => $resultUserdata["email"], 
              "streetname" => $resultUserdata["streetname"],
              "streetnumber" => $resultUserdata["streetnumber"],
              "plz" => $resultUserdata["plz"],
              "town" => $resultUserdata["cityname"],
              "profilepicture" => $resultUserdata["profilepicture"],
            ];
      // response 200 with json data
      http_response_code(200);
      header('Content-type: application/json');
      $response = $arrayData;

  } catch(PDOException $e) {
      // error SQL statement wrong
      http_response_code(400);
      $response = array("message" => "Der User existiert nicht. Error: " . $e->getMessage());
  }
} else {
  http_response_code(401);  
  $response = array("message" => "Zugriff verweigert. Bitte loggen Sie sich ein.");
}
// Setze den Content-Type und gib die JSON-Antwort aus
header("Content-Type: application/json");
echo json_encode($response);
?>
