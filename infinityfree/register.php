<?php
// Database connection details (replace with your own)
$host = 'sql210.infinityfree.com';
$db_name = 'if0_37033057_ok';
$username = 'if0_37033057';
$password = 'YkGQMdDKZg';

try {
  // PDO connection
  $pdo = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  die("Errore: " . $e->getMessage());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];

  // Prepare SQL statement with named parameters
  $sql = "INSERT INTO clienti (nome, email) VALUES (:name, :email)";
  $stmt = $pdo->prepare($sql);

  // Bind parameters to prevent SQL injection
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':email', $email);

  // Execute the statement
  if ($stmt->execute()) {
    $message = "Registrazione avvenuta con successo!";
  } else {
    $message = "Errore durante la registrazione: " . $stmt->errorInfo()[0]; // Get specific error message
  }
} else {
  $message = ""; // No message for initial page load
}

// Close the connection (optional, but recommended)
$pdo = null;
?>