<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quest & Courses</title>
    <link rel="stylesheet" href="resources/login.css">
</head>
<body class="loginbackground" style="background-image: url('resources/assets/loginbackground.png');">
    <header>
        <h1>Login</h1>
    </header>
    <main>
        <div class="loginspacer"></div>
        <div class="login-container">
            <form method="post" action="">
                <div class="form-group">
                    <label for="username">Benutzername:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Passwort:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" name="submit">Einloggen</button> 
                <a href="register.html" class="register-link">Neu hier?</a>
            </form>
            <div class="message">
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Erfassen der Daten in Variablen
                    $inputusername = $_POST['username'];
                    $inputpassword = $_POST['password'];

                    try {
                        // Verbindungsaufbau mit der Datenbank
                        $dsn = 'mysql:host=localhost;dbname=questsandcourses;charset=utf8mb4';
                        $dbh = new PDO($dsn, 'root', '');

                        // Überprüfen der Benutzerdaten
                        $query = 'SELECT `Passwort` FROM `benutzer` WHERE `Username` = ?';
                        $stmt = $dbh->prepare($query);
                        $stmt->execute([$inputusername]);
                        $storedPassword = $stmt->fetchColumn();

                        // Wenn die Anmeldedaten stimmen, geb den Text aus und führe das JS aus
                        if ($storedPassword && $storedPassword === $inputpassword) {
                            echo "<span class='message success'>Erfolgreich eingeloggt. Weiterleitung in <span id='timer'>3</span> Sekunden...</span>";
                            // JS welches den Timer erstellt und den redirect auf den Index ausführt
                            echo "<script>
                                    var countdown = 3;
                                    var timer = setInterval(function() {
                                        countdown--;
                                        document.getElementById('timer').textContent = countdown;
                                        if (countdown === 0) {
                                            clearInterval(timer);
                                            window.location.href = 'index.html';
                                        }
                                    }, 1000);
                                  </script>";
                        
                        // Falsche Anmeldedaten
                        } else {
                            echo "<span class='message error'>Falsche Anmeldedaten</span>";
                        }
                    // Wenn die Datenbankverbindung scheitert
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
