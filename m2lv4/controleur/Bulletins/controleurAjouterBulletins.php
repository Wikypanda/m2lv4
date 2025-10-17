<?php
if (!isset($_SESSION['identification']) || $_SESSION['utilisateur']['idTypeU'] != 1) {
    $_SESSION['erreurAcces'] = "Accès réservé aux administrateurs.";
    $_SESSION['m2lMP'] = 'accueil';
    header('Location: index.php');
    exit;
}

// Charger la liste des formations si disponible (adapter selon votre DAO)
// require_once __DIR__ . '/../modele/FormationDAO.php';
// $formations = FormationDAO::getAll();

require_once 'vue/vueAjouterBulletins.php';
