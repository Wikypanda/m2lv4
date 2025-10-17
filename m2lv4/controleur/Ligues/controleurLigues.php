<?php
include_once __DIR__ . '/../modele/dao/ligueDAO.php';
echo "Contrôleur Ligues chargé ✅<br>";

$ligues = getAllLigues();
$clubsTest = getClubsByLigue(1);


$liguesAvecClubs = [];

foreach ($ligues as $ligue) {
    $clubs = getClubsByLigue($ligue['idLigue']);
    $ligue['clubs'] = $clubs;
    $liguesAvecClubs[] = $ligue;
}

include 'vue/vueLigues.php';
