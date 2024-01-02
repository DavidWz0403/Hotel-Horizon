<?php
session_start();
require_once("dbacess.php");
$connection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Annahme: Der Benutzer ist eingeloggt und seine UserID ist in der Session gespeichert.
$userId = $_SESSION['UserID'] ?? null;

// Überprüfen, ob die Hotel-ID vorhanden ist
if (isset($_GET['id'])) {
    $hotelId = $_GET['id'];
    // Abfragen der Hotelinformationen
    $hotelStmt = $connection->prepare("SELECT * FROM hotel WHERE id = ?");
    $hotelStmt->bind_param("i", $hotelId);
    $hotelStmt->execute();
    $hotelResult = $hotelStmt->get_result();
    $hotel = $hotelResult->fetch_assoc();
    $hotelName = $hotel['name'];
    // Abfragen der verfügbaren Zimmer
    $roomsStmt = $connection->prepare("SELECT id, name FROM room WHERE hotel_id = ?");
    $roomsStmt->bind_param("i", $hotelId);
    $roomsStmt->execute();
    $roomsResult = $roomsStmt->get_result();

    $roomPricesStmt = $connection->prepare("SELECT basePrice, breakfastPrice, parkingPrice, petPrice FROM room WHERE hotel_id = ?");
    $roomPricesStmt->bind_param("i", $hotelId);
    $roomPricesStmt->execute();
    $roomPricesResult = $roomPricesStmt->get_result();
    $roomPrices = $roomPricesResult->fetch_assoc();
} else {
    header('Location: hotel_uebersicht.php');
    exit();
}

$reservationCreated = false;
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $userId) {
    $roomId = $_POST['roomId'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $breakfastIncluded = isset($_POST['breakfast']) ? 1 : 0;
    $parkingIncluded = isset($_POST['parking']) ? 1 : 0;
    $petsIncluded = isset($_POST['pets']) ? 1 : 0;


    $startDateTime = new DateTime($startDate);
    $endDateTime = new DateTime($endDate);


    if ($startDateTime >= $endDateTime) {
        $error_message = "Das Abreisedatum muss nach dem Anreisedatum liegen.";
    } else {
        $availabilityStmt = $connection->prepare("
            SELECT COUNT(*) FROM reservation
            WHERE roomId = ? AND NOT (endDate <= ? OR startDate >= ?)");
        $availabilityStmt->bind_param("iss", $roomId, $startDate, $endDate);
        $availabilityStmt->execute();
        $availabilityResult = $availabilityStmt->get_result();
        $reservationsCount = $availabilityResult->fetch_array()[0];

        if ($reservationsCount > 0) {
           
            $error_message = "Das Zimmer ist im gewählten Zeitraum nicht verfügbar.";
        } else {
            $createdDate = date('Y-m-d'); 
            $status = 'new'; 
            $totalPrice = 0;
            $days = (strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24);
            $totalPrice += $days * $roomPrices['basePrice'];
            $totalPrice += $breakfastIncluded ? ($days * $roomPrices['breakfastPrice']) : 0;
            $totalPrice += $parkingIncluded ? ($days * $roomPrices['parkingPrice']) : 0;
            $totalPrice += $petsIncluded ? ($days * $roomPrices['petPrice']) : 0;

            
            // Füge die Reservierung mit dem Gesamtpreis in die Datenbank ein
            $insertStmt = $connection->prepare("
                INSERT INTO reservation 
                (UserID, RoomID, HotelID, HotelName, StartDate, EndDate, BreakfastIncluded, ParkingIncluded, PetsIncluded, Status, CreatedDate, TotalPrice) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $insertStmt->bind_param("iiisssiiissd", $userId, $roomId, $hotelId, $hotelName, $startDate, $endDate, $breakfastIncluded, $parkingIncluded, $petsIncluded, $status, $createdDate, $totalPrice);
           

            if ($insertStmt->execute()) {
                
                $reservationCreated = true;
            } else {
                $error_message = "Fehler beim Erstellen der Reservierung: " . $connection->error;
            }
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
    function calculateTotalPrice() {
        var startDate = new Date(document.getElementById('startDate').value);
        var endDate = new Date(document.getElementById('endDate').value);
        var days = (endDate - startDate) / (1000 * 60 * 60 * 24);
        
        var basePrice = parseFloat(document.getElementById('basePrice').innerText);
        var breakfastPrice = document.getElementById('breakfast').checked ? parseFloat(document.getElementById('breakfastPrice').innerText) : 0;
        var parkingPrice = document.getElementById('parking').checked ? parseFloat(document.getElementById('parkingPrice').innerText) : 0;
        var petPrice = document.getElementById('pets').checked ? parseFloat(document.getElementById('petPrice').innerText) : 0;
        
        var totalPrice = (days * (basePrice + breakfastPrice + parkingPrice + petPrice)).toFixed(2);
        
        document.getElementById('totalPrice').innerText = totalPrice;
    }
    </script>
</head>
<body>
<?php
       include 'header.php';
       echo $hotelName;
       ?>
    <div class="container my-5">
        <h1><?php echo htmlspecialchars($hotel['name']); ?></h1>
        <div id="priceList">
            <p>Basepreis pro Nacht: <span id="basePrice"><?php echo $roomPrices['basePrice']; ?></span></p>
            <p>Frühstückspreis pro Nacht: <span id="breakfastPrice"><?php echo $roomPrices['breakfastPrice']; ?></span></p>
            <p>Parkpreis pro Nacht: <span id="parkingPrice"><?php echo $roomPrices['parkingPrice']; ?></span></p>
            <p>Haustierpreis pro Nacht: <span id="petPrice"><?php echo $roomPrices['petPrice']; ?></span></p>
        </div>
        <form action="hotel_detail.php?id=<?php echo $hotelId; ?>" method="post">
            <label for="roomSelect">Zimmer auswählen:</label>
            <select id="roomSelect" name="roomId">
                <?php while ($room = $roomsResult->fetch_assoc()): ?>
                    <option value="<?php echo $room['id']; ?>"><?php echo htmlspecialchars($room['name']); ?></option>
                <?php endwhile; ?>
            </select>
            
            <label for="startDate">Anreisedatum:</label>
            <input type="date" id="startDate" name="startDate" required onchange="calculateTotalPrice()">
            
            <label for="endDate">Abreisedatum:</label>
            <input type="date" id="endDate" name="endDate" required onchange="calculateTotalPrice()">
            
            <input type="checkbox" id="breakfast" name="breakfast" onchange="calculateTotalPrice()">
            <label for="breakfast">Mit Frühstück</label>
            
            <input type="checkbox" id="parking" name="parking" onchange="calculateTotalPrice()">
            <label for="parking">Mit Parkplatz</label>
            
            <input type="checkbox" id="pets" name="pets" onchange="calculateTotalPrice()">
            <label for="pets">Mit Haustieren</label>
            
            <input type="submit" value="Reservieren">

            <p>Gesamtpreis: <span id="totalPrice">0</span></p>
        </form>
        
        <?php if ($reservationCreated): ?>
            <p>Reservierung erfolgreich erstellt!</p>
        <?php else: ?>
            <p><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>