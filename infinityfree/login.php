<?php
session_start();


/*
$host = 'hostingssd121.netsons.net';
$db   = 'apghciha_dati';
$user = 'apghciha_dario';
$pass = 'Ominoverde@87';
$charset = 'utf8mb4';
*/

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


$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT id, username, password FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // if ($user && password_verify($password, $user['password']))
        if ($user && $password === $user['password'])

      {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit;
        } else {
            $message = "Nome utente o password non validi.";
        }
    } catch(PDOException $e) {
        $message = "Errore di connessione o query al database: " . $e->getMessage();
    }
    $pdo = null;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
  <div class="container my-5">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="text-white">Login</h1>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form method="post" action="login.php">
          <div class="mb-3 text-center">
            <label for="username" class="form-label text-white">Nome Utente</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <div class="mb-3 text-center">
            <label for="password" class="form-label text-white">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="col-12 text-center mt-5">
            <button type="submit" class="btn btn-primary w-50">Accedi</button>
          </div>
          <?php if ($message): ?>
            <div class="alert alert-danger text-center mt-3" role="alert">
              <?= htmlspecialchars($message) ?>
            </div>
          <?php endif; ?>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>