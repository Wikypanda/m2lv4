<?php
if (!isset($_SESSION['identification']) || $_SESSION['utilisateur']['idTypeU'] != 1) {
    $_SESSION['erreurAcces'] = "Accès réservé aux administrateurs.";
    $_SESSION['m2lMP'] = 'accueil';
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/../modele/dao/BulletinDAO.php';

$id = $_GET['id'] ?? $_POST['id'] ?? null;

if (!$id) {
    $_SESSION['message'] = "Bulletin introuvable.";
    $_SESSION['m2lMP'] = 'bulletins';
    header('Location: index.php');
    exit;
}

$bulletin = BulletinDAO::getById($id);

if (!$bulletin) {
    $_SESSION['message'] = "Bulletin non trouvé.";
    $_SESSION['m2lMP'] = 'bulletins';
    header('Location: index.php');
    exit;
}

require_once 'vue/vueModifierBulletins.php';
