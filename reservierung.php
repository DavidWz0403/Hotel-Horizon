<?php
    include("./header.php");
    function validatedata($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    
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
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $start = validatedata($_POST["start"]);
        $end = validatedata($_POST["end"]);
        $breakfast = $_POST["breakfast"];
        $parkplatz = $_POST["parkplatz"];
        $haustier = $_POST["haustier"];
        $dates = $end - $start;
        $price = ;
    }
    ?>
    <h1>Reservierungen</h1>
    <h2>Neue Reservierung</h2>
    Es wird eine neue Reservierung angelegt. Bitte die Daten kontrollieren und bestätigen.
    <?php
    echo "Anreisedatum: ".$start;
    echo "Abreisedatum: ".$end;
    echo "Anzahl Tage: ". $dates;
    if($breakfast){echo" Frühstück ist für jeden Tag inkludiert.";}
    if($parkplatz){echo" Ein Parkplatz ist für die gesamte Aufenthaltsdauer inkludiert.";}
    if($haustier){echo" Die Mitnahme eines Haustieres ist gestattet.";}
    echo "Der Gesamtpreis beträgt: ".$price;
    ?>
</body>
</html>