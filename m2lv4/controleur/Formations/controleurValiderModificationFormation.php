<?php
require_once __DIR__ . '/../modele/dao/DBConnex.php';
require_once __DIR__ . '/../modele/dao/FormationDAO.php';

$id = $_POST['idFormation'] ?? null;
$intitule = $_POST['intitule'] ?? '';
$descriptif = $_POST['descriptif'] ?? '';
$nbPlaces = $_POST['nbPlaces'] ?? '';
$duree = $_POST['duree'] ?? '';
$dateOuvert = $_POST['dateOuvert'] ?? '';
$dateCloture = $_POST['dateCloture'] ?? '';

if ($id && $intitule && $descriptif && $duree && $dateOuvert && $dateCloture) {
    FormationDAO::modifierFormation($id, $intitule, $descriptif, $duree, $dateOuvert, $dateCloture, $nbPlaces);
    $_SESSION['message'] = "Formation modifiée avec succès.";
} else {
    $_SESSION['message'] = "Erreur : tous les champs sont obligatoires.";
}

$_SESSION['m2lMP'] = 'formations';
header('Location: index.php');
exit;
