<?php
if (isset($_POST['registrieren'])) {
  // Das Formular wurde gesendet, hier kannst du weitere Aktionen ausführen oder Daten verarbeiten

  // Beispiel: Überprüfung und Verarbeitung der eingegebenen Daten
  $vorname = $_POST['vorname'];
  $nachname = $_POST['nachname'];
  $email = $_POST['email'];
  $passwort = $_POST['passwort'];
  $frage1 = $_POST['frage1'];
  $frage2 = $_POST['frage2'];

  // Weitere Verarbeitung oder Speicherung der Daten

  // Weiterleitung zur Bestätigungsseite
  header('Location: erfolgreich.html');
  exit; // Wichtig, um den nachfolgenden HTML-Code nicht auszuführen
}
?>



