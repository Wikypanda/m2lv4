<?php
require_once __DIR__ . '/../modele/dao/DemandeDAO.php';

if (!empty($_SESSION['utilisateur']) && !empty($_SESSION['utilisateur']['idUser'])) {
    $idUser = $_SESSION['utilisateur']['idUser'];
    $listeDemandes = DemandeDAO::getDemandesByUser($idUser);
    $_SESSION['listeDemandes'] = $listeDemandes; // ligne manquante
    $_SESSION['m2lMP'] = 'mesDemandes';
    require_once 'vue/vueMesDemandes.php';
    
} else {
    $_SESSION['message'] = "Vous devez être connecté pour consulter vos demandes.";
    $_SESSION['m2lMP'] = 'formations';
    header('Location: index.php');
    exit;
}

