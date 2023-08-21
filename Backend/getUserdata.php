<?php
include 'connectToDatabase.php';
if (isset($_SESSION["userId"])){
  try {
      // Select all Userdata
      $sqlUser = "SELECT * FROM userdata WHERE email = :email AND 'password' = SHA2(:'password', 256)";
      $stmt = $conn->prepare($sqlUser);
      $param = [
          ':email' => $input_email,
          ':password' => $input_password
      ];
      $stmt->execute($param);
      $resultUserdata = $stmt->fetch(PDO::FETCH_ASSOC);

      // öffne Session für login
      startSession($result["id"]);

      // Select City with ID from Userdata
      $sqlCity = "SELECT * FROM city WHERE city_id = $resultUserdata[city_id]";
      $resultCity = $conn->exec($sqlCity);

      
      //initialize testarray for JSON response
      $arrayData = ["username" => $resultUserdata["username"], 
                    "email" => $resultUserdata["email"], 
                    "streetname" => $resultUserdata["streetname"],
                    "streenumber" => $resultUserdata["streetnumber"],
                    "plz" => $resultCity["plz"],
                    "town" => $resultCity["town"],
                    //"country" => $resultCity["country"],
                    "profilepicture" => $resultUserdata["profilepicture"],
                  ];

      $arrayDataTest = ["username" => "testName", 
      "email" => "testEmail",
      "streetname" => "testStreet",
      "number" => "123",
      "plz" => "testPlz",
      "town" => "testTown",
      "country" => "testEngland"
      ];
      // response 200 with json data
      http_response_code(200);
      header('Content-type: application/json');
      echo json_encode( $arrayDataTest );

  } catch(PDOException $e) {
      // error SQL statement wrong
      http_response_code(400);
      echo "Der User existiert nicht. Error: " . $e->getMessage();
  }
}
?>
