<?php

// Verbindung zur Datenbank herstellen
require_once "db_connection.php";
$conn = getConnection();

// Fehlermeldung ausgeben, wenn die Verbindung fehlschlägt
if (!$conn) {
    die("Verbindung zur Datenbank fehlgeschlagen: " . mysqli_connect_error());
}

// Anmeldedaten aus dem Formular holen
$username = 'BGB';
$password = $_POST['password'];

// Überprüfen, ob der Benutzer bereits zu viele Anmeldeversuche unternommen hat
session_start();
if(isset($_SESSION['last_attempt_time']) && $_SESSION['login_attempts'] >= 5 && time() - $_SESSION['last_attempt_time'] < 60) {
    // Der Benutzer hat zu viele Anmeldeversuche in der letzten Minute unternommen, die Anmeldung wird verweigert
    header("Location: login.html");
    exit();
}

// Abfrage vorbereiten und ausführen
$stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");

$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();

// Überprüfen, ob der username in der Datenbank vorhanden ist
if ($result->num_rows == 1) {

    // userdaten aus der Datenbank auslesen
    $row = $result->fetch_assoc();
    $hash = $row["passwordhash"];

    // password mit dem gespeicherten Hash vergleichen
    if (password_verify($password, $hash)) {
        // Anmeldung erfolgreich
        echo "Anmeldung erfolgreich";

        $_SESSION["username"] = $username;
        $_SESSION["login_attempts"] = 0; // Anzahl von Anmeldeversuchen zurücksetzen
        header("Location: content.php");
        exit();

    } else {
        // Passwort falsch
        echo "Passwort falsch";
        $_SESSION['login_attempts']++; // Anzahl von Anmeldeversuchen erhöhen
        $_SESSION['last_attempt_time'] = time(); // Zeitpunkt des letzten Anmeldeversuchs speichern
        header("Location: index.html");
        exit();

    }

} else {
    // username nicht gefunden
    header("Location: register.html");
    exit();
}

?>
