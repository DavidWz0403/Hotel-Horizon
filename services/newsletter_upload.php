<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titel = isset($_POST['title']) ? $_POST['title'] : '';
    $input = isset($_POST['text']) ? $_POST['text'] : '';

    if (isset($_FILES['file'])) {
        $uploadVerzeichnis = '../uploads/';
        $uploadDatei = $uploadVerzeichnis . basename($_FILES['file']['name']);

        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadDatei)) {
            echo "Das Bild wurde erfolgreich hochgeladen: " . htmlspecialchars(basename($_FILES['file']['name']));
        } else {
            echo "Es gab einen Fehler beim Hochladen Ihres Bildes.";
        }
    }
}
?>
