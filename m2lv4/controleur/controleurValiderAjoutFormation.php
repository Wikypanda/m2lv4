<?php
if (!isset($_SESSION['identification']) || $_SESSION['utilisateur']['idTypeU'] != 1) {
    $_SESSION['erreurAcces'] = "Accès réservé aux administrateurs.";
    $_SESSION['m2lMP'] = 'accueil';
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/../modele/dao/DBConnex.php';
require_once __DIR__ . '/../modele/dao/FormationDAO.php';

$intitule = $_POST['intitule'] ?? '';
$descriptif = $_POST['descriptif'] ?? '';
$duree = $_POST['duree'] ?? '';
$dateOuvert = $_POST['dateOuvert'] ?? '';
$dateCloture = $_POST['dateCloture'] ?? '';
$nbPlaces = $_POST['nbPlaces']; 

if ($intitule && $descriptif && $duree && $dateOuvert && $dateCloture) {
    FormationDAO::ajouterFormation($intitule, $descriptif, $duree, $dateOuvert, $dateCloture, $nbPlaces);
    $_SESSION['message'] = "Formation ajoutée avec succès.";
} else {
    $_SESSION['message'] = "Tous les champs sont obligatoires.";
}

$_SESSION['m2lMP'] = 'formations';
header('Location: index.php');
exit;
