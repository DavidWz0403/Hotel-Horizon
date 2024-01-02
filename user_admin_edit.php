<?php 
function validatedata($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$output = "";

require_once("dbacess.php");
$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);


$output = "";
$error_message = "";
$success_message = "";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['role']) || $_SESSION["role"] !== 1) {
    header('Location: login.php');
    exit();
}

$userId = $_GET['id'] ?? null;
$user = null;
$error_message = '';
$success_message = '';

// Laden Sie die Benutzerdaten, wenn die Seite zum ersten Mal geladen wird
if ($userId) {
    $stmt = $connection->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $originalUsername = $user["username"] ?? '';
    } else {
        $error_message = "Benutzer nicht gefunden.";
    }
    $stmt->close();
}



if($_SERVER["REQUEST_METHOD"] == "POST"){
    $anrede = validatedata($_POST["anrede"]);
    $username = validatedata($_POST["username"]);
    $mail = validatedata($_POST["mail"]);
    $vorname = validatedata($_POST["vorname"]);
    $nachname = validatedata($_POST["nachname"]);
    $password = validatedata($_POST["password"]);
    $status = validatedata($_POST["status"]);

    
    
    $passwordChange = '';
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $passwordChange = ", passwort=?";
    }

    $updateQuery = "UPDATE user SET anrede=?, mail=?, vorname=?, nachname=?, username=?, status=? {$passwordChange} WHERE id=?";
    $stmt = $connection->prepare($updateQuery);

    // Binden Sie Parameter basierend darauf, ob das Passwort aktualisiert werden soll oder nicht
    if (!empty($password)) {
        $stmt->bind_param("sssssssi", $anrede, $mail, $vorname, $nachname, $username, $status, $hashedPassword, $userId);
    } else {
        $stmt->bind_param("ssssssi", $anrede, $mail, $vorname, $nachname, $username, $status, $userId);
    }
    
    if ($stmt->execute()) {
        $success_message = "Die Änderungen wurden erfolgreich durchgeführt.";
        header('Location: user_admin_übersicht.php');
    } else {
        $error_message = "Fehler bei der Aktualisierung der Daten: " . $connection->error;
    }
    $stmt->close();
}
   

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

        if($_SESSION["role"]>0){

    ?>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 shadow">
                    <h1 class="text-center mb-4">Profil Bearbeitung <?php echo $originalUsername ?> </h1>
                    <form action="user_admin_edit.php?id=<?php echo $userId; ?>" method="post">
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
                                <input type="email" class="form-control" id="mail" name="mail" placeholder="name@example.com" value=<?php echo isset($user["mail"]) ? htmlspecialchars($user["mail"]) : ''; ?> required>
                            </div>
                        <div class="mb-3">  
                                <label for="mail" class="form-label">Vorname</label>
                                <input type="text" class="form-control" id="vorname" name="vorname" placeholder="Vorname" value="<?php echo isset($user["vorname"]) ? htmlspecialchars($user["vorname"]) : ''; ?>" required>
                            </div>
                        <div class="mb-3">  
                                <label for="mail" class="form-label">Nachname</label>
                                <input type="text" class="form-control" id="nachname" name="nachname" placeholder="Nachname" value=<?php echo isset($user["nachname"]) ? htmlspecialchars($user["nachname"]) : ''; ?> required>
                            </div>
                        <div class="mb-3">  
                                <label for="mail" class="form-label">Benutzername</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Benutzername" value=<?php echo isset($user["username"]) ? htmlspecialchars($user["username"]) : ''; ?> required>
                            </div>
                        <div class="mb-3">  
                                <label for="mail" class="form-label">Passwort</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Passwort" >
                        </div>

                        <div class="mb-3">  
                            <label for="status"  class="form-label">Status</label>
                            <select id="status" name="status" class="form-control" required>
                            <option value="active" <?php echo (isset($user["status"]) && $user["status"] == 'active') ? 'selected' : ''; ?>>active</option>
                            <option value="inactive" <?php echo (isset($user["status"]) && $user["status"] == 'inactive') ? 'selected' : ''; ?>>inactive</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Daten ändern</button>
                                <button type="reset" class="btn btn-secondary">Änderungen verwerfen</button>
                        </div>

                        

                        <?php if (!empty($error_message)): ?>
                            <div class="alert alert-danger">
                                <?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($success_message)): ?>
                            <div class="alert alert-success">
                                <?php echo $success_message; ?>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>  
        </div>  
    </div>
</body>
</html>
<?php
        }
        else{
            echo "Sie haben keine Berechtigung diese Seite zu sehen.";
        }
        echo $output;