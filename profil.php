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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="form.css" rel="stylesheet">
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
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 shadow">
                    <h1 class="text-center mb-4">Ihr Profil</h1>
                    <p class="text-center">Um ihre Daten zu ändern, bitte die neuen Daten eingeben und auf Speichern drücken. Aus Sicherheitsgründen muss dies mit der Eingabe des Passwortes bestätigt werden.</p>
                    <form action="registrierung.php" method="post">
                        <div class="mb-3">  
                            <label for="anrede"  class="form-label">Geschlecht</label>
                            <select id="anrede" name="anrede" class="form-control" required>
                                <option>männlich</option>
                                <option>weiblich</option>
                                <option>divers</option>
                                </select>
                            </div>
                        <div class="mb-3">  
                                <label for="mail" class="form-label">Email-Adresse</label>
                                <input type="email" class="form-control" id="mail" name="mail" placeholder="name@example.com" required>
                            </div>
                        <div class="mb-3">  
                                <label for="mail" class="form-label">Vorname</label>
                                <input type="text" class="form-control" id="vorname"  name="vorname" placeholder="Vorname" required>
                            </div>
                        <div class="mb-3">  
                                <label for="mail" class="form-label">Nachname</label>
                                <input type="text" class="form-control" id="nachname" name="nachname" placeholder="Nachname" required>
                            </div>
                        <div class="mb-3">  
                                <label for="mail" class="form-label">Benutzername</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Benutzername" value=<?php echo $_SESSION["Benutzer"]?> required>
                            </div>
                        <div class="mb-3">  
                                <label for="mail" class="form-label">Passwort</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Passwort" required>
                            </div>
                        <div class="mb-3">  
                                <label for="mail" class="form-label">Passwort wiederholen</label>
                                <input type="password" class="form-control" id="password2" name="password2" placeholder="Passwort wiederholen" required>
                        </div>

                        <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Daten ändern</button>
                                <button type="reset" class="btn btn-secondary">Änderungen verwerfen</button>
                        </div>
                    </form>
                </div>
            </div>  
        </div>  
    </div>
</body>
</html>