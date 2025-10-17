<?php
if (!isset($_SESSION['identification']) || !$_SESSION['identification']) {
    $_SESSION['m2lMP'] = 'connexion';
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/../modele/dao/DBConnex.php';
require_once __DIR__ . '/../modele/dao/IntervenantDAO.php';

// Vérifier si l'utilisateur est DRH/Admin
$typeU = $_SESSION['utilisateur']['typeU'] ?? null;
$estDRH = (strtoupper($typeU ?? '') === 'DRH') || ($_SESSION['utilisateur']['idTypeU'] ?? 0) == 1;

// Récupérer la liste des intervenants
$listeIntervenants = IntervenantDAO::lireTous();

require_once 'vue/vueIntervenants.php';