<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impressum - Hotelwebsite</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="index.css" rel="stylesheet">
</head>
<body>
<?php
       include 'header.php';
       ?>
<div class="container mt-5 impressum-container">
    <h1 class="text-center">Impressum</h1>
    <hr>
    <section>
        <h2 class="impressum-h2" >Angaben gemäß § 5 TMG:</h2>
        <p>
            Hotel Horizon<br>
            Höchststaädtplatz 6<br>
            1200 Wien<br>
            Österreich
        </p>
        <h2 class="impressum-h2">Kontakt:</h2>
        <p>
            Telefon: +43 123 4567890<br>
            E-Mail: hotel-horizon@hotel.at
        </p>
        <h2 class="impressum-h2">Vertreten durch:</h2>
        <p>
            Benjamin Weber & David Walzer 
        </p>
    </section>

    <section class="mt-4">
        <h2>Hotelverwaltung:</h2>
        <div class="row">
            <div class="col-md-4 team-member ">
                <img src="./img/Benni.jpeg" alt="Name1" class="img-fluid rounded-circle">
                <p class="team-name">Benjamin Weber</p>
            </div>
            <div class="col-md-4 team-member ">
                <img src="./img/David.jpeg" alt="Name2" class="img-fluid rounded-circle">
                <p class="team-name">David Walzer</p>
            </div>
        </div>
    </section>

</div>

<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
