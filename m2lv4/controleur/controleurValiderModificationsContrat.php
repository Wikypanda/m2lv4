<?php
if (!isset($_SESSION['identification']) || $_SESSION['utilisateur']['idTypeU'] != 1) {
    $_SESSION['erreurAcces'] = "Accès réservé aux administrateurs.";
    $_SESSION['m2lMP'] = 'accueil';
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/../modele/dao/ContratDAO.php';
require_once __DIR__ . '/../modele/dto/contrat.php';
require_once __DIR__ . '/../lib/fonctionsUtiles.php';

// Vérification CSRF
$token = $_POST['csrf_token'] ?? null;
if (!$token || !validate_csrf_token($token)) {
    $_SESSION['message'] = "Requête invalide.";
    $_SESSION['messageType'] = "error";
    $_SESSION['m2lMP'] = 'contrats';
    header('Location: index.php');
    exit;
}

$idContrat = trim($_POST['idContrat'] ?? '');
$dateDebut = trim($_POST['dateDebut'] ?? '');
$dateFin = trim($_POST['dateFin'] ?? '');
$typeContrat = trim($_POST['typeContrat'] ?? '');
$nbHeures = trim($_POST['nbHeures'] ?? '');
$idUser = trim($_POST['idUser'] ?? '');
$salaireBrut = trim($_POST['salaireBrut'] ?? '');

// Validation
if (empty($idContrat) || empty($dateDebut) || empty($typeContrat) || empty($idUser)) {
    $_SESSION['message'] = "Tous les champs obligatoires doivent être remplis.";
    $_SESSION['messageType'] = "error";
    $_SESSION['m2lMP'] = 'modifierContrat';
    $_POST['id'] = $idContrat;
    header('Location: index.php');
    exit;
}

try {
    $contrat = new Contrat(
        $idContrat,
        $dateDebut,
        $dateFin ?: null,
        $typeContrat,
        $nbHeures ?: null,
        $idUser,
        $salaireBrut ?: null,
        true
    );

    if (ContratDAO::modifierContrat($contrat)) {
        $_SESSION['message'] = "Contrat modifié avec succès.";
        $_SESSION['messageType'] = "success";
    } else {
        $_SESSION['message'] = "Erreur lors de la modification.";
        $_SESSION['messageType'] = "error";
    }
} catch (Exception $e) {
    $_SESSION['message'] = "Erreur : " . $e->getMessage();
    $_SESSION['messageType'] = "error";
}

$_SESSION['m2lMP'] = 'contrats';
header('Location: index.php');
exit;
?>