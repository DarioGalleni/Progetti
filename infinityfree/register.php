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

$message = ""; // Inizializza la variabile

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];

  $sql = "INSERT INTO utenti (name, email) VALUES (:name, :email)";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':email', $email);

  if ($stmt->execute()) {
    $message = "OK";
  } else {
    $message = "Errore durante la registrazione.";
  }
}

$pdo = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
 <p style="text-align: center;"><a href="utenti.php">Visualizza tutti gli utenti</a></p>

</body>
</html>




