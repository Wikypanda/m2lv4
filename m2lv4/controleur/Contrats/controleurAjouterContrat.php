<?php
if (!isset($_SESSION['identification']) || $_SESSION['utilisateur']['idTypeU'] != 1) {
    $_SESSION['erreurAcces'] = "Accès réservé aux administrateurs.";
    $_SESSION['m2lMP'] = 'accueil';
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/../modele/dao/ContratDAO.php';

$utilisateurs = ContratDAO::getUtilisateursDisponibles();
$message = $_SESSION['message'] ?? '';
$messageType = $_SESSION['messageType'] ?? 'info';

unset($_SESSION['message']);
unset($_SESSION['messageType']);

require_once 'vue/vueAjouterContrat.php';
?>