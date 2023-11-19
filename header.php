<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["role"])){
    $_SESSION["role"] = 0;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="index.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <div>
        <a class="navbar-brand" href="#">
            <img src="../projekt/img/logo.png" alt="Logo" class="logo">
        </a>
    </div>	
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Hotels</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="help.php">Help</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="impressum.php">Impressum</a>
                    </li>
                </ul>
                <div class="d-flex">
                
                <?php if ($_SESSION["role"] === 1): ?>
                    <a href="admin.php" class="btn btn-primary me-2" role="button" aria-pressed="true">Admin</a>
                    <a href="logout.php" class="btn btn-primary " role="button" aria-pressed="true">Logout</a>
                <?php elseif ($_SESSION["role"] === 2): ?>
                    <a href="profil.php" class="btn btn-primary me-2" role="button" aria-pressed="true">Profil</a>
                    <a href="logout.php" class="btn btn-primary " role="button" aria-pressed="true">Logout</a>
                <?php else: ?>
                    <a href="registrierung.php" class="btn btn-primary me-2 " role="button" aria-pressed="true">Registrierung</a>
                    <a href="login.php" class="btn btn-primary" role="button" aria-pressed="true">Login</a>
                <?php endif; ?>
                    
                </div>
    </div>
  </div>
</nav>
    
</body>
</html>