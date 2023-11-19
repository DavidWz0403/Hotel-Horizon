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
                        </form>
                    </div>
            </div>
        </div>
    </div>
    <?php if (isset($title) && isset($input) && isset($uploadDatei)): ?>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mb-10">Preview</h1>
                <h2 class="text-center"> <?php echo $title; ?></h2>
                <?php
                if (file_exists($uploadDatei)) {
                    echo "<img src='" . htmlspecialchars($uploadDatei) . "' alt='" . htmlspecialchars(basename($uploadDatei)) . "' style='max-width:100%; max-height:100%;'>";
                } else {
                    echo "File not found.";
                }
                ?>
                <p class="text-center ">  <?php echo $input; ?> </p>
            </div>
        </div>
    </div>
    <?php endif; ?>       
</body>
</html>