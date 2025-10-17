<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idLigue = $_POST['idLigue'];
    $nouveauNom = $_POST['nouveauNom'];
    $nouveauSite = $_POST['nouveauSite'];
    $nouveauDescriptif = $_POST['nouveauDescriptif'];

    // Connexion à la base (à adapter selon ton projet)
    include_once 'modele/connexionBDD.php';

    // Préparation de la requête
    $sql = "UPDATE ligues SET nomLigue = ?, site = ?, descriptif = ? WHERE idLigue = ? OR nomLigue = ?";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([$nouveauNom, $nouveauSite, $nouveauDescriptif, $idLigue, $idLigue]);

    // Message de confirmation
    $message = "La ligue a bien été modifiée.";
}

require_once 'vue/vueModifierLigue.php' ;
