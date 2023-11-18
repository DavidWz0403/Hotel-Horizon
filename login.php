<?php
session_start();
$_SESSION["visited"] = FALSE;
if (!$_SESSION["visited"]){
    $_SESSION["role"] = 0;
    $_SESSION["Benutzer"] = "";
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = trim(htmlspecialchars($_POST["username"]));
    $password = trim(htmlspecialchars($_POST["password"]));
    if($username=="admin"&&$password=="admin"){
        $_SESSION["role"] = 1; #1 steht für Admin
    }
    elseif($username== "user"&&$password== "user"){
        $_SESSION["role"] = 2; ##2 steht für User.
    }
    else{
        echo "Der eingegeben Benutzername oder das eingegbenen Passwort ist falsch.";
    }
    $_SESSION["Benutzer"] = $username;
}
include("./header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="./index.css" rel="stylesheet">
</head>

<?php
if($_SESSION["role"] == 0){
    $_SESSION["visited"] = TRUE;
?>

<body>
<h1>Anmelden</h1>
<p>Wenn du bereits ein Konto hast, kannst du dich hier anmelden.</p>
<form name=contact action=login.php method=post>
    <div class=form-group>    
            <label for=mail>Benutzername*</label>
            <input type=text name=username id=username size="30" maxlength="50" required>
        </div>
    <div class=form-group>    
            <label for=mail>Passwort*</label>
            <input type=password name=password id=password value="" size="30" maxlength="50" required>
        </div>
    <button type=submit class=btn btn-primary>Submit</button>
    <button type=reset classbtn btn-primary>Reset</button>
    </form>
    <div class="button">
        <button class="btn button-header btn-outline-warning mr-2"><a href="registrierung.php">Noch kein Konto, hier kostenfrei registrieren</a></button>
        </div>

</body>

<?php
}
else{
    echo "Herzlich Willkommen auf unserer Seite ".$_SESSION["Benutzer"];
    ?>
    <form name=contact action=logout.php method=post>
    <button type=submit class=btn btn-primary>Logout</button>
    <?php
}

?>
</html>