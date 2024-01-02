<?php 
function validatedata($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

session_start();
require_once("dbacess.php");
$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Überprüfen, ob die Person Administratorrechte hat
if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    header('Location: login.php');
    exit();
}

$reservationId = $_GET['id'] ?? null;
$reservation = null;
$error_message = '';
$success_message = '';

// Laden Sie die Reservierungsdaten, wenn die Seite zum ersten Mal geladen wird
if ($reservationId) {
    $stmt = $connection->prepare("SELECT * FROM reservation WHERE ReservationID = ?");
    $stmt->bind_param("i", $reservationId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $reservation = $result->fetch_assoc();
    } else {
        $error_message = "Reservierung nicht gefunden.";
    }
    $stmt->close();
}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['status'])){
    $status = validatedata($_POST['status']);

    $updateQuery = "UPDATE reservation SET Status=? WHERE ReservationID=?";
    $stmt = $connection->prepare($updateQuery);
    $stmt->bind_param("si", $status, $reservationId);

    if ($stmt->execute()) {
        $success_message = "Status wurde erfolgreich aktualisiert.";
        header('Location: reservierung_admin.php');
    } else {
        $error_message = "Fehler bei der Aktualisierung des Status: " . $connection->error;
    }
    $stmt->close();
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

<?php include './header.php'; ?>

<?php if(isset($reservation)): ?>
    <div class="container my-5">
        <h2>Reservierungsdetails für ID: <?php echo htmlspecialchars($reservation['ReservationID']); ?></h2>
        <form action="reservierung_admin_edit.php?id=<?php echo htmlspecialchars($reservation['ReservationID']); ?>" method="post">
            <div class="mb-3">
                <label class="form-label">UserID</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($reservation['UserID']); ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Hotelname</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($reservation['HotelName']); ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Startdatum</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($reservation['StartDate']); ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Enddatum</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($reservation['EndDate']); ?>" disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Frühstück inbegriffen</label>
                <input type="checkbox" <?php echo ($reservation['BreakfastIncluded']) ? 'checked' : ''; ?> disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Parkplatz inbegriffen</label>
                <input type="checkbox" <?php echo ($reservation['ParkingIncluded']) ? 'checked' : ''; ?> disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Haustiere inbegriffen</label>
                <input type="checkbox" <?php echo ($reservation['PetsIncluded']) ? 'checked' : ''; ?> disabled>
            </div>
            <div class="mb-3">
                <label class="form-label">Gesamtpreis</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($reservation['TotalPrice']); ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-control">
                    <option value="new" <?php echo ($reservation['Status'] == 'new') ? 'selected' : ''; ?>>Neu</option>
                    <option value="confirmed" <?php echo ($reservation['Status'] == 'confirmed') ? 'selected' : ''; ?>>Bestätigt</option>
                    <option value="cancelled" <?php echo ($reservation['Status'] == 'cancelled') ? 'selected' : ''; ?>>Storniert</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Status aktualisieren</button>
        </form>
    </div>
<?php else: ?>
    <div class="container my-5">
        <div class="alert alert-danger" role="alert">
            Die angeforderte Reservierung konnte nicht gefunden werden.
        </div>
    </div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>