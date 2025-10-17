<?php
if (!isset($_SESSION['identification']) || $_SESSION['utilisateur']['idTypeU'] != 1) {
    $_SESSION['erreurAcces'] = "Accès réservé aux administrateurs.";
    $_SESSION['m2lMP'] = 'accueil';
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/../modele/dao/DBConnex.php';
require_once __DIR__ . '/../modele/dao/IntervenantDAO.php';
require_once __DIR__ . '/../modele/dto/intervenant.php';

$id = $_POST['id_intervenant'] ?? $_GET['id'] ?? null;

if (!$id) {
    $_SESSION['message'] = "Intervenant introuvable.";
    $_SESSION['messageType'] = "error";
    $_SESSION['m2lMP'] = 'intervenants';
    header('Location: index.php');
    exit;
}

$intervenant = IntervenantDAO::getIntervenantById($id);

if (!$intervenant) {
    $_SESSION['message'] = "Intervenant non trouvé.";
    $_SESSION['messageType'] = "error";
    $_SESSION['m2lMP'] = 'intervenants';
    header('Location: index.php');
    exit;
}

// Initialiser les variables pour les messages
$message = $_SESSION['message'] ?? '';
$messageType = $_SESSION['messageType'] ?? 'info';

// Nettoyer les messages de session
unset($_SESSION['message']);
unset($_SESSION['messageType']);

require_once 'vue/vueModifierIntervenant.php';