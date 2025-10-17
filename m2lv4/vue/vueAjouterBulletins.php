<div class="conteneur">
    <header>
        <?php include 'haut.php'; ?>
    </header>

    <main>
        <div class="zoneAjoutBulletin">
            <h1>Ajouter un bulletin</h1>

            <form method="post" action="index.php" enctype="multipart/form-data">
                <input type="hidden" name="m2lMP" value="validerAjoutBulletins">
                <!-- hidden id for edit mode -->
                <input type="hidden" name="id" value="<?= isset($bulletin) ? htmlspecialchars($bulletin->getId()) : '' ?>">

                <div class="ligneForm">
                    <label for="idIntervenant">Intervenant (ID) :</label>
                    <input type="number" name="idIntervenant" id="idIntervenant" placeholder="Entrez l'ID numérique de l'intervenant" value="<?= isset($bulletin) ? htmlspecialchars($bulletin->getIdIntervenant()) : '' ?>" required>
                    <small class="aide">Saisir l'identifiant numérique de l'intervenant (ex: 42).</small>
                </div>

                <div class="ligneForm">
                    <label for="mois">Mois (YYYY-MM) :</label>
                    <input type="month" name="mois" id="mois" placeholder="AAAA-MM" value="<?= isset($bulletin) ? htmlspecialchars($bulletin->getMois()) : '' ?>" required>
                    <small class="aide">Choisir le mois de paie (format YYYY-MM).</small>
                </div>

                <div class="ligneForm">
                    <label for="netAPayer">Net à payer (€) :</label>
                    <input type="number" step="0.01" name="netAPayer" id="netAPayer" placeholder="0.00" value="<?= isset($bulletin) ? htmlspecialchars($bulletin->getNetAPayer()) : '' ?>" required>
                    <small class="aide">Montant net à verser (utiliser le point pour les décimales).</small>
                </div>

                <div class="ligneForm">
                    <label for="dateEmission">Date d'émission :</label>
                    <input type="date" name="dateEmission" id="dateEmission" value="<?= isset($bulletin) ? htmlspecialchars($bulletin->getDateEmission()) : '' ?>" required>
                    <small class="aide">Date à laquelle le bulletin a été émis (format YYYY-MM-DD).</small>
                </div>

                <div class="ligneForm">
                    <label for="fichier">Fichier (PDF) :</label>
                    <input type="file" name="fichier" id="fichier" accept=".pdf">
                    <small class="aide">Télécharger le bulletin au format PDF (optionnel).</small>
                    <?php if (isset($bulletin) && !empty($bulletin->getFichier())): ?>
                        <div>Fichier actuel: <a href="<?= htmlspecialchars($bulletin->getFichier()) ?>" target="_blank">Télécharger</a></div>
                    <?php endif; ?>
                </div>

                <div class="ligneForm">
                    <input type="submit" value="Ajouter le bulletin" class="btnValider">
                </div>
            </form>
        </div>
    </main>

    <footer>
        <?php include 'bas.php'; ?>
    </footer>
</div>
