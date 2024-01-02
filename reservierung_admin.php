<?php
// Beginn der Session und Einbindung der Datenbankverbindung
session_start();
require_once("dbacess.php");
$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Überprüfen der Administratorrechte
if (!isset($_SESSION['role']) || $_SESSION["role"] != 1) {
    header('Location: login.php');
    exit();
}

// Abfrage aller Reservierungen aus der Datenbank
$query = "SELECT ReservationID, UserID, HotelName, Status, TotalPrice, CreatedDate FROM reservation";
$result = $connection->query($query);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservierungen Übersicht</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include './header.php'; ?>
    <div class="container my-5">
        <h2>Reservierungen Übersicht</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ReservierungsID</th>
                    <th>UserID</th>
                    <th>Hotelname</th>
                    <th>Preis</th>
                    <th>Status</th>
                    <th>Erstellungsdatum </th>
                    <th>Details </th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['ReservationID']); ?></td>
                        <td><?php echo htmlspecialchars($row['UserID']); ?></td>
                        <td><?php echo htmlspecialchars($row['HotelName']); ?></td>
                        <td><?php echo htmlspecialchars($row['TotalPrice']); ?></td>
                        <td><?php echo htmlspecialchars($row['Status']); ?></td>
                        <td><?php echo htmlspecialchars($row['CreatedDate']); ?></td>
                        <td> 
                            <a href="reservierung_admin_edit.php?id=<?php echo $row['ReservationID']; ?>" class="btn btn-primary btn-sm">
                                Details
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>