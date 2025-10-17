<?php
// DRH view: liste de tous les bulletins
if (!isset($_SESSION['identification']) || $_SESSION['identification'] !== true || ($_SESSION['utilisateur']['idTypeU'] ?? 0) != 1) {
    $_SESSION['erreurAcces'] = "Accès réservé aux DRH.";
    $_SESSION['m2lMP'] = 'accueil';
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/../modele/dao/BulletinDAO.php';

$listeBulletins = BulletinDAO::getAll();

require_once 'vue/vueBulletins.php';
