<?php
session_unset();
session_destroy();
session_start(); // redémarre une session vide
$_SESSION['m2lMP'] = 'connexion';
header('Location: index.php');
exit;
