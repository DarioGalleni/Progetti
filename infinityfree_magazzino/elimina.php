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


// Vecchie credenziali di accesso al database commentate
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

$id = (int) $_GET['id'];

$sql = "DELETE FROM dati WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

header("Location: leggi.php");
exit;
?>