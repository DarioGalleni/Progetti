<?php
// Configurazione file dati
$file_dati = 'contacts.json';

// Inizializza file se non esiste
if (!file_exists($file_dati)) {
    file_put_contents($file_dati, json_encode([], JSON_PRETTY_PRINT));
}

// Carica contatti
$contacts = json_decode(file_get_contents($file_dati), true);
if (!is_array($contacts)) $contacts = [];

// GESTIONE AGGIUNTA CONTATTO
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    if ($name && $phone) {
        // Aggiungi in cima all'array
        array_unshift($contacts, [
            'name' => $name,
            'phone' => $phone
        ]);
        // Salva
        file_put_contents($file_dati, json_encode($contacts, JSON_PRETTY_PRINT));
    }
    // Redirect per evitare resubmit
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// GESTIONE ELIMINAZIONE CONTATTO
if (isset($_POST['action']) && $_POST['action'] === 'delete') {
    $phoneToDelete = $_POST['phone'] ?? '';
    
    // Filtra array mantenendo solo chi NON ha quel numero
    $contacts = array_filter($contacts, function($c) use ($phoneToDelete) {
        return $c['phone'] !== $phoneToDelete;
    });
    
    // Re-index array e salva
    $contacts = array_values($contacts);
    file_put_contents($file_dati, json_encode($contacts, JSON_PRETTY_PRINT));
    
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rubrica Telefonica (PHP)</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/rubrica.css">
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                
                <div class="glass-container">
                    <h1><i class="fas fa-address-book me-2"></i>Contatti Rapidi</h1>
                    
                    <!-- Search -->
                    <div class="search-container">
                        <input type="text" id="searchInput" class="search-input" placeholder="Cerca contatti...">
                    </div>

                    <!-- Add Contact Form (PHP POST) -->
                    <div class="form-container">
                        <form method="POST" action="">
                            <input type="hidden" name="action" value="add">
                            <h5 class="mb-3"><i class="fas fa-plus-circle me-2"></i>Nuovo Contatto</h5>
                            <input type="text" name="name" class="custom-input" placeholder="Nome e Cognome" required>
                            <input type="tel" name="phone" class="custom-input" placeholder="Numero di Telefono" required>
                            <button type="submit" class="add-btn">Aggiungi in Rubrica</button>
                        </form>
                    </div>

                    <!-- Lista Contatti generata da PHP (Ciclo Foreach) -->
                    <div id="contactList">
                        <?php if (empty($contacts)): ?>
                            <div class="empty-state" style="display:block;">
                                <i class="fas fa-search fa-3x mb-3" style="color: #ccc;"></i>
                                <p>Nessun contatto in rubrica.</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($contacts as $contact): ?>
                                <div class="contact-card contact-item">
                                    <div class="contact-info">
                                        <!-- htmlspecialchars per sicurezza -->
                                        <h5><?= htmlspecialchars($contact['name']) ?></h5>
                                        <p><?= htmlspecialchars($contact['phone']) ?></p>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a href="tel:<?= preg_replace('/\s+/', '', $contact['phone']) ?>" class="call-btn me-2" title="Chiama">
                                            <i class="fas fa-phone-alt"></i>
                                        </a>
                                        
                                        <!-- Form nascosto per eliminazione -->
                                        <form method="POST" action="" onsubmit="return confirm('Vuoi eliminare questo contatto?');" style="margin:0;">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="phone" value="<?= htmlspecialchars($contact['phone']) ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius: 50%; width: 40px; height: 40px;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div id="noResults" class="empty-state">
                        <i class="fas fa-search fa-3x mb-3" style="color: #ccc;"></i>
                        <p>Nessun contatto trovato nella ricerca.</p>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Script solo per il filtro ricerca visiva -->
    <script src="assets/js/rubrica.js"></script>
</body>
</html>
