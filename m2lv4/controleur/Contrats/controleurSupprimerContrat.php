<?php
if (!isset($_SESSION['identification']) || $_SESSION['utilisateur']['idTypeU'] != 1) {
    $_SESSION['erreurAcces'] = "Accès réservé aux administrateurs.";
    $_SESSION['m2lMP'] = 'accueil';
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/../modele/dao/ContratDAO.php';
require_once __DIR__ . '/../lib/fonctionsUtiles.php';

$idContrat = $_POST['idContrat'] ?? null;
$token = $_POST['csrf_token'] ?? null;

if (!$token || !validate_csrf_token($token)) {
    $_SESSION['message'] = "Requête invalide.";
    $_SESSION['messageType'] = "error";
    $_SESSION['m2lMP'] = 'contrats';
    header('Location: index.php');
    exit;
}

if ($idContrat) {
    try {
        if (ContratDAO::supprimerContrat($idContrat)) {
            $_SESSION['message'] = "Contrat supprimé avec succès.";
            $_SESSION['messageType'] = "success";
        } else {
            $_SESSION['message'] = "Erreur lors de la suppression.";
            $_SESSION['messageType'] = "error";
        }
    } catch (Exception $e) {
        $_SESSION['message'] = "Erreur : " . $e->getMessage();
        $_SESSION['messageType'] = "error";
    }
} else {
    $_SESSION['message'] = "Contrat introuvable.";
    $_SESSION['messageType'] = "error";
}

$_SESSION['m2lMP'] = 'contrats';
header('Location: index.php');
exit;
?>