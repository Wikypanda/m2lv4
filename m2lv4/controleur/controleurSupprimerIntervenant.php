<?php
if (!isset($_SESSION['identification']) || $_SESSION['utilisateur']['idTypeU'] != 1) {
    $_SESSION['erreurAcces'] = "Accès réservé aux administrateurs.";
    $_SESSION['m2lMP'] = 'accueil';
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/../modele/dao/DBConnex.php';
require_once __DIR__ . '/../modele/dao/IntervenantDAO.php';
require_once __DIR__ . '/../lib/fonctionsUtiles.php';

// Vérification CSRF
$id = $_POST['id_intervenant'] ?? null;
$token = $_POST['csrf_token'] ?? null;

if (!$token || !validate_csrf_token($token)) {
    $_SESSION['message'] = "Requête invalide (token CSRF manquant ou invalide).";
    $_SESSION['messageType'] = "error";
    $_SESSION['m2lMP'] = 'intervenants';
    header('Location: index.php');
    exit;
}

if ($id) {
    try {
        IntervenantDAO::supprimerIntervenant($id);
        $_SESSION['message'] = "Intervenant supprimé avec succès.";
        $_SESSION['messageType'] = "success";
    } catch (Exception $e) {
        $_SESSION['message'] = "Erreur lors de la suppression : " . $e->getMessage();
        $_SESSION['messageType'] = "error";
    }
} else {
    $_SESSION['message'] = "Erreur : intervenant introuvable.";
    $_SESSION['messageType'] = "error";
}

$_SESSION['m2lMP'] = 'intervenants';
header('Location: index.php');
exit;