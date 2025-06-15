<?php

session_start(); // Inizia la sessione

// Reindirizza se l'utente non è loggato
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$host = 'hostingssd121.netsons.net';
$db   = 'apghciha_dati';
$user = 'apghciha_dario';
$pass = 'Ominoverde@87';
$charset = 'utf8mb4';

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