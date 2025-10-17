<div class="conteneur">
    <header>
        <?php include 'haut.php'; ?>
    </header>

    <main>
        <div class="zoneBulletins">
            <h2>Gestion des Bulletins de paie</h2>

            <?php if (isset($_SESSION['identification']) && isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']['idTypeU'] == 1) : ?>
                <div class="actionsAdmin" style="margin-bottom:1rem;">
                    <a href="index.php?m2lMP=ajouterBulletins" class="btnValider">Ajouter un bulletin</a>
                </div>
            <?php endif; ?>

            <?php if (!empty($listeBulletins)) : ?>
                <table class="tableDemandes">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Intervenant</th>
                            <th>Mois</th>
                            <th>Net à payer</th>
                            <th>Date d'émission</th>
                            <th>Fichier</th>
                            <?php if (isset($_SESSION['identification']) && isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']['idTypeU'] == 1) : ?>
                                <th>Actions</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listeBulletins as $b) : ?>
                            <tr>
                                <td><?= htmlspecialchars($b->getId() ?? '') ?></td>
                                <td><?= htmlspecialchars($b->getIdIntervenant() ?? '') ?></td>
                                <td><?= htmlspecialchars($b->getMois() ?? '') ?></td>
                                <td><?= htmlspecialchars($b->getNetAPayer() ?? '') ?> €</td>
                                <td><?= htmlspecialchars($b->getDateEmission() ?? '') ?></td>
                                <td>
                                    <?php if (!empty($b->getFichier())) : ?>
                                        <a href="<?= htmlspecialchars($b->getFichier()) ?>" target="_blank">Télécharger</a>
                                    <?php else : ?>
                                        -
                                    <?php endif; ?>
                                </td>

                                <?php if (isset($_SESSION['identification']) && isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']['idTypeU'] == 1) : ?>
                                    <td>
                                        <a href="index.php?m2lMP=modifierBulletins&id=<?= urlencode($b->getId()) ?>" class="btnValider">Modifier</a>
                                        <a href="index.php?m2lMP=supprimerBulletin&id=<?= urlencode($b->getId()) ?>" class="btnSupprimer" onclick="return confirm('Confirmer la suppression du bulletin ?');">Supprimer</a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p>Aucun bulletin trouvé.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <?php include 'bas.php'; ?>
    </footer>
</div>
