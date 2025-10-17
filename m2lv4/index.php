<?php
require_once 'lib/autoLoader.php';
require_once 'lib/fonctionsUtiles.php';
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'deconnexion') {
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['m2lMP'] = 'connexion';
}

require_once 'controleur/controleurPrincipal.php'; // ✅ Un seul appel ici
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Maison des Ligues de Lorraine</title>
    <style type="text/css">
        @import url(styles/m2l.css);
    </style>
</head>
<body>
    <!-- Le contrôleur a déjà été appelé plus haut -->
</body>
</html>
