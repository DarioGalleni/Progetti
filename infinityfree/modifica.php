<?php
$pdo = new PDO("mysql:host=127.0.0.1;dbname=dariog", 'root', 'root');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
        header("Location: utenti.php");
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
  <title>Modifica Dato</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <a href="utenti.php" class="btn btn-secondary">Annulla</a>
        <button type="submit" class="btn btn-primary">Salva modifiche</button>
      </div>
    </form>
  </div>
</body>
</html>
