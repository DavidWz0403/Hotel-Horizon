<?php
require_once("dbacess.php");
$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $connection->prepare("SELECT title, path, content, datum FROM news WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $newsItem = $result->fetch_assoc();
} else {
    header('Location: news.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($newsItem['title']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include './header.php'; ?>
    <div class="container my-5">
        <h1><?php echo htmlspecialchars($newsItem['title']); ?></h1>
        <img src="<?php echo htmlspecialchars($newsItem['path']); ?>" alt="<?php echo htmlspecialchars($newsItem['title']); ?>" class="img-fluid">
        <p><?php echo nl2br(htmlspecialchars($newsItem['content'])); ?></p>
        <p>Datum: <?php echo htmlspecialchars($newsItem['datum']); ?></p>
    </div>
</body>
</html>
