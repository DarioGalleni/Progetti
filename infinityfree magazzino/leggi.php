<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}



// $pdo = new PDO("mysql:host=hostingssd121.netsons.net;dbname=apghciha_dati", 'apghciha_dario', 'Ominoverde@87');



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

$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT id, color, units FROM dati ORDER BY color ASC";
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
  <div class="container py-5">
    <h2 class="text-center mb-4 text-white">Dati Registrati</h2>
    <table class="table table-striped table-bordered">
      <thead class="table-dark">
        <tr class="text-center">
          <th>Colore</th>
          <th>Unità</th>
          <th colspan="2">Azioni</th> </tr>
      </thead>
      <tbody >
        <?php foreach ($dati as $element): ?>
        <tr>
          <td class="text-center"><?= htmlspecialchars($element['color']) ?></td>
          <td class="text-center"><?= htmlspecialchars($element['units']) ?></td>
          <td class="text-center">
            <a href="modifica.php?id=<?= $element['id'] ?>" class="btn btn-sm btn-primary">Modifica</a>
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
      <a href="index.php" class="btn btn-success">Aggiungi nuovo dato</a> <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
  </div>
  <script src="/script.js"></script>
</body>
</html>