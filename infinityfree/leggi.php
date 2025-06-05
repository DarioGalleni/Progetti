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
  <link rel="stylesheet" href="/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <title>Lista Dati</title>
  </head>
<body class="bg-light">
  <div class="container py-5">
    <h2 class="text-center mb-4 text-white">Dati Registrati</h2>
    <table class="table table-striped table-bordered">
      <thead class="table-dark">
        <tr class="text-center">
          <th>Colore</th>
          <th>Unità</th>
          <th>Azioni</th>
        </tr>
      </thead>
      <tbody >
        <?php foreach ($dati as $element): ?>
        <tr>
          <td class="text-center"><?= htmlspecialchars($element['color']) ?></td>
          <td class="text-center"><?= htmlspecialchars($element['units']) ?></td>
          <td class="text-center">
            <a href="modifica.php?id=<?= $element['id'] ?>" class="btn btn-sm btn-primary">Modifica</a>
          </td>
          <td class="text-center">
            <a href="elimina.php?id=<?= $element['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questo dato?');">Elimina</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div id="noDataMessage" class="alert alert-warning text-center d-none">
  <h3>
    Nessun dato
  </h3>
    </div>
  <div class="text-center mt-4">
      <a href="index.html" class="btn btn-success">Aggiungi nuovo dato</a>
    </div>
  </div>
  <script src="/script.js"></script>
</body>
</html>
