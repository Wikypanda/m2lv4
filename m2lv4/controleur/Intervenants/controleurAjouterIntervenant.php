<?php
if (!isset($_SESSION['identification']) || $_SESSION['utilisateur']['idTypeU'] != 1) {
    $_SESSION['erreurAcces'] = "Accès réservé aux administrateurs.";
    $_SESSION['m2lMP'] = 'accueil';
    header('Location: index.php');
    exit;
}

// Initialiser les variables pour les messages
$message = $_SESSION['message'] ?? '';
$messageType = $_SESSION['messageType'] ?? 'info';
$estDRH = true;

// Nettoyer les messages de session
unset($_SESSION['message']);
unset($_SESSION['messageType']);

require_once 'vue/vueAjouterIntervenant.php';