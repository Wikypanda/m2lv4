<?php
// Intervenant view: ses bulletins
if (!isset($_SESSION['identification']) || $_SESSION['identification'] !== true) {
    $_SESSION['erreurAcces'] = "Accès réservé aux utilisateurs connectés.";
    $_SESSION['m2lMP'] = 'accueil';
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/../modele/dao/BulletinDAO.php';

$idUser = $_SESSION['utilisateur']['idUser'] ?? null;
// ici on suppose que idUser correspond à id_intervenant, adapter si nécessaire
$listeBulletins = [];
if ($idUser) {
    $listeBulletins = BulletinDAO::getByIntervenant($idUser);
}

require_once 'vue/vueMesBulletins.php';
