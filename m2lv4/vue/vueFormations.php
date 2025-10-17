<?php require_once 'modele/dao/DemandeDAO.php'; 
$idTypeU = $_SESSION['utilisateur']['idTypeU'] ?? null; 
?>

<div class="conteneur">
    <header>
        <?php include 'haut.php'; ?>
    </header>

    <main>
        
<div class="zoneFormations" style="position: relative;">

            <?php if (!empty($_SESSION['utilisateur']) && $_SESSION['utilisateur']['idTypeU'] == 1) : ?>
            <div class="zoneBoutonGlobal">
            <form method="post" action="index.php">
            <input type="hidden" name="m2lMP" value="adminDemandes">
            <input type="submit" value="Accéder aux demandes" class="btnGlobalDemandes">
        </form>
        </div>
            <?php endif; ?>
            

            <?php if (!empty($_SESSION['message'])) : ?>
                <p class="message"><?= htmlspecialchars($_SESSION['message']) ?></p>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>

            

            <?php if (!empty($listeFormations)) : ?>
                <ul class="listeFormations">
                    <?php foreach ($listeFormations as $formation) : ?>
                        <li>
                            <div class="carteFormation">
                                <strong><?= htmlspecialchars($formation['intitule']) ?></strong><br>
                                <?= nl2br(htmlspecialchars($formation['descriptif'])) ?><br>
                                Places disponibles : <?= htmlspecialchars($formation['nbPlaces']) ?><br>
                                Durée : <?= htmlspecialchars($formation['duree']) ?> jours<br>
                                Inscriptions : du <?= formatDateFr($formation['dateOuvertInscriptions']) ?>
                                au <?= formatDateFr($formation['dateClotureInscriptions']) ?><br>

                                <?php if (!empty($_SESSION['utilisateur'])) : ?>
                                    <?php
                                    $idUser = $_SESSION['utilisateur']['idUser'] ?? null;
                                    $idTypeU = $_SESSION['utilisateur']['idTypeU'] ?? null;
                                    $idFormation = $formation['idForma'] ?? null;
                                    $demande = null;

                                    if ($idUser && $idFormation) {
                                        $demande = DemandeDAO::getStatutDemande($idUser, $idFormation);
                                    }
                                    ?>

                                    <?php if ($idTypeU == 1) : ?>
                                        <form method="post" action="index.php" style="display:inline;">
                                            <input type="hidden" name="m2lMP" value="modifierFormation">
                                            <input type="hidden" name="idFormation" value="<?= $formation['idForma'] ?>">
                                            <input type="submit" value="Modifier" class="btnModifier">
                                        </form>

                                        <form method="post" action="index.php" style="display:inline;" onsubmit="return confirm('Supprimer cette formation ?');">
                                            <input type="hidden" name="m2lMP" value="supprimerFormation">
                                            <input type="hidden" name="idFormation" value="<?= $formation['idForma'] ?>">
                                            <input type="submit" value="Supprimer" class="btnSupprimer">
                                        </form>
                                    <?php elseif ($idTypeU == 2) : ?>
                                        <?php if ($demande) : ?>
                                                <form method="post" action="index.php">
                                                    <input type="hidden" name="m2lMP" value="mesDemandes">
                                                    <input type="submit" value="Consulter ma demande" class="btnConsulterDemande">
                                                </form>
                                            <?php else : ?>
                                                <form method="post" action="index.php">
                                                    <input type="hidden" name="m2lMP" value="demanderInscription">
                                                    <input type="hidden" name="idFormation" value="<?= htmlspecialchars($formation['idForma']) ?>">
                                                    <input type="submit" value="S'inscrire" class="btnInscription">
                                                </form>
                                            <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p class="aucuneFormation">Aucune formation disponible</p>
            <?php endif; ?>

            <div class="zoneBoutonsActions">
                <?php if ($idTypeU == 2): ?>
                    <form method="post" action="index.php">
                        <input type="hidden" name="m2lMP" value="mesDemandes">
                        <input type="submit" value="Consulter mes demandes" class="btnDemandes">
                    </form>
                <?php endif; ?>

                <?php if (!empty($_SESSION['utilisateur']) && $_SESSION['utilisateur']['idTypeU'] == 1 ) : ?>
                    <form method="post" action="index.php">
                        <input type="hidden" name="m2lMP" value="ajouterFormation">
                        <input type="submit" value="Ajouter une formation" class="btnAjouter">
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <footer>
        <?php include 'bas.php'; ?>
    </footer>
</div>
