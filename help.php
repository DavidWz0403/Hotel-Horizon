<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hilfe</title>
    <!-- Einbindung von Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="index.css" rel="stylesheet">
</head>

<body>
<?php
       include 'header.php';
       ?>
<div class="container my-5">
    <h1 class="text-center mb-5">Hilfe & FAQs</h1>
    
    <div class="accordion" id="helpAccordion">
        <div class="card mb-3">
            <div class="card-header card-help" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link btn-help collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Wie buche ich ein Zimmer?
                    </button>
                </h5>
            </div>

            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#helpAccordion">
                <div class="card-body">
                    Um ein Zimmer zu buchen, wählen Sie ...
                </div>
            </div>
        </div>
        
        <div class="card mb-3">
            <div class="card-header card-help" id="headingTwo">
                <h5 class="mb-0">
                    <button class="btn btn-link btn-help collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Wie kann ich meine Reservierung einsehen?
                    </button>
                </h5>
            </div>

            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#helpAccordion">
                <div class="card-body">
                    Um Ihre Reservierung einzusehen, ...
                </div>
            </div>
        </div>
    </div>
 
    
</div>


</body>

</html>
