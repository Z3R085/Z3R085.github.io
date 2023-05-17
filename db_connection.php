<?php
function getConnection() {
//Extra-Skript um Datenbankverbindung herzustellen
$servername = "localhost";
$username = "root";
$password = "flo";
$dbname = "web";

// Verbindung herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Prüfen, ob Verbindung erfolgreich hergestellt wurde
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


return $conn;
}
?>
