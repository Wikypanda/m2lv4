<div class="conteneur">
    <header>
        <?php include 'haut.php'; ?>
    </header>

    <main>
        <div class="zoneMesBulletins">
            <h2>Mes bulletins de paie</h2>

            <?php if (!empty($listeBulletins)) : ?>
                <ul class="listeFormations">
                    <?php foreach ($listeBulletins as $b) : ?>
                        <li>
                            <div class="carteFormation">
                                <strong>Mois : <?= htmlspecialchars($b->getMois()) ?></strong><br>
                                Net à payer : <?= htmlspecialchars($b->getNetAPayer()) ?> €<br>
                                Émis le : <?= htmlspecialchars($b->getDateEmission()) ?><br>
                                <?php if ($b->getFichier()): ?>
                                    <a href="<?= htmlspecialchars($b->getFichier()) ?>" target="_blank">Télécharger le bulletin</a>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Vous n'avez aucun bulletin disponible pour le moment.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <?php include 'bas.php'; ?>
    </footer>
</div>
