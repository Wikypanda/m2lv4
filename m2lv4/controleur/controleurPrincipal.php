<?php
if (isset($_POST['m2lMP'])) {
    $_SESSION['m2lMP'] = $_POST['m2lMP'];
} elseif (isset($_GET['m2lMP'])) {
    $_SESSION['m2lMP'] = $_GET['m2lMP'];
} elseif (!isset($_SESSION['m2lMP'])) {
    $_SESSION['m2lMP'] = "accueil";
}


//Tester la connexion 

$m2lMP = new Menu("m2lMP");

$m2lMP->ajouterComposant($m2lMP->creerItemLien("accueil", "Accueil"));
$m2lMP->ajouterComposant($m2lMP->creerItemLien("services", "Services"));
$m2lMP->ajouterComposant($m2lMP->creerItemLien("locaux", "Locaux"));
$m2lMP->ajouterComposant($m2lMP->creerItemLien("ligues", "Ligues"));
//if (isset($_SESSION['identification']) && $_SESSION['identification'] && $_SESSION['utilisateur']['idTypeU'] == 1) {
$m2lMP->ajouterComposant($m2lMP->creerItemLien("formations", "Formations"));
$m2lMP->ajouterComposant($m2lMP->creerItemLien("intervenants", "Intervenants"));
// Ajouter accès aux bulletins : DRH voit tous, utilisateurs connectés ont "Mes bulletins"
if (isset($_SESSION['identification']) && $_SESSION['identification']) {
    // si DRH
    if (($_SESSION['utilisateur']['idTypeU'] ?? 0) == 1) {
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("bulletins", "Bulletins"));
    } else {
        $m2lMP->ajouterComposant($m2lMP->creerItemLien("mesBulletins", "Mes bulletins"));
    }
}



if (isset($_SESSION['identification']) && $_SESSION['identification']) {
    $m2lMP->ajouterComposant($m2lMP->creerItemLien("deconnexion", "Se déconnecter"));
} else {
    $m2lMP->ajouterComposant($m2lMP->creerItemLien("connexion", "Se connecter"));
}

$menuPrincipalM2L = $m2lMP->creerMenu($_SESSION['m2lMP'],'m2lMP');

include_once dispatcher::dispatch($_SESSION['m2lMP']);




 