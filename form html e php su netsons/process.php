<?php
//! database online
$host = 'hostingssd121.netsons.net';
$db   = 'apghciha_database';
$user = 'apghciha_dario';
$pass = 'Ominoverde@87';
$charset = 'utf8mb4';

// $host = '127.0.0.1';
// $db   = 'riprova';
// $user = 'root';
// $pass = 'root';
// $charset = 'utf8mb4';

// $host = 'sql210.infinityfree.com';
// $db   = 'if0_37033057_prova';
// $user = 'if0_37033057';
// $pass = 'YkGQMdDKZg';
// $charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Controlla se il form è stato inviato
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash della password

    // Inserisci i dati nel database
    $sql = "INSERT INTO utenti (name, email, password) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([$name, $email, $password]);
        echo "Registrazione avvenuta con successo!";
    } catch (Exception $e) {
        echo "Errore nell'inserimento: " . $e->getMessage();
    }
}
?>
