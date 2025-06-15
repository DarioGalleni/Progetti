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
  die("Errore di connessione al database: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $color = $_POST['color'];
    $units = $_POST['units'];

    $sql = "UPDATE dati SET color = :color, units = :units WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':color', $color);
    $stmt->bindParam(':units', $units);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header("Location: leggi.php"); // Modificato da utenti.php a leggi.php
        exit;
    } else {
        echo "Errore durante l'aggiornamento.";
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM dati WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $dato = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$dato) {
        die("Dato non trovato.");
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <title>Modifica Dato</title>
</head>
<body class="bg-light">
  <div class="container py-5">
    <h2 class="text-center mb-4">Modifica Dato</h2>
    <form method="post" class="mx-auto" style="max-width: 500px;">
      <input type="hidden" name="id" value="<?= $dato['id'] ?>">

      <div class="mb-3">
        <label for="color" class="form-label">Colore</label>
        <input type="text" class="form-control" name="color" value="<?= htmlspecialchars($dato['color']) ?>" required>
      </div>

      <div class="mb-3">
        <label for="units" class="form-label">Unità</label>
        <input type="text" class="form-control" name="units" value="<?= htmlspecialchars($dato['units']) ?>" required>
      </div>

      <div class="d-flex justify-content-between">
        <a href="leggi.php" class="btn btn-secondary">Annulla</a> <button type="submit" class="btn btn-primary">Salva modifiche</button>
      </div>
    </form>
  </div>
</body>
</html>