<?php
require_once __DIR__ . '/../modele/dao/DBConnex.php';
require_once __DIR__ . '/../modele/dao/FormationDAO.php';

$id = $_POST['idFormation'] ?? null;
if ($id) {
    FormationDAO::supprimerFormation($id);
    $_SESSION['message'] = "Formation supprimée.";
} else {
    $_SESSION['message'] = "Erreur : formation introuvable.";
}

$_SESSION['m2lMP'] = 'formations';
header('Location: index.php');
exit;
