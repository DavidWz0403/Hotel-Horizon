<?php
function validatedata($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = validatedata($_POST["username"]);
    $password = validatedata($_POST["password"]);
    if($username=="admin"&&$password=="admin"){
        $_SESSION["role"] = 1;
    }
    elseif($username== "user"&&$password== "user"){
        $_SESSION["role"] = 2;
    }
    else{
        echo "Der eingegeben Benutzername oder das eingegbenen Passwort ist falsch.";
    }
    $_SESSION["Benutzer"] = $username;
    $_SESSION["Passwort"] = $password;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="form.css" rel="stylesheet">
</head>
<body>
    <?php include './header.php'; ?>
    <div class="container my-5">
        <div class="row justify-content-center"> 
            <div class="col-md-6">
                <?php if ($_SESSION["role"] === 0): ?>
                    <div class="card custom-card-style p-4 shadow ">
                        <h1 class="text-center mb-4">Anmelden</h1>
                        <p class="text-center">Wenn du bereits ein Konto hast, kannst du dich hier anmelden.</p>
                        <form action="login.php" method="post">
                            <div class="mb-3">    
                                <label for="username" class="form-label">Benutzername*</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="mb-3">    
                                <label for="password" class="form-label">Passwort*</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="d-grid gap-2"> <!-- Button group for full width -->
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>
                        <div class="mt-4 text-center">
                            <a href="registrierung.php" class="btn btn-outline-warning">Noch kein Konto, hier kostenfrei registrieren</a>
                        </div>
                    </div>
                <?php else: ?>
                    <h1 class="text-center">Herzlich Willkommen <?php echo $_SESSION["Benutzer"]; ?></h1>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>