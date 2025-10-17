<div class="conteneur">
    <header>
        <?php include 'haut.php'; ?>
    </header>

    <main>
        <div class="zoneModifierBulletin">
            <h2>Modifier un bulletin</h2>
            <p style="text-align:center; font-size:16px; color:gray;">
                Modifie les informations ci-dessous puis clique sur <strong>Valider</strong>.
            </p>

            <form method="post" action="index.php" enctype="multipart/form-data">
                <input type="hidden" name="m2lMP" value="validerModificationBulletins">
                <input type="hidden" name="id" value="<?= htmlspecialchars($bulletin->getId()) ?>">

                <div class="ligneForm">
                    <label for="idIntervenant">Intervenant (ID) :</label>
                    <input type="number" id="idIntervenant" name="idIntervenant" value="<?= htmlspecialchars($bulletin->getIdIntervenant()) ?>" required>
                </div>

                <div class="ligneForm">
                    <label for="mois">Mois (YYYY-MM) :</label>
                    <input type="month" id="mois" name="mois" value="<?= htmlspecialchars($bulletin->getMois()) ?>" required>
                </div>

                <div class="ligneForm">
                    <label for="netAPayer">Net à payer (€) :</label>
                    <input type="number" step="0.01" id="netAPayer" name="netAPayer" value="<?= htmlspecialchars($bulletin->getNetAPayer()) ?>" required>
                </div>

                <div class="ligneForm">
                    <label for="dateEmission">Date d'émission :</label>
                    <input type="date" id="dateEmission" name="dateEmission" value="<?= htmlspecialchars($bulletin->getDateEmission()) ?>" required>
                </div>

                <div class="ligneForm">
                    <label for="fichier">Fichier (PDF) :</label>
                    <input type="file" name="fichier" id="fichier" accept=".pdf">
                    <?php if (!empty($bulletin->getFichier())): ?>
                        <div>Fichier actuel: <a href="<?= htmlspecialchars($bulletin->getFichier()) ?>" target="_blank">Télécharger</a></div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btnValider">Valider</button>
            </form>

            <?php if (isset($_SESSION['message'])) : ?>
                <p class="message"><?= htmlspecialchars($_SESSION['message']) ?></p>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <?php include 'bas.php'; ?>
    </footer>
</div>
