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
    $_SESSION['message'] = "Requête invalide (token CSRF manquant ou invalide).";
    $_SESSION['messageType'] = "error";
    $_SESSION['m2lMP'] = 'ajouterContrat';
    header('Location: index.php');
    exit;
}

// Récupération des données
$idContrat = trim($_POST['idContrat'] ?? '');
$dateDebut = trim($_POST['dateDebut'] ?? '');
$dateFin = trim($_POST['dateFin'] ?? '');
$typeContrat = trim($_POST['typeContrat'] ?? '');
$nbHeures = trim($_POST['nbHeures'] ?? '');
$idUser = trim($_POST['idUser'] ?? '');
$salaireBrut = trim($_POST['salaireBrut'] ?? '');

// Validation
$errors = [];
if (empty($idContrat)) {
    $errors[] = 'L\'identifiant du contrat est obligatoire.';
} elseif (ContratDAO::contratExiste($idContrat)) {
    $errors[] = 'Cet identifiant de contrat existe déjà.';
}

if (empty($dateDebut)) $errors[] = 'La date de début est obligatoire.';
if (empty($typeContrat)) $errors[] = 'Le type de contrat est obligatoire.';
if (empty($idUser)) $errors[] = 'L\'utilisateur est obligatoire.';

if ($dateFin && $dateDebut && $dateFin < $dateDebut) {
    $errors[] = 'La date de fin doit être postérieure à la date de début.';
}

if (!empty($errors)) {
    $_SESSION['message'] = implode('<br>', $errors);
    $_SESSION['messageType'] = 'error';
    $_SESSION['formData'] = $_POST;
    $_SESSION['m2lMP'] = 'ajouterContrat';
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

    if (ContratDAO::creerContrat($contrat)) {
        $_SESSION['message'] = "Contrat créé avec succès.";
        $_SESSION['messageType'] = "success";
    } else {
        $_SESSION['message'] = "Erreur lors de la création du contrat.";
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