<?php
$host = 'sql210.infinityfree.com';
$db   = 'if0_37033057_prova';
$user = 'if0_37033057';
$pass = 'YkGQMdDKZg';

// Crea connessione
$conn = new mysqli($host, $user, $pass, $db);

// Controlla connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Prepara e lega
$stmt = $conn->prepare("INSERT INTO utenti (nome, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $hashed_password);

// Imposta i parametri e esegui
$name = $_POST['name'];
$email = $_POST['email'];
$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

if ($stmt->execute()) {
    $prova = "Si ok";
    echo $prova;
} else {
    echo "Errore: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
