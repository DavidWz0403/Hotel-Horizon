<?php
session_start();
require_once("dbacess.php");
$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);


$userId = $_SESSION['UserID'] ?? null;


$reservationsStmt = $connection->prepare("
    SELECT r.ReservationID, h.name AS HotelName, r.StartDate, r.EndDate, r.Status
    FROM reservation r
    INNER JOIN hotel h ON r.HotelID = h.id
    WHERE r.UserID = ?
    ORDER BY r.CreatedDate DESC
");
$reservationsStmt->bind_param("i", $userId);
$reservationsStmt->execute();
$reservationsResult = $reservationsStmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservierungsübersicht</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include './header.php'; ?>
<div class="container mt-5">
    <h2>Ihre Reservierungen</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Hotel</th>
                <th>Anreisedatum</th>
                <th>Abreisedatum</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($reservation = $reservationsResult->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $reservation['ReservationID']; ?></td>
                    <td><?php echo $reservation['HotelName']; ?></td>
                    <td><?php echo $reservation['StartDate']; ?></td>
                    <td><?php echo $reservation['EndDate']; ?></td>
                    <td><?php echo $reservation['Status']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>