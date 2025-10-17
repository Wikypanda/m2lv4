<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = trim($_POST['idLigue']);
    $bdd = dBConnex::getInstance();

    // Vérifie si c'est un ID numérique
    if (is_numeric($input)) {
        $sql = "DELETE FROM ligue WHERE idLigue = ?";
    } else {
        $sql = "DELETE FROM ligue WHERE nomLigue = ?";
    }

    $stmt = $bdd->prepare($sql);
    $stmt->execute([$input]);

    $message = "🗑️ La ligue « " . htmlspecialchars($input) . " » a bien été supprimée.";
}

require_once 'vue/vueSupprimerLigue.php';
