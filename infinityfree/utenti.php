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

// Recupera tutti gli utenti
$sql = "SELECT name, email FROM utenti";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$utenti = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pdo = null;
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Lista Utenti</title>
  <style>
    table {
      margin: auto;
      border-collapse: collapse;
    }
    td, th {
      border: 1px solid black;
      padding: 8px;
    }
  </style>
</head>
<body>
  <h2 style="text-align: center;">Utenti Registrati</h2>
  <table>
    <thead>
      <tr>
        <th>Nome</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($utenti as $utente): ?>
        <tr>
          <td><?= htmlspecialchars($utente['name']) ?></td>
          <td><?= htmlspecialchars($utente['email']) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
