<?php
require_once("dbacess.php");
$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

$datum = date('Y-m-d');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $content = isset($_POST['text']) ? $_POST['text'] : '';
    $uploadVerzeichnis = './uploads/';
    $uploadThumbnailVerzeichnis = './thumbnails/';

    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = $_FILES['file']['type'];

        if (in_array($fileType, $allowedTypes)) {
            $filename = basename($_FILES['file']['name']);
            $uploadDatei = $uploadVerzeichnis . $filename;
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadDatei)) {
                echo "Das Bild wurde erfolgreich hochgeladen: " . htmlspecialchars($filename);

                
                list($width, $height) = getimagesize($uploadDatei);
                $newWidth = 200;
                $newHeight = 200; 

                $thumbnail = imagecreatetruecolor($newWidth, $newHeight);

                switch ($fileType) {
                    case 'image/jpeg':
                        $image = imagecreatefromjpeg($uploadDatei);
                        break;
                    case 'image/png':
                        $image = imagecreatefrompng($uploadDatei);
                        break;
                    case 'image/gif':
                        $image = imagecreatefromgif($uploadDatei);
                        break;
                }

              
                $original_aspect = $width / $height;
                $thumb_aspect = $newWidth / $newHeight;

                if ($original_aspect >= $thumb_aspect) {
                    $new_height = $newHeight;
                    $new_width = $width / ($height / $newHeight);
                    $x_offset = ($new_width - $newWidth) / 2;
                    $y_offset = 0;
                } else {
                    $new_width = $newWidth;
                    $new_height = $height / ($width / $newWidth);
                    $x_offset = 0;
                    $y_offset = ($new_height - $newHeight) / 2;
                }

    imagecopyresampled($thumbnail, $image, 0, 0, $x_offset, $y_offset, $new_width, $new_height, $width, $height);
    $thumbnailFilename = 'thumb_' . $filename;
    $thumbnailPath = $uploadThumbnailVerzeichnis . $thumbnailFilename;

    if (imagejpeg($thumbnail, $thumbnailPath, 90)) { 
        imagedestroy($thumbnail);
    } else {
        $error_message = "Fehler beim Erstellen des Thumbnails.";
    }
                $stmt = $connection->prepare("INSERT INTO news (path, thumbnailPath, title, content, datum) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $uploadDatei, $thumbnailPath, $title, $content, $datum);
                $stmt->execute();
                if ($stmt->affected_rows > 0) {
                    $success_message = "Der Beitrag wurde erfolgreich erstellt.";
                } else {
                    $error_message = "Fehler beim Erstellen des Beitrags.";
                }

            } else {
                $error_message = "Es gab einen Fehler beim Hochladen Ihres Bildes.";
            }
        } else {
            $error_message = "Ungültiger Dateityp. Nur Bilder sind erlaubt.";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="form.css" rel="stylesheet">
</head>
<body>
<?php include './header.php'; ?>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                    <h1 class="text-center mb-4">Admin</h1> 
                    <div class="card custom-card-style p-4 shadow ">
                        <h1 class="text-center mb-4">News erstellen</h1>
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