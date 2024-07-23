<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrierung</title>
    <link rel="stylesheet" href="resources/register.css">
</head>
<body class="loginbackground" style="background-image: url('resources/assets/loginbackground.png');">
    <header>
        <h1>Registrierung</h1>
    </header>
    <main>
        <div class="loginspacer"></div>
        <div class="login-container">
            <!-- Registrierung Formular -->
            <form method="post" action="">
                <div class="form-group">
                    <label for="username">Benutzername:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Passwort:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="firstname">Vorname:</label>
                    <input type="text" id="firstname" name="firstname" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Nachname:</label>
                    <input type="text" id="lastname" name="lastname" required>
                </div>
                <div class="form-group">
                    <label for="email">E-Mail-Adresse:</label>
                    <input type="email" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="birthdate">Geburtsdatum:</label>
                    <input type="date" id="birthdate" name="birthdate">
                </div>
                <button type="submit" name="submit">Registrieren</button> 
                <a href="login.php" class="register-link">Zurück zur Anmeldung</a>
            </form>
            <div class="message">
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Initzalisieren der Daten in Variablen
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $firstname = $_POST['firstname'];
                    $lastname = $_POST['lastname'];
                    $email = $_POST['email'];
                    $birthdate = $_POST['birthdate'];

                    try {
                        // Verbindungsaufbau mit der Datenbank
                        $dsn = 'mysql:host=localhost;dbname=questsandcourses;charset=utf8mb4';
                        $dbh = new PDO($dsn, 'root', '');

                        // Überprüfen, ob der Benutzername bereits existiert
                        $query = 'SELECT COUNT(*) FROM `benutzer` WHERE `Username` = ?';
                        $stmt = $dbh->prepare($query);
                        $stmt->execute([$username]);
                        $exists = $stmt->fetchColumn();

                        if ($exists) {
                            echo "<span class='message error'>Benutzername ist bereits vergeben</span>";
                        } else {
                            // Benutzer registrieren
                            $query = 'INSERT INTO `benutzer` (`Username`, `Passwort`, `Vorname`, `Nachname`, `E_Mail_Adresse`, `Geburtsdatum`) VALUES (?, ?, ?, ?, ?, ?)';
                            $stmt = $dbh->prepare($query);
                            $stmt->execute([$username, $password, $firstname, $lastname, $email, $birthdate]);

                            echo "<span class='message success'>Registrierung erfolgreich. Weiterleitung zur Anmeldung...</span>";
                            echo "<script>
                                    setTimeout(function() {
                                        window.location.href = 'login.php';
                                    }, 3000);
                                  </script>";
                        }

                    // Wenn keine Verbindung mit der Datenbank hergestellt werden kann
                    } catch (PDOException $e) {
                        echo "<span class='message error'>Interner Fehler: Die Datenbank-Verbindung konnte nicht aufgebaut werden.</span>";
                    }
                }
                ?>
            </div>
        </div>
    </main>
    <script src="resources/script.js"></script>
</body>
</html>
