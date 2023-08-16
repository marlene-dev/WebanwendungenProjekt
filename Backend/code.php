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

try {
    //$conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    $sql = "SELECT * FROM userdata";
    $query = $conn->query($sql);
    foreach ($query as $row) {
    echo "<br/>" . $row["username"] . "  " .  $row["streetname"];
    }
} catch(PDOException $e) {
echo "Error: " . $e->getMessage();
}

$conn = null;
?>

