<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include("./header.php");
    ?>
    <h1>Ihr Profil</h1>
    <h2>Ihre Daten<h2>
    <p>Um ihre Daten zu ändern, bitte die neuen Daten eingeben und auf Speichern drücken. Aus Sicherheitsgründen muss dies mit der Eingabe des Passwortes bestätigt werden.</p>
    <form action="profil.php" method="post">
    <div class="form-group">
        <label value="weiblich" for="anrede">Geschlecht</label>
        <select class="register" id="anrede" name="anrede" required>
            <option>männlich</option>
            <option>weiblich</option>
            <option>divers</option>
            </select>
        </div>
    <div class="form-group">
            <label for="mail">Email-Adresse</label>
            <input type="email" class="register" id="mail" name="mail" required value=<?php echo $_SESSION["Benutzer"]?>>
         </div>
    <div class="form-group">
            <label for="mail">Vorname</label>
            <input type="text" class="register" id="vorname"  name="vorname" value="Vorname" required>
        </div>
    <div class="form-group">
            <label for="mail">Nachname</label>
            <input type="text" class="register" id="nachname" name="nachname" value="Nachname" required>
        </div>
    <div class="form-group">
            <label for="mail">Benutzername</label>
            <input type="text" class="register" id="username" name="username" value="Benutzername" required>
        </div>
    <div class="form-group">
            <label for="mail">Passwort</label>
            <input type="password" class="register" id="password" name="password" required>
        </div>
    <button type="submit" class="btn btn-primary">Daten ändern</button>
    <button type="reset" class="btn btn-primary">Änderungen verwerfen</button>
</form>
</body>
</html>