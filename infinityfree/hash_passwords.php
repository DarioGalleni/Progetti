<?php

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

// Seleziona tutti gli utenti
$sql = "SELECT user_id AS id, password FROM users"; // Usa un alias se necessario
// Oppure se user_id è il tuo ID principale e la colonna 'id' non è necessaria altrove per l'aggiornamento
// $sql = "SELECT user_id, password FROM users";
// E poi nel foreach: $user['user_id']
$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user) {
    $hashed_password = password_hash($user['password'], PASSWORD_DEFAULT);
    $update_sql = "UPDATE users SET password = :hashed_password WHERE id = :id";
    $update_stmt = $pdo->prepare($update_sql);
    $update_stmt->bindParam(':hashed_password', $hashed_password);
    $update_stmt->bindParam(':id', $user['id']);
    $update_stmt->execute();
    echo "Password per l'utente ID " . $user['id'] . " hashata e aggiornata.<br>";
}

echo "Tutte le password sono state hashate.";

$pdo = null;

?>