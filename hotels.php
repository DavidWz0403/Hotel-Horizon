<?php
    include("./header.php");
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
    if ($_SESSION["role"]>0){
    $reservierungen = array (array("2023-11-20","2023-11-23",true,false,true),array("2023-11-30","2023-12-05",false,false,false)); #zukünftig hier die Reservierungen aus der DB laden.
    ?>
    <h1>Reservierungen</h1>
    <h2>Meine bisherigen Reservierungen</h2>
        <?php
            for($i=0;$i<count($reservierungen);$i++){
                echo $reservierungen[$i][0];
            }
    ?>
    <h2>Neue Reservierung</h2>
    <form action="reservierung.php" method="post">
    <div class="form-group">
            <label for="start">Anreisedatum</label>
            <input type="date" class="register" id="start" name="start" min="today" required>
         </div>
         <div class="form-group">
            <label for="start">Abreisedatum</label>
            <input type="date" class="register" id="end" name="end" min="Anreisedatum" required>
         </div>
    <div class="form-group">
            <label for="mail">Frühstück?</label>
            <input type="checkbox" class="register" id="breakfast" name="breakfast">
        </div>
    <div class="form-group">
            <label for="mail">Parkplatz?</label>
            <input type="checkbox" class="register" id="parkplatz" name="parkplatz">
        </div>
        <div class="form-group">
            <label for="mail">Haustiermitnahme?</label>
            <input type="checkbox" class="register" id="haustier" name="haustier">
        </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-primary">Reset</button>
</form>
    <?php
    }
    else{
        echo "Um deine bisherigen Reservierungen zu sehen und neue durchzuführen, bitte anmelden bzw. registrieren.";
    }
    ?>
</body>
</html>