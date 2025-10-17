<?php
if (!isset($_SESSION['identification']) || !$_SESSION['identification']) {
    $_SESSION['m2lMP'] = 'connexion';
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/../modele/dao/DBConnex.php';
require_once __DIR__ . '/../modele/dao/FormationDAO.php';

$isAdmin = !empty($_SESSION['utilisateur']) && $_SESSION['utilisateur']['idTypeU'] == 1;
$listeFormations = FormationDAO::getToutesFormations($isAdmin);
$listeFormations = FormationDAO::getFormationsSelonProfil($isAdmin);

require_once 'vue/vueFormations.php';