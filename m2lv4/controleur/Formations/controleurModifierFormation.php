<?php
require_once __DIR__ . '/../modele/dao/DBConnex.php';
require_once __DIR__ . '/../modele/dao/FormationDAO.php';

$id = $_POST['idFormation'] ?? null;

if (!$id) {
    $_SESSION['message'] = "Formation introuvable.";
    $_SESSION['m2lMP'] = 'formations';
    header('Location: index.php');
    exit;
}

$formation = FormationDAO::getFormationById($id);

if (!$formation) {
    $_SESSION['message'] = "Formation non trouvée.";
    $_SESSION['m2lMP'] = 'formations';
    header('Location: index.php');
    exit;
}

require_once 'vue/vueModifierFormation.php';
