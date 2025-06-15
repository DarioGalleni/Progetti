<?php

session_start(); // Inizia la sessione

// Reindirizza se l'utente non è loggato
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: leggi.php");
    exit;
}

$pdo = new PDO("mysql:host=hostingssd121.netsons.net;dbname=apghciha_dati", 'apghciha_dario', 'Ominoverde@87');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = (int) $_GET['id'];

$sql = "DELETE FROM dati WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

header("Location: leggi.php");
exit;
?>

<!-- $host = 'hostingssd121.netsons.net';
$db   = 'apghciha_database';
$user = 'apghciha_dati';
$pass = 'Ominoverde@87';
$charset = 'utf8mb4'; -->
