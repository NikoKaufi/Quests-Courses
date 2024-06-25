function handleLogin(event) {
    event.preventDefault(); // Verhindert das Standard-Formular-Absenden

    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    // Hier können Sie eine Überprüfung der Anmeldedaten hinzufügen
    // Zum Beispiel: Überprüfung gegen eine Liste von Benutzern
    if (username === "testuser" && password === "testpass") {
        // Bei erfolgreicher Anmeldung
        window.location.href = "index.html";
    } else {
        // Fehlermeldung anzeigen
        alert("Benutzername oder Passwort ist falsch.");
    }
}