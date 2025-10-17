<?php
require_once 'utils/security.php';
verifyCsrfToken(); // Sécurité CSRF

// 1. Initialisation des variables de recherche
$searchLigue = $_GET['searchLigue'] ?? '';

// 2. Récupération des ligues
try {
    if (!empty($searchLigue)) {
        $lesLigues = LigueDAO::searchLigues($searchLigue); // à créer dans DAO
    } else {
        $lesLigues = LigueDAO::getAllLigues();
    }
} catch (Exception $e) {
    die("Erreur lors de la récupération des ligues : " . $e->getMessage());
}

// 3. Construction du tableau des ligues
$tabLigues = [];
foreach ($lesLigues as $uneLigue) {
    $uneLigue['actions'] = "
        <a href='index.php?controleur=GestionLigues&action=modifierLigue&id=" . $uneLigue['idLigue'] . "'>Modifier</a>
        <a href='index.php?controleur=GestionLigues&action=supprimerLigue&id=" . $uneLigue['idLigue'] . "' onclick=\"return confirm('Voulez-vous vraiment supprimer cette ligue ?')\">Supprimer</a>
    ";
    $tabLigues[] = $uneLigue;
}

$menuLigues = new Tableau("MenuLigue", $tabLigues);
$menuLigues->setTitreTab("Liste des Ligues");
$menuLigues->setTitreCol([
    1 => "IdLigue",
    2 => "Nom",
    3 => "Site",
    4 => "Descriptif",
    5 => "Actions"
]);
$tabLiguesLiens = $menuLigues->creerTableau();

// 4. Traitement des actions
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // --- Ajouter une ligue ---
    if ($action === 'ajouterLigue') {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['nom'], $_POST['site'])) {
            $desc = $_POST['descriptif'] ?? '';
            LigueDAO::ajouterLigue($_POST['nom'], $_POST['site'], $desc);
            header("Location: index.php?controleur=GestionLigues");
            exit();
        }
        include_once "vue/gestion/vueAjouterLigue.php";
        exit();
    }

    // --- Modifier une ligue ---
    if ($action === 'modifierLigue') {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $ligue = LigueDAO::getLigueById($id);
            if ($ligue !== null) {
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $nom = $_POST['nom'];
                    $site = $_POST['site'];
                    $desc = $_POST['descriptif'];
                    LigueDAO::modifierLigue($id, $nom, $site, $desc);
                    header("Location: index.php?controleur=GestionLigues");
                    exit();
                }
                include_once "vue/gestion/vueModifierLigue.php";
                exit();
            } else {
                echo "La ligue spécifiée n'existe pas.";
            }
        }
    }

    // --- Supprimer une ligue ---
    if ($action === 'supprimerLigue') {
        $id = $_GET['id'] ?? null;
        if ($id) {
            LigueDAO::supprimerLigue($id);
            header("Location: index.php?controleur=GestionLigues");
            exit();
        }
    }
}

// 5. Affichage de la vue principale de gestion
include_once 'vue/gestion/vueGestionLigues.php';
