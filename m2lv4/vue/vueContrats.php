<div class="conteneur">
    <header>
        <?php include 'haut.php'; ?>
    </header>

    <main>
        <div class="zoneContrats">
            <h2>Gestion des Contrats</h2>

            <?php if (!empty($_SESSION['message'])) : ?>
                <p class="message <?= htmlspecialchars($_SESSION['messageType'] ?? 'info') ?>">
                    <?= htmlspecialchars($_SESSION['message']) ?>
                </p>
                <?php 
                unset($_SESSION['message']); 
                unset($_SESSION['messageType']);
                ?>
            <?php endif; ?>

            <div class="zoneBoutonsActions">
                <form method="post" action="index.php">
                    <input type="hidden" name="m2lMP" value="ajouterContrat">
                    <input type="submit" value="+ Ajouter un contrat" class="btnAjouter">
                </form>
            </div>

            <?php if (!empty($listeContrats)) : ?>
                <table class="tableauContrats">
                    <thead>
                        <tr>
                            <th>ID Contrat</th>
                            <th>Utilisateur</th>
                            <th>Type</th>
                            <th>Date début</th>
                            <th>Date fin</th>
                            <th>Nb heures</th>
                            <th>Salaire brut</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listeContrats as $contrat) : ?>
                            <tr>
                                <td><?= htmlspecialchars($contrat['idContrat']) ?></td>
                                <td><?= htmlspecialchars($contrat['nom'] . ' ' . $contrat['prenom']) ?></td>
                                <td><?= htmlspecialchars($contrat['typeContrat']) ?></td>
                                <td><?= formatDateFr($contrat['dateDebut']) ?></td>
                                <td><?= $contrat['dateFin'] ? formatDateFr($contrat['dateFin']) : '-' ?></td>
                                <td><?= htmlspecialchars($contrat['nbHeures'] ?? '-') ?></td>
                                <td><?= $contrat['salaireBrut'] ? number_format($contrat['salaireBrut'], 2, ',', ' ') . ' €' : '-' ?></td>
                                <td>
                                    <?php if ($contrat['actif']) : ?>
                                        <span class="badge badge-actif">Actif</span>
                                    <?php else : ?>
                                        <span class="badge badge-inactif">Inactif</span>
                                    <?php endif; ?>
                                </td>
                                <td class="actions">
                                    <div class="actionsContainer">
                                        <a href="index.php?m2lMP=modifierContrat&id=<?= urlencode($contrat['idContrat']) ?>" 
                                           class="btnModifier btnModifierSmall">✏️ Modifier</a>
                                        
                                        <form method="post" action="index.php" class="inlineFormDelete" 
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce contrat ?');">
                                            <input type="hidden" name="m2lMP" value="supprimerContrat">
                                            <input type="hidden" name="idContrat" value="<?= htmlspecialchars($contrat['idContrat']) ?>">
                                            <?= csrf_input() ?>
                                            <input type="submit" value="🗑️ Supprimer" class="btnSupprimer btnSupprimerSmall">
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p class="aucunContrat">Aucun contrat enregistré pour le moment.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <?php include 'bas.php'; ?>
    </footer>
</div>