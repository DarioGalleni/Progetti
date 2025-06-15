<?php
//! database online
$host = 'hostingssd121.netsons.net';
$db   = 'apghciha_database';
$user = 'apghciha_dario';
$pass = 'Ominoverde@87';
$charset = 'utf8mb4';

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

    // Inserisci i dati nel database
    $sql = "INSERT INTO utenti (name, email) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([$name, $email]);
        $message = "Ok grazie. Controlla la tua email. A breve troverai il link per effettuare il versamento.";
    } catch (Exception $e) {
        $message = "Errore nell'inserimento: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processo completato</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="theme-color" content="#81f8b4">
    <link rel="icon" type="image/png" sizes="32x32" href="/ferrarin/favicom/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/ferrarin/favicom/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#81f8b4">

</head>
<body>
    <div class="container text-center mt-5">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading comic">Esito:</h4>
            <p class="comic"><?php echo isset($message) ? $message : "Nessun dato inviato"; ?></p>
        </div>
        <a href="index.html" class="btn btn-primary mt-3 comic">Torna alla Home</a>
    </div>

    <footer class="container mt-5">
      <div class="row">
        <div class="col-12 text-center">
          <h6>Powered by <a href="https://www.dariux87.com" target="_blank">Dariux</a></h6>
        </div>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
