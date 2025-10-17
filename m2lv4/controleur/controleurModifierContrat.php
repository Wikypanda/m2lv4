<?php
if (!isset($_SESSION['identification']) || $_SESSION['utilisateur']['idTypeU'] != 1) {
    $_SESSION['erreurAcces'] = "Accès réservé aux administrateurs.";
    $_SESSION['m2lMP'] = 'accueil';
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/../modele/dao/ContratDAO.php';

$idContrat = $_GET['id'] ?? $_POST['idContrat'] ?? null;

if (!$idContrat) {
    $_SESSION['message'] = "Contrat introuvable.";
    $_SESSION['messageType'] = "error";
    $_SESSION['m2lMP'] = 'contrats';
    header('Location: index.php');
    exit;
}

$contrat = ContratDAO::getContratById($idContrat);

if (!$contrat) {
    $_SESSION['message'] = "Contrat non trouvé.";
    $_SESSION['messageType'] = "error";
    $_SESSION['m2lMP'] = 'contrats';
    header('Location: index.php');
    exit;
}

$utilisateurs = ContratDAO::getUtilisateursDisponibles();
$message = $_SESSION['message'] ?? '';
$messageType = $_SESSION['messageType'] ?? 'info';

unset($_SESSION['message']);
unset($_SESSION['messageType']);

require_once 'vue/vueModifierContrat.php';
?>