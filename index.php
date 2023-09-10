<?php

// Was ist eine SQL Injection?

// Eine SQL-Injection (SQLI) ist eine Art von Sicherheitsangriff, bei dem ein Angreifer bösartigen SQL-Code in eine Anwendung einschleust, die Datenbankabfragen verwendet. 
// Diese Art von Angriff kann auftreten, wenn eine Anwendung unsicher ist und nicht ausreichend validiert oder geschützt ist, um Benutzereingaben zu verarbeiten.
// Der Angreifer nutzt normalerweise Eingabefelder oder Parameter in der Anwendung, um schädlichen SQL-Code einzufügen, der dann von der Datenbank ausgeführt wird. 
// Dies kann zu erheblichen Sicherheitsproblemen führen, darunter:

// 1. Datenbankzugriff: Der Angreifer kann Daten aus der Datenbank extrahieren, ändern oder löschen, je nachdem, welche Befehle er in den Angriff einfügt.

// 2. Informationen preisgeben: Durch SQL-Injektionen kann ein Angreifer vertrauliche Informationen wie Benutzernamen, Passwörter und andere sensible Daten abrufen.

// 3. Datenbankbeschädigung: Ein Angreifer kann auch Daten in der Datenbank zerstören oder manipulieren, was zu Datenverlust oder falschen Informationen führen kann.

// 4. Anwendungskompromittierung: In einigen Fällen kann eine erfolgreiche SQL-Injektion die Anwendung selbst gefährden und es einem Angreifer ermöglichen, die vollständige Kontrolle über das betroffene System zu übernehmen.

// Um SQL-Injektionen zu verhindern, sollten Entwickler sicherstellen, dass sie sich bewusst sind, wie sie Benutzereingaben in SQL-Abfragen sicher behandeln. 
// Dies beinhaltet die Verwendung von parametrisierten Abfragen oder vorbereiteten Anweisungen, um Eingabewerte zu trennen und zu verhindern, 
// dass sie als ausführbarer Code behandelt werden. Darüber hinaus sollten Sicherheitsprüfungen und Validierungen auf Benutzereingaben durchgeführt werden, 
// um schädliche Eingaben frühzeitig abzufangen. Es ist auch wichtig, dass Anwendungen regelmäßig auf Sicherheitslücken überprüft und aktualisiert werden, 
// um das Risiko von SQL-Injektionen und anderen Sicherheitsproblemen zu minimieren.


// Benutzereingaben sicher abrufen
$username = $_POST['username'];
$password = $_POST['password'];

// Datenbankverbindung herstellen (angenommen, Sie verwenden MySQLi)
$mysqli = new mysqli("localhost", "Benutzername", "Passwort", "Datenbankname");

// Überprüfen, ob die Verbindung erfolgreich hergestellt wurde
if ($mysqli->connect_error) {
    die("Verbindung zur Datenbank fehlgeschlagen: " . $mysqli->connect_error);
}

// Vorbereitete Anweisung verwenden, um SQL-Injektion zu verhindern
$query = "SELECT * FROM users WHERE username=? AND password=?";
$stmt = $mysqli->prepare($query);

// Überprüfen, ob die Anweisung erfolgreich vorbereitet wurde
if ($stmt === false) {
    die("Vorbereitung der Abfrage fehlgeschlagen: " . $mysqli->error);
}

// Parameter an die vorbereitete Anweisung binden
$stmt->bind_param("ss", $username, $password);

// Die vorbereitete Anweisung ausführen
$stmt->execute();

// Das Ergebnis abrufen
$result = $stmt->get_result();

// Überprüfen, ob Benutzer gefunden wurden
if ($result->num_rows > 0) {
    // Benutzer gefunden
    // Hier können Sie den entsprechenden Code ausführen
    echo "Benutzer gefunden!";
} else {
    // Benutzer nicht gefunden
    echo "Benutzer nicht gefunden!";
}

// Die Verbindung zur Datenbank schließen
$stmt->close();
$mysqli->close();



?>