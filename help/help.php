<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hilfe</title>
    <!-- Einbindung von Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="./help/help.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center mb-5">Hilfe & FAQs</h1>
        
        <div class="card mb-3">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne">
                        Wie buche ich ein Zimmer?
                    </button>
                </h5>
            </div>
            <div id="collapseOne" class="collapse" data-parent=".container">
                <div class="card-body">
                    Um ein Zimmer zu buchen, wählen Sie ...
                </div>
            </div>
        </div>
        
        <div class="card mb-3">
            <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo">
                        Wie kann ich meine Reservierung einsehen?
                    </button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" data-parent=".container">
                <div class="card-body">
                    Um Ihre Reservierung einzusehen, ...
                </div>
            </div>
        </div>
        
    </div>

</body>

</html>
