<?php
$pdo = new PDO("mysql:host=127.0.0.1;dbname=dariog", 'root', 'root');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT id, color, units FROM dati";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$dati = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Lista Dati</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <h2 class="text-center mb-4">Dati Registrati</h2>
    <table class="table table-striped table-bordered">
      <thead class="table-dark">
        <tr>
          <th>Colore</th>
          <th>Unità</th>
          <th>Azioni</th>
        </tr>
      </thead>
      <tbody class="">
        <?php foreach ($dati as $riga): ?>
        <tr>
          <td class="text-center"><?= htmlspecialchars($riga['color']) ?></td>
          <td class="text-center"><?= htmlspecialchars($riga['units']) ?></td>
          <td class="text-center">
            <a href="modifica.php?id=<?= $riga['id'] ?>" class="btn btn-sm btn-primary">Modifica</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div class="text-center mt-4">
      <a href="index.html" class="btn btn-success">Aggiungi nuovo dato</a>
    </div>
  </div>
</body>
</html>
