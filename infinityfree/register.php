<?php
// Connessione al DB
$host = '127.0.0.1';
$db_name = 'dariog';
$username = 'root';
$password = 'root';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  die("Errore: " . $e->getMessage());
}

$message = ""; // Inizializza la variabile

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $color = $_POST['color']; // Changed from 'name' to 'color'
  $units = $_POST['units']; // Changed from 'email' to 'units'

  // Updated SQL query to insert into 'dati' table with 'color' and 'units' columns
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <div class="col-12 text-center"> <a href="/utenti.php" class="btn btn-primary">Vai a Pagina</a>
    </div>
  </div>
</div>


</body>
</html>