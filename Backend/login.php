<?php

include 'connectToDatabase.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["email"])) {
    $input_email = $_POST["email"];
    } else {
        // Setze den HTTP-Statuscode 
        http_response_code(400);  
        echo "Zugriff verweigert. Die Email fehlt";    }
    if (isset($_POST["password"])) {
    $input_password = $_POST["password"];
    } else {
        // Setze den HTTP-Statuscode 
        http_response_code(400);  
        echo "Zugriff verweigert. Das Passwort fehlt";    }


    try {
        $sql = "SELECT * FROM userdata WHERE email = :email AND password = SHA2(:password, 256)";
        $stmt = $conn->prepare($sql);
        $param = [
            ':email' => $input_email,
            ':password' => $input_password
        ];
        $stmt->execute($param);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        startSession($result["id"]);
        //initialize testarray for JSON response
        $arrayData = ["username" => $input_username, "password" => $input_password];
        // do whatever we want with the users array.
        header('Content-type: application/json');
        echo json_encode( $arrayData );

    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
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

$arrayDataTest = ["username" => "testName", 
"email" => "testEmail",
"streetname" => "testStreet",
"number" => "123",
"plz" => "testPlz",
"town" => "testTown",
"country" => "testEngland"
];
// do whatever we want with the users array.
header('Content-type: application/json');
echo json_encode( $arrayDataTest );
}

$conn = null;
?>