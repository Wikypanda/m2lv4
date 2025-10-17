<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomLigue = $_POST['nomLigue'];
    $site = $_POST['site'];
    $descriptif = $_POST['descriptif'];

    // Connexion via ta classe dBConnex
    $bdd = dBConnex::getInstance();

    // Requête d'insertion
    $sql = "INSERT INTO ligue (nomLigue, site, descriptif) VALUES (?, ?, ?)";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$nomLigue, $site, $descriptif]);

    // Message de confirmation
    $message = "✅ La ligue « " . htmlspecialchars($nomLigue) . " » a bien été ajoutée.";
}

require_once 'vue/vueAjouterLigue.php';
