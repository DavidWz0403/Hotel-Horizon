<?php
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="form.css" rel="stylesheet">
</head>
<body>
<?php include './header.php'; ?>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 shadow">
                    <h1 class="text-center mb-4">Registrierung</h1>
                    <p class="text-center">Jetzt kostenfrei registrieren, um ein Hotelzimmer zu buchen.</p>
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
                                <input type="text" class="form-control" id="username" name="username" placeholder="Benutzername" required>
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
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>  
        </div>  
    </div>
</body>
</html>