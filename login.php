<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
<form name="contact" action="login.php" method="post">
    <div class="form-group">    
            <label for="mail">Benutzername</label>
            <input type="text" name="username" id="username" size="30" maxlength="50" required>
        </div>
    <div class="form-group">    
            <label for="mail">Passwort</label>
            <input type="password" name="password" id="password" value="" size="30" maxlength="50" required>
        </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-primary">Reset</button>
    </form>
</body>

<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $role = 0; #0 ist der initiale Wert der Rolle, steht für nicht eingeloggte Gäste.
    $username = trim(htmlspecialchars($_POST["username"]));
    $password = trim(htmlspecialchars($_POST["password"]));
    if($username=="admin"&&$password=="admin"){
        $role = 1; #1 steht für Admin
    }
    elseif($username== "user"&&$password== "user"){
        $role = 2; ##2 steht für User.
    }
    else{
        echo "Der eingegeben Benutzername oder das eingegbenen Passwort ist falsch.";
    }
    if($role>0){
        echo "Herzlich Willkommen ".$username; 
    }
}
?>
</html>