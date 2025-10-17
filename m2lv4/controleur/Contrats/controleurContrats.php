<?php
if (!isset($_SESSION['identification']) || $_SESSION['utilisateur']['idTypeU'] != 1) {
    $_SESSION['erreurAcces'] = "Accès réservé aux administrateurs.";
    $_SESSION['m2lMP'] = 'accueil';
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/../modele/dao/ContratDAO.php';

$listeContrats = ContratDAO::getAllContrats();

$_SESSION['m2lMP'] = 'contrats';
require_once 'vue/vueContrats.php';
?>