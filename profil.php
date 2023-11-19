<?php 
function validatedata($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$output = "";
?>

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
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $username = validatedata($_POST["username"]);
            $mail = validatedata($_POST["mail"]);
            $vorname = validatedata($_POST["vorname"]);
            $nachname = validatedata($_POST["nachname"]);
            $npw = validatedata($_POST["npw"]);
            $password = validatedata($_POST["password"]);
            if($password==$_SESSION["Passwort"]){
                $_SESSION["Benutzer"] = $username;
                $_SESSION["mail"] = $mail;
                $_SESSION["vorname"] =$vorname;
                $_SESSION["nachname"] = $nachname;
                if(!$npw == ""){
                    $_SESSION["Passwort"] = $npw;
                    $output = "Das Passwort wurde erfolgreich geändert.";
                }
                $output = "Die Änderungen wurden erfolgreich durchgeführt.";
            }
            else{
                $output = "Das Passwort ist nicht korrekt.";
            }
        }

        if($_SESSION["role"]>0){
            #Zukünftig werden hier die Daten aus der Datenbank geladen.
            if(!isset($_SESSION["mail"])){$_SESSION["mail"]="test@test.at";}
            if(!isset($_SESSION["vorname"])){$_SESSION["vorname"]="Max";}
            if(!isset($_SESSION["nachname"])){$_SESSION["nachname"]="Mustermann";}

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
            <input type="email" class="register" id="mail" name="mail" required value=<?php echo $_SESSION["mail"]?>>
         </div>
    <div class="form-group">
            <label for="mail">Vorname</label>
            <input type="text" class="register" id="vorname"  name="vorname" value=<?php echo $_SESSION["vorname"]?> required>
        </div>
    <div class="form-group">
            <label for="mail">Nachname</label>
            <input type="text" class="register" id="nachname" name="nachname" value=<?php echo $_SESSION["nachname"]?> required>
        </div>
    <div class="form-group">
            <label for="mail">Benutzername</label>
            <input type="text" class="register" id="username" name="username" value=<?php echo $_SESSION["Benutzer"]?> required>
        </div>
        <div class="form-group">
            <label for="mail">Neues Passwort</label>
            <input type="password" class="register" id="npw" name="npw">
        </div>
    <div class="form-group">
            <label for="mail">Passwort</label>
            <input type="password" class="register" id="password" name="password" required>
        </div>
    <button type="submit" class="btn btn-primary">Daten ändern</button>
    <button type="reset" class="btn btn-primary">Änderungen verwerfen</button>
</form>
<?php
echo $output;
}

?>

</body>
</html>