<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $input = isset($_POST['text']) ? $_POST['text'] : '';

    if (isset($_FILES['file'])) {
        $uploadVerzeichnis = './uploads/';
        $uploadDatei = $uploadVerzeichnis . basename($_FILES['file']['name']);

        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadDatei)) {
            echo "Das Bild wurde erfolgreich hochgeladen: " . htmlspecialchars(basename($_FILES['file']['name']));
        } else {
            echo "Es gab einen Fehler beim Hochladen Ihres Bildes.";
        }
    }
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
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Titel</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="News">
        </div>
        <div class="mb-3">
            <label for="text" class="form-label">Input</label>
            <textarea class="form-control" id="text" name="text" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">Bild hochladen</label>
            <input type="file" class="form-control" id="file" name="file">
        </div>
        <button type="submit" class="btn btn-primary">Absenden</button>
    </form>
   <?php if (isset($title) && isset($input) && isset($uploadDatei)): ?>
        <h1>Preview</h1>
        <h1> <?php echo $title; ?></h1>
        <?php
                $files = scandir($uploadVerzeichnis);
                $filePath = $uploadVerzeichnis . '/' . $files[0];
                
                echo "<img src='" . htmlspecialchars($filePath) . "' alt='" . htmlspecialchars($files[0]) . "' style='max-width:100px; max-height:100px;'>";
         ?>
        <p>  <?php echo $input; ?> </p>
        
    <?php endif; ?>
       
</body>
</html>