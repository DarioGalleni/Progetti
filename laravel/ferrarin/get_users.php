<?php
// Parametri di connessione al database

$host = 'hostingssd121.netsons.net';
$db   = 'apghciha_database';
$user = 'apghciha_dario';
$pass = 'Ominoverde@87';
$charset = 'utf8mb4';

try {
    // Creare una connessione PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    // Impostare il PDO in modo che lanci eccezioni in caso di errore
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query per ottenere i dati
    $sql = "SELECT name, email FROM utenti";
    // Prepara ed esegui la query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Verifica se ci sono risultati
    if ($stmt->rowCount() > 0) {
        // Genera la tabella HTML
        echo "<table border='1'>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                </tr>";
        
        // Output dei dati
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>" . htmlspecialchars($row["name"]) . "</td>
                    <td>" . htmlspecialchars($row["email"]) . "</td>
                </tr>";
        }
        
        echo "</table>";
    } else {
        echo "0 risultati";
    }
} catch (PDOException $e) {
    // Gestione dell'errore
    echo "Errore di connessione: " . $e->getMessage();
}
?>

