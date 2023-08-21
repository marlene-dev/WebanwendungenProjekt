<?php
session_start();

/*
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

$username = $_SESSION["username"];
*/
$hostname = "localhost";
$username = "root";
$password = "";
$myDB = "mydb";

try {
$conn = new PDO("mysql:host=$hostname;dbname=$myDB", $username, $password);
//echo "Connected successfully";
} catch(PDOException $e) {
echo "Connection failed: " . $e->getMessage();
}
/*
try {
$sql = "SELECT * FROM userdata";
$query = $conn->query($sql);
foreach ($query as $row) {
echo "<br/>" . $row["username"] . "  " .  $row["streetname"];
}
} catch(PDOException $e) {
echo "Error: " . $e->getMessage();
}
*/
try {
$user_id = 'user1';
$sql = "SELECT * FROM userdata WHERE id = '1'";
$result = $conn->query($sql);
$datensatz = $result->fetch();

$username =  $datensatz["username"];
$email =  $datensatz["email"];
$bild =  $datensatz["profilepicture"];


} catch(PDOException $e) {
echo "Error: " . $e->getMessage();
}
$conn = null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
  <div class="data_container">
      <div class="data_field">
      <div class="userDataContainer" id='userInformation'>
        <div class="userData">
          <div id="name">Name: <?= $username ?></div>
          <div id="email">Email: <?= $email ?></div>
          <div id="street"></div>
          <div id="town"></div>
        </div>
      </div>
      <button type="submit" class="change_form_button">Bearbeiten</button>
    </div>
  </div>
<!--
    <form action="action.php" method="post">
    <p>Username: <input type="text" name="name" /></p>
    <p>Ihr Alter: <input type="text" name="alter" /></p>
    <p><input type="submit" /></p>
    </form>
-->
</body>
</html>
