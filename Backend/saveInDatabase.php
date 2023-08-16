<?php
$hostname = "localhost";
$username = "root";
$password = "";
$myDB = "mydb";

try {
$conn = new PDO("mysql:host=$hostname;dbname=$myDB", $username, $password);
echo "Connected successfully";
} catch(PDOException $e) {
echo "Connection failed: " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["name"])) {
    $input_name = $_POST['name'];
    }
    $input_email = $_POST["email"];
    $input_street = $_POST["street"];
    $input_plz = $_POST["plz"];
    $input_town = $_POST["town"];
    $input_country = $_POST["country"];

    try {
        $sql = "SELECT * FROM userdata";
        $query = $conn->query($sql);
        foreach ($query as $row) {
        echo "<br/>" . $row["username"] . " "  . $row["email"]. " " . $row["streetname"];
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}




?>