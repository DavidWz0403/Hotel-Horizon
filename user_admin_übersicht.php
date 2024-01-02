<?php
session_start();
require_once("dbacess.php");
$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);




if ($_SESSION["role"] !== 1) {
    header('Location: index.php');
    exit();
}

$usersStmt = $connection->prepare("SELECT id, username, status FROM user ORDER BY username");
$usersStmt->execute();
$usersResult = $usersStmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Übersicht</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include './header.php'; ?>
<div class="container mt-5">
    <h2>User Verwaltung</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Benutzername</th>
                <th>Status</th>
                <th>Aktionen</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = $usersResult->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['status']; ?></td>
                    <td>
                        <a href="user_admin_edit.php?id=<?php echo $user['id']; ?>" class="btn btn-primary btn-sm">Bearbeiten</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>