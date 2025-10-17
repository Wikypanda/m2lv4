<div class="conteneur">
    <header>
        <?php include 'haut.php'; ?>
    </header>

    <main>
        <div class="zoneIntervenants">
            <h2>Liste des Intervenants</h2>

            <?php if (!empty($_SESSION['message'])) : ?>
                <?php 
                $messageType = $_SESSION['messageType'] ?? 'info';
                ?>
                <p class="message <?= $messageType ?>"><?= htmlspecialchars($_SESSION['message']) ?></p>
                <?php 
                unset($_SESSION['message']); 
                unset($_SESSION['messageType']);
                ?>
            <?php endif; ?>

            <?php 
            // Utiliser le helper centralisé pour déterminer si l'utilisateur est DRH
            require_once __DIR__ . '/../lib/fonctionsUtiles.php';
            $estDRH = $estDRH ?? estDRH();
            ?>

            <?php if ($estDRH) : ?>
            <div class="zoneBoutonsActions">
                <form method="post" action="index.php">
                    <input type="hidden" name="m2lMP" value="ajouterIntervenant">
                    <input type="submit" value="+ Ajouter un intervenant" class="btnAjouter">
                </form>
            </div>
            <?php endif; ?>

            <?php if (!empty($listeIntervenants)) : ?>
                <table class="tableauIntervenants">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Statut</th>
                            <?php if ($estDRH) : ?>
                                <th>Adresse</th>
                                <th>Date d'embauche</th>
                                <th>Actions</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listeIntervenants as $intervenant) : ?>
                            <tr>
                                <td><?= htmlspecialchars($intervenant->getNom()) ?></td>
                                <td><?= htmlspecialchars($intervenant->getPrenom()) ?></td>
                                <td>
                                    <?php if ($estDRH) : ?>
                                        <?= htmlspecialchars($intervenant->getEmail()) ?>
                                    <?php else : ?>
                                        <?= substr($intervenant->getEmail(), 0, 3) . '***@***.com' ?>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($intervenant->getTelephone() ?: '-') ?></td>
                                <td>
                                    <span class="badge badge-<?= strtolower($intervenant->getStatut()) ?>">
                                        <?= htmlspecialchars($intervenant->getStatut()) ?>
                                    </span>
                                </td>
                                <?php if ($estDRH) : ?>
                                    <td><?= htmlspecialchars($intervenant->getAdresse() ?: '-') ?></td>
                                    <td><?= htmlspecialchars($intervenant->getDateEmbauche() ?: '-') ?></td>
                                    <td class="actions">
                                        <div class="actionsContainer">
                                            <!-- Utiliser un lien GET vers le contrôleur de modification (le contrôleur accepte aussi GET id) -->
                                            <a href="index.php?m2lMP=modifierIntervenant&id=<?= $intervenant->getIdIntervenant() ?>" class="btnModifier btnModifierSmall"> Modifier</a>

                                            <form method="post" action="index.php" class="inlineFormDelete" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet intervenant ?');">
                                                <input type="hidden" name="m2lMP" value="supprimerIntervenant">
                                                <input type="hidden" name="id_intervenant" value="<?= $intervenant->getIdIntervenant() ?>">
                                                <?= csrf_input() ?>
                                                <input type="submit" value="Supprimer" class="btnSupprimer btnSupprimerSmall">
                                            </form>
                                        </div>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p class="aucunIntervenant">Aucun intervenant disponible pour le moment.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <?php include 'bas.php'; ?>
    </footer>
</div>