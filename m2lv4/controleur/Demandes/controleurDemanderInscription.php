<?php
require_once __DIR__ . '/../modele/dao/DBConnex.php';
require_once __DIR__ . '/../modele/dao/DemandeDAO.php';

// Vérifie que la session contient bien l'utilisateur
if (empty($_SESSION['utilisateur']) || empty($_SESSION['utilisateur']['idUser'])) {
    $_SESSION['message'] = "❌ Vous devez être connecté pour vous inscrire.";
    $_SESSION['m2lMP'] = 'formations';
    header('Location: index.php');
    exit;
}

// Récupère les données
$idUser = $_SESSION['utilisateur']['idUser'];
$idFormation = $_POST['idFormation'] ?? null;

if (empty($idFormation)) {
    $_SESSION['message'] = "❌ Formation introuvable.";
    $_SESSION['m2lMP'] = 'formations';
    header('Location: index.php');
    exit;
}

if (DemandeDAO::existeDemande($idUser, $idFormation)) {
    $_SESSION['message'] = "❌ Vous avez déjà fait une demande pour cette formation.";
} else {
    try {
        DemandeDAO::creerDemande($idUser, $idFormation);
        $_SESSION['message'] = "✅ Votre demande d'inscription a été envoyée avec succès.";
    } catch (Exception $e) {
        $_SESSION['message'] = "❌ Erreur lors de l'enregistrement : " . $e->getMessage();
    }
}

// Redirection vers la page des formations
$_SESSION['m2lMP'] = 'formations';
header('Location: index.php');
exit;
