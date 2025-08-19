<?php

session_start(); // Inizia la sessione

// Reindirizza se l'utente non è loggato
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

/*

$host = 'hostingssd121.netsons.net';
$db   = 'apghciha_dati';
$user = 'apghciha_dario';
$pass = 'Ominoverde@87';
$charset = 'utf8mb4';
*/


$host = 'sql107.infinityfree.com';
$db   = 'if0_38876061_dario';
$user = 'if0_38876061';
$pass = 'ominoverde87';
$charset = 'utf8mb4';



// $host = '127.0.0.1';
// $db   = 'dariog';
// $user = 'root';
// $pass = 'root';
// $charset = 'utf8mb4';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  die("Errore: " . $e->getMessage());
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $color = $_POST['color'];
  $units = $_POST['units'];

  
  $sql = "INSERT INTO dati (color, units) VALUES (:color, :units)";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':color', $color);
  $stmt->bindParam(':units', $units);

  if ($stmt->execute()) {
    $message = "OK";
  } else {
    $message = "Errore durante la registrazione.";
  }
}

$pdo = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
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
  <?php if ($message): ?>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12">
            <div class="alert alert-success text-center mt-3">
            <?= htmlspecialchars($message) ?>
            </div>          
          </div>
      </div>
    </div>
  <?php endif; ?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 text-center"> <a href="/leggi.php" class="btn btn-primary">Vai a Pagina</a>
    </div>
  </div>
</div>


</body>
</html>