// Funktion, welche sich um die Weiterleitung und den Abglich der Login Website kümmert
function handleLogin(event) {
    event.preventDefault(); 

    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    if (username === "testuser" && password === "testpass") {
        // Bei erfolgreicher Anmeldung
        window.location.href = "index.html";
    } else {
        // Fehlermeldung anzeigen
        alert("Benutzername oder Passwort ist falsch.");
    }
}

// Funktion zum Aktualisieren des aktuellen Jahres
document.addEventListener('DOMContentLoaded', function() {
    var currentYearElement = document.getElementById('currentYear');
    var currentYear = new Date().getFullYear();
    currentYearElement.textContent = currentYear;
});


// Funktion zum Hochladen von Profilbildern
function previewProfilePicture(event) {
    var preview = document.getElementById('profilePicturePreview');
    var file = event.target.files[0];
    var reader = new FileReader();

    reader.onloadend = function() {
        preview.src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "resources/assets/avatar.png";
    }
}

