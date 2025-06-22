<?php
session_start(); // Inizia la sessione

// Reindirizza se l'utente non è loggato
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inserisci Dati</title>
  <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Benvenuto</a>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <span class="navbar-text">
              Utente: <?= htmlspecialchars($_SESSION['username']) ?>
            </span>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container my-5">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="text-white">Inserisci un nuovo dato</h1>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form action="crea.php" method="post">
          <div class="mb-3 text-center">
            <label for="color" class="form-label text-white">Colore</label>
            <input type="text" class="form-control" id="color" name="color" required>
          </div>
          <div class="mb-3 text-center">
            <label for="units" class="form-label text-white">Unità</label>
            <input type="number" class="form-control" id="units" name="units" required>
          </div>
          <div class="col-12 text-center mt-5">
            <button type="submit" class="btn btn-primary w-50">Crea</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>