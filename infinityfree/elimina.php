<?php
if (!isset($_GET['id'])) {
    header("Location: leggi.php");
    exit;
}

$pdo = new PDO("mysql:host=127.0.0.1;dbname=dariog", 'root', 'root');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = (int) $_GET['id'];

$sql = "DELETE FROM dati WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

header("Location: leggi.php");
exit;
?>
