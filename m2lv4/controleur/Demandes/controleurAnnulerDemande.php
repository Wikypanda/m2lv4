<?php
require_once __DIR__ . '/../modele/dao/DBConnex.php';
require_once __DIR__ . '/../modele/dao/DemandeDAO.php';

$idUser = $_SESSION['utilisateur']['idUser'] ?? null;
$idFormation = $_POST['idFormation'] ?? null;

if ($idUser && $idFormation) {
    try {
        DemandeDAO::supprimerDemande($idUser, $idFormation);
        $_SESSION['message'] = "Votre demande a été annulée.";
    } catch (Exception $e) {
        $_SESSION['message'] = "Erreur lors de l'annulation : " . $e->getMessage();
    }
} else {
    $_SESSION['message'] = "Données manquantes pour annuler la demande.";
}

$_SESSION['m2lMP'] = 'mesDemandes';
header('Location: index.php');
exit;
