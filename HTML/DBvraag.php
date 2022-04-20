<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "de levensbron gip";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO vragen (`Naam`, `E-mail`, `Vraag`) VALUES ('" . $_POST['Naam'] . "', '" . $_POST['E-mail'] . "', '" . $_POST['Vraag'] ."')";
setcookie('vraagmelding', json_encode($vraagmelding), time() + 600);

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
