<?php
include("./header.php");

function validatedata($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $mail = validatedata($_POST["mail"]);
    $vorname = validatedata($_POST["vorname"]);
    $nachname = validatedata($_POST["nachname"]);
    $username = validatedata($_POST["username"]);
    $password = validatedata($_POST["password"]);
    $password2 = validatedata($_POST["password2"]);
    $anrede = validatedata($_POST["anrede"]);

    if($password == $password2){
    }
    else{
        echo "Die eingegebenen Passwörter stimmen nicht überein.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrierung</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="./index.css" rel="stylesheet">
</head>
<body>
<h1>Registrierung</h1>
<p>Jetzt kostenfrei reservieren um ein Hotelzimmer zu buchen.</p>
<form action="registrierung.php" method="post">
    <div class="form-group">
        <label for="anrede">Geschlecht</label>
        <select class="register" id="anrede" name="anrede" required>
            <option>männlich</option>
            <option>weiblich</option>
            <option>divers</option>
            </select>
        </div>
    <div class="form-group">
            <label for="mail">Email-Adresse</label>
            <input type="email" class="register" id="mail" name="mail" placeholder="name@example.com" required>
         </div>
    <div class="form-group">
            <label for="mail">Vorname</label>
            <input type="text" class="register" id="vorname"  name="vorname" placeholder="Vorname" required>
        </div>
    <div class="form-group">
            <label for="mail">Nachname</label>
            <input type="text" class="register" id="nachname" name="nachname" placeholder="Nachname" required>
        </div>
    <div class="form-group">
            <label for="mail">Benutzername</label>
            <input type="text" class="register" id="username" name="username" placeholder="Benutzername" required>
        </div>
    <div class="form-group">
            <label for="mail">Passwort</label>
            <input type="password" class="register" id="password" name="password" placeholder="Passwort" required>
        </div>
    <div class="form-group">
            <label for="mail">Passwort wiederholen</label>
            <input type="password" class="register" id="password2" name="password2" placeholder="Passwort wiederholen" required>
        </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-primary">Reset</button>
</form>

    <div class="button">
        <button class="btn button-header btn-outline-warning"><a href="login.php">Bereits ein Konto? Hier mit deinem Konto anmelden.</a></button>
    </div>

</body>
</html>